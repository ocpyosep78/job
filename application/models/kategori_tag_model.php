<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_Tag_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array('id', 'kategori_id', 'tag_id');
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, KATEGORI_TAG);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, KATEGORI_TAG);
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
            $select_query  = "SELECT * FROM ".KATEGORI_TAG." WHERE id = '".$param['id']."' LIMIT 1";
        } 
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$string_kategori = (empty($param['kategori_id'])) ? '' : "AND KategoriTag.kategori_id = '".$param['kategori_id']."'";
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'tag_id ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS KategoriTag.*, Tag.nama tag_nama, Tag.alias tag_alias
			FROM ".KATEGORI_TAG." KategoriTag
			LEFT JOIN ".TAG." Tag ON Tag.id = KategoriTag.tag_id
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
		if (isset($param['id'])) {
			$delete_query  = "DELETE FROM ".KATEGORI_TAG." WHERE id = '".$param['id']."' LIMIT 1";
			$delete_result = mysql_query($delete_query) or die(mysql_error());
		} else if (isset($param['kategori_id'])) {
			$delete_query  = "DELETE FROM ".KATEGORI_TAG." WHERE kategori_id = '".$param['kategori_id']."'";
			$delete_result = mysql_query($delete_query) or die(mysql_error());
		}
		
		$result['status'] = '1';
		$result['message'] = 'Data berhasil dihapus.';

        return $result;
    }
	
	function sync($row, $column = array()) {
		$row = StripArray($row);
		
		if (count($column) > 0) {
			$row = dt_view($row, $column, array('is_edit' => 1));
		}
		
		return $row;
	}
}