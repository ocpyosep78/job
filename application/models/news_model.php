<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array('id', 'nama', 'content');
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, NEWS);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, NEWS);
            $update_result = mysql_query($update_query) or die(mysql_error());
           
            $result['id'] = $param['id'];
            $result['status'] = '1';
            $result['message'] = 'Data berhasil diperbaharui.';
        }
       
        return $result;
    }

    function get_by_id($param) {
        $array = array();
       
        if (isset($param['id'])) {
            $select_query  = "SELECT * FROM ".NEWS." WHERE id = '".$param['id']."' LIMIT 1";
		} else if (isset($param['nama'])) {
			$select_query  = "SELECT * FROM ".NEWS." WHERE nama = '".$param['nama']."' LIMIT 1";
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
		$param['field_replace']['content_title'] = 'News.content';
		
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'nama ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS News.*
			FROM ".NEWS." News
			WHERE 1 $string_filter
			ORDER BY $string_sorting
			LIMIT $string_limit
		";
        $select_result = mysql_query($select_query) or die(mysql_error());
		while ( $row = mysql_fetch_assoc( $select_result ) ) {
			$array[] = $this->sync($row, $param);
		}
		
        return $array;
    }

    function get_count($param = array()) {
		$select_query = "SELECT FOUND_ROWS() TotalRecord";
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$TotalRecord = $row['TotalRecord'];
		
		return $TotalRecord;
    }
	
	function get_seeker() {
		$news = $this->get_by_id(array( 'nama' => 'Pelamar' ));
		
		// make it valid
		$content = '';
		if (count($news) > 0) {
			$content = trim(strip_tags($news['content']));
			$content = (empty($content)) ? $content : $news['content'];
		}
		
		return $content;
	}
	
	function get_company() {
		$news = $this->get_by_id(array( 'nama' => 'Perusahaan' ));
		
		// make it valid
		$content = '';
		if (count($news) > 0) {
			$content = trim(strip_tags($news['content']));
			$content = (empty($content)) ? $content : $news['content'];
		}
		
		return $content;
	}
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".NEWS." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data berhasil dihapus.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		$row['content_title'] = GetLengthChar($row['content'], 150, ' ...');
		$row['content_html'] = save_tinymce($row['content']);
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}