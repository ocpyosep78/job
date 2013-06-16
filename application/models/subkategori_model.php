<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subkategori_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array('id', 'kategori_id', 'nama', 'alias');
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, SUBKATEGORI);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, SUBKATEGORI);
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
            $select_query  = "
				SELECT Subkategori.*, Kategori.nama kategori_nama, Kategori.alias kategori_alias
				FROM ".SUBKATEGORI." Subkategori
				LEFT JOIN ".KATEGORI." Kategori ON Kategori.id = Subkategori.kategori_id
				WHERE id = '".$param['id']."'
				LIMIT 1
			";
        } else if (isset($param['alias'])) {
            $select_query  = "
				SELECT Subkategori.*, Kategori.nama kategori_nama, Kategori.alias kategori_alias
				FROM ".SUBKATEGORI." Subkategori
				LEFT JOIN ".KATEGORI." Kategori ON Kategori.id = Subkategori.kategori_id
				WHERE Subkategori.alias = '".$param['alias']."'
				LIMIT 1
			";
        } else {
			return array();
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
		$param['field_replace']['nama'] = 'Subkategori.nama';
		$param['field_replace']['alias'] = 'Subkategori.alias';
		$param['field_replace']['kategori_nama'] = 'Kategori.nama';
		
		$string_kategori = (empty($param['kategori_id'])) ? '' : "AND kategori_id = '".$param['kategori_id']."'";
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'nama ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS Subkategori.*,
				Kategori.nama kategori_nama, Kategori.alias kategori_alias
			FROM ".SUBKATEGORI." Subkategori
			LEFT JOIN ".KATEGORI." Kategori ON Kategori.id = Subkategori.kategori_id
			WHERE 1 $string_kategori $string_filter
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
		$select_query = "SELECT FOUND_ROWS() TotalRecord";
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$TotalRecord = $row['TotalRecord'];
		
		return $TotalRecord;
    }
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".SUBKATEGORI." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data berhasil dihapus.';

        return $result;
    }
	
	function sync($row, $column = array()) {
		$row = StripArray($row);
		$row['link'] = base_url('blog/'.$row['kategori_alias'].'/'.$row['alias']);
		
		if (count($column) > 0) {
			$row = dt_view($row, $column, array('is_edit' => 1));
		}
		
		return $row;
	}
}