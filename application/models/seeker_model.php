<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seeker_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array(
			'id', 'kelamin_id', 'kota_id', 'marital_id', 'seeker_no', 'first_name', 'last_name', 'email', 'tempat_lahir', 'tgl_lahir', 'address', 'phone', 'hp',
			'passwd', 'photo', 'last_login', 'last_update', 'agama', 'kebangsaan', 'facebook', 'twitter', 'ibu_kandung'
		);
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, SEEKER);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, SEEKER);
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
				SELECT Seeker.*, Kota.nama kota_nama, Propinsi.id propinsi_id, Propinsi.nama propinsi_nama
				FROM ".SEEKER." Seeker
				LEFT JOIN ".KOTA." Kota ON Kota.id = Seeker.kota_id
				LEFT JOIN ".PROPINSI." Propinsi ON Propinsi.id = Kota.propinsi_id
				WHERE Seeker.id = '".$param['id']."'
				LIMIT 1
			";
        } else if (isset($param['email'])) {
            $select_query  = "SELECT * FROM ".SEEKER." WHERE email = '".$param['email']."' LIMIT 1";
        }
		
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'first_name ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS Seeker.*
			FROM ".SEEKER." Seeker
			WHERE 1 $string_filter
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
			$select_query = "SELECT COUNT(*) TotalRecord FROM ".SEEKER."";
		} else {
			$select_query = "SELECT FOUND_ROWS() TotalRecord";
		}
		
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$TotalRecord = $row['TotalRecord'];
		
		return $TotalRecord;
    }
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".SEEKER." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data berhasil dihapus.';

        return $result;
    }
	
	function sync($row, $column = array()) {
		$row = StripArray($row);
		
		$row['full_name'] = $row['first_name'];
		if (isset($row['first_name']) && isset($row['last_name'])) {
			$row['full_name'] = $row['first_name'].' '.$row['last_name'];
		}
		
		if (count($column) > 0) {
			$row = dt_view($row, $column, array('is_edit' => 1));
		}
		
		return $row;
	}
	
	/*	Region Seeker Session */
	
	function login_required() {
		$is_login = $this->is_login();
		
		if (! $is_login) {
			header("Location: ".base_url('login'));
			exit;
		}
	}
	
	function is_login() {
		$seeker = $this->get_session();
		$is_login = (count($seeker) == 0) ? false : true;
		
		return $is_login;
	}
	
	function set_session($param) {
		$_SESSION['seeker'] = $param;
	}
	
	function get_session() {
		$seeker = (isset($_SESSION['seeker'])) ? $_SESSION['seeker'] : array();
		
		return $seeker;
	}
	
	function delete_session() {
		$_SESSION['seeker'] = array();
	}
	
	/*	End Region Seeker Session */
}