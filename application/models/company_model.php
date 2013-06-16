<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array(
			'id', 'kota_id', 'nama', 'phone', 'faximile', 'website', 'address', 'email', 'passwd', 'description', 'kodepos', 'sales', 'contact_name',
			'contact_email', 'contact_no', 'logo', 'banner', 'google_map', 'industri_id', 'alias', 'reset'
		);
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, COMPANY);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, COMPANY);
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
				SELECT Company.*, Propinsi.id propinsi_id
				FROM ".COMPANY." Company
				LEFT JOIN ".KOTA." Kota ON Kota.id = Company.kota_id
				LEFT JOIN ".PROPINSI." Propinsi ON Propinsi.id = Kota.propinsi_id
				WHERE Company.id = '".$param['id']."' LIMIT 1
			";
        } else if (isset($param['alias'])) {
            $select_query  = "
				SELECT Company.*, Kota.nama kota_nama, Propinsi.id propinsi_id, Industri.nama industri_nama
				FROM ".COMPANY." Company
				LEFT JOIN ".KOTA." Kota ON Kota.id = Company.kota_id
				LEFT JOIN ".PROPINSI." Propinsi ON Propinsi.id = Kota.propinsi_id
				LEFT JOIN ".INDUSTRI." Industri ON Industri.id = Company.industri_id
				WHERE Company.alias = '".$param['alias']."' LIMIT 1
			";
        } else if (isset($param['email'])) {
            $select_query  = "
				SELECT Company.*, Propinsi.id propinsi_id
				FROM ".COMPANY." Company
				LEFT JOIN ".KOTA." Kota ON Kota.id = Company.kota_id
				LEFT JOIN ".PROPINSI." Propinsi ON Propinsi.id = Kota.propinsi_id
				WHERE email = '".$param['email']."' LIMIT 1
			";
        } else if (isset($param['reset'])) {
            $select_query  = "SELECT * FROM ".COMPANY." WHERE reset = '".$param['reset']."' LIMIT 1";
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
		$string_sorting = GetStringSorting($param, @$param['column'], 'nama ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS Company.*
			FROM ".COMPANY." Company
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
			$select_query = "SELECT COUNT(*) TotalRecord FROM ".COMPANY."";
		} else {
			$select_query = "SELECT FOUND_ROWS() TotalRecord";
		}
		
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$TotalRecord = $row['TotalRecord'];
		
		return $TotalRecord;
    }
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".COMPANY." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data berhasil dihapus.';

        return $result;
    }
	
	function sync($row, $column = array()) {
		$row = StripArray($row);
		$row['company_link'] = base_url($row['alias']);
		
		if (isset($row['logo'])) {
			$row['logo_link'] = base_url('static/upload/'.$row['logo']);
		}
		
		if (count($column) > 0) {
			$row = dt_view($row, $column, array('is_edit' => 1));
		}
		
		return $row;
	}
	
	function resize_image($param) {
		if (!empty($param['banner'])) {
			$image_source = $this->config->item('base_path').'/static/upload/'.$param['banner'];
			ImageResize($image_source, $image_source, 650, 186, 1);
		}
	}
	
	/*	Region Company Session */
	
	function login_required() {
		$is_login = $this->is_login();
		
		if (! $is_login) {
			header("Location: ".base_url('login'));
			exit;
		}
	}
	
	function is_login() {
		$company = $this->get_session();
		$is_login = (count($company) == 0) ? false : true;
		
		return $is_login;
	}
	
	function set_session($param) {
		$_SESSION['company'] = $param;
	}
	
	function get_session() {
		$company = (isset($_SESSION['company'])) ? $_SESSION['company'] : array();
		
		return $company;
	}
	
	function delete_session() {
		$_SESSION['company'] = array();
	}
	
	/*	End Region Company Session */
}