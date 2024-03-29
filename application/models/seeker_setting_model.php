<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seeker_Setting_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array('id', 'seeker_id', 'is_public', 'is_subscribe', 'is_work');
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, SEEKER_SETTING);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, SEEKER_SETTING);
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
            $select_query  = "SELECT * FROM ".SEEKER_SETTING." WHERE id = '".$param['id']."' LIMIT 1";
        } else if (isset($param['seeker_id'])) {
            $select_query  = "SELECT * FROM ".SEEKER_SETTING." WHERE seeker_id = '".$param['seeker_id']."' LIMIT 1";
        } 
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$string_seeker = (empty($param['seeker_id'])) ? '' : "AND SeekerSetting.seeker_id = '".$param['seeker_id']."'";
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'is_public ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS SeekerSetting.*
			FROM ".SEEKER_SETTING." SeekerSetting
			WHERE 1 $string_seeker $string_filter
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
	
	function is_public($param = array()) {
		$setting = $this->get_by_id(array( 'seeker_id' => $param['seeker_id'] ));
		
		$is_public = @$setting['is_public'];
		$result = ($is_public == 1) ? true : false;
		return $result;
	}
	
	function is_work($param = array()) {
		$setting = $this->get_by_id(array( 'seeker_id' => $param['seeker_id'] ));
		
		$is_work = @$setting['is_work'];
		$result = ($is_work == 1) ? true : false;
		return $result;
	}
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".SEEKER_SETTING." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
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