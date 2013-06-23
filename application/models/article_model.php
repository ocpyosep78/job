<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array('id', 'editor_id', 'subkategori_id', 'article_status_id', 'nama', 'alias', 'photo', 'article_url', 'article_desc_1', 'article_desc_2', 'article_desc_3', 'image_piracy', 'publish_date');
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, ARTICLE);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, ARTICLE);
            $update_result = mysql_query($update_query) or die(mysql_error());
           
            $result['id'] = $param['id'];
            $result['status'] = '1';
            $result['message'] = 'Data berhasil diperbaharui.';
        }
		
		$this->resize_image($param);
       
        return $result;
    }

    function get_by_id($param) {
        $array = array();
		
        if (isset($param['id'])) {
            $select_query  = "
				SELECT
					Article.*,
					Subkategori.nama subkategori_nama, Subkategori.alias subkategori_alias,
					Kategori.nama kategori_nama, Kategori.alias kategori_alias, Kategori.id kategori_id
				FROM ".ARTICLE." Article
				LEFT JOIN ".SUBKATEGORI." Subkategori ON Subkategori.id = Article.subkategori_id
				LEFT JOIN ".KATEGORI." Kategori ON Kategori.id = Subkategori.kategori_id
				WHERE Article.id = '".$param['id']."'
				LIMIT 1
			";
        } else if (isset($param['alias'])) {
            $select_query  = "
				SELECT
					Article.*,
					Subkategori.nama subkategori_nama, Subkategori.alias subkategori_alias,
					Kategori.nama kategori_nama, Kategori.alias kategori_alias, Kategori.id kategori_id
				FROM ".ARTICLE." Article
				LEFT JOIN ".SUBKATEGORI." Subkategori ON Subkategori.id = Article.subkategori_id
				LEFT JOIN ".KATEGORI." Kategori ON Kategori.id = Subkategori.kategori_id
				WHERE Article.alias = '".$param['alias']."'
				LIMIT 1
			";
        }
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		// overwrite field name
		$param['field_replace']['nama'] = 'Article.nama';
		$param['field_replace']['subkategori_nama'] = 'Subkategori.nama';
		$param['field_replace']['article_status_nama'] = 'ArticleStatus.nama';
		
		$string_status = (empty($param['article_status_id'])) ? '' : "AND Article.article_status_id = '".$param['article_status_id']."'";
		$string_kategori = (empty($param['kategori_id'])) ? '' : "AND Kategori.id = '".$param['kategori_id']."'";
		$string_subkategori = (empty($param['subkategori_id'])) ? '' : "AND Subkategori.id = '".$param['subkategori_id']."'";
		$string_publish_date = (empty($param['publish_date'])) ? '' : "AND Article.publish_date <= '".$param['publish_date']."'";
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'nama ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS Article.*, Subkategori.nama subkategori_nama, ArticleStatus.nama article_status_nama
			FROM ".ARTICLE." Article
			LEFT JOIN ".SUBKATEGORI." Subkategori ON Subkategori.id = Article.subkategori_id
			LEFT JOIN ".KATEGORI." Kategori ON Kategori.id = Subkategori.kategori_id
			LEFT JOIN ".ARTICLE_STATUS." ArticleStatus ON ArticleStatus.id = Article.article_status_id
			WHERE 1 $string_status $string_kategori $string_subkategori $string_publish_date $string_filter
			ORDER BY $string_sorting
			LIMIT $string_limit
		";
        $select_result = mysql_query($select_query) or die(mysql_error());
		while ( $row = mysql_fetch_assoc( $select_result ) ) {
			$array[] = $this->sync($row, @$param['column']);
		}
		
        return $array;
    }

    function get_count($param = array()) {
		$param['is_new'] = (empty($param['is_new'])) ? 0 : $param['is_new'];
		
		if ($param['is_new'] == 1) {
			$select_query = "SELECT COUNT(*) TotalRecord FROM ".ARTICLE."";
		} else {
			$select_query = "SELECT FOUND_ROWS() TotalRecord";
		}
		
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$TotalRecord = $row['TotalRecord'];
		
		return $TotalRecord;
    }
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".ARTICLE." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data berhasil dihapus.';

        return $result;
    }
	
	function sync($row, $column = array()) {
		$row = StripArray($row, array('publish_date'));
		$row['desc_short'] = GetLengthChar($row['article_desc_1'], 100, '');
		$row['article_link'] = base_url('blog/'.$row['alias']);
		
		if (!empty($row['photo'])) {
			$row['photo_link'] = base_url('static/upload/'.$row['photo']);
		}
		
		if (!empty($row['kategori_alias'])) {
			$row['kategori_link'] = base_url('blog/'.$row['kategori_alias']);
		}
		if (!empty($row['kategori_alias']) && !empty($row['subkategori_alias'])) {
			$row['subkategori_link'] = base_url('blog/'.$row['kategori_alias'].'/'.$row['subkategori_alias']);
		}
		
		if (count($column) > 0) {
			$row = dt_view($row, $column, array('is_edit' => 1));
		}
		
		return $row;
	}
	
	function resize_image($param) {
		if (!empty($param['photo'])) {
			$image_source = $this->config->item('base_path').'/static/upload/'.$param['photo'];
			ImageResize($image_source, $image_source, 206, 127, 1);
		}
	}
}