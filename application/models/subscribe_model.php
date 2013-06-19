<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribe_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array('id', 'jenis_subscribe_id', 'email', 'status');
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, SUBSCRIBE);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, SUBSCRIBE);
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
            $select_query  = "SELECT * FROM ".SUBSCRIBE." WHERE id = '".$param['id']."' LIMIT 1";
        } else if (isset($param['email']) && isset($param['jenis_subscribe_id'])) {
            $select_query  = "SELECT * FROM ".SUBSCRIBE." WHERE email = '".$param['email']."' AND jenis_subscribe_id = '".$param['jenis_subscribe_id']."' LIMIT 1";
        }
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$string_jenis_subscribe = (empty($param['jenis_subscribe_id'])) ? '' : "AND Subscribe.jenis_subscribe_id = '".$param['jenis_subscribe_id']."'";
		$string_company = (empty($param['company_id'])) ? '' : "AND Vacancy.company_id = '".$param['company_id']."'";
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'nama ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS Subscribe.*, JenisSubscribe.nama jenis_subscribe_nama
			FROM ".SUBSCRIBE." Subscribe
			LEFT JOIN ".JENIS_SUBSCRIBE." JenisSubscribe ON JenisSubscribe.id = Subscribe.jenis_subscribe_id
			WHERE 1 $string_jenis_subscribe $string_filter
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
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".SUBSCRIBE." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data berhasil dihapus.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		$row['status_text'] = ($row['status'] == 0) ? 'Tidak' : 'Ya';
		
		if (count(@$param['column']) > 0) {
			if (!empty($param['is_update_subscribe'])) {
				$param['is_custom']  = (empty($param['is_custom'])) ? '' : $param['is_custom'];
				$param['is_custom'] .= ($row['status'] == 0)
					? '<img class="button-cursor confirm" src="'.base_url('static/img/button_check.png').'"> '
					: '<img class="button-cursor remove" src="'.base_url('static/img/button_remove.png').'"> ';
			}
			
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}