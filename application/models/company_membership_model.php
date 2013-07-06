<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_Membership_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array('id', 'company_id', 'membership_id', 'date_request', 'status');
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, COMPANY_MEMBERSHIP);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, COMPANY_MEMBERSHIP);
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
				SELECT
					CompanyMembership.*, Company.nama company_nama,
					Membership.post_count, Membership.date_count, Membership.price
				FROM ".COMPANY_MEMBERSHIP." CompanyMembership
				LEFT JOIN ".COMPANY." Company ON Company.id = CompanyMembership.company_id
				LEFT JOIN ".MEMBERSHIP." Membership ON Membership.id = CompanyMembership.membership_id
				WHERE CompanyMembership.id = '".$param['id']."'
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
		
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'is_public ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS CompanyMembership.*, Company.nama company_nama, Company.email company_email,
				Membership.post_count, Membership.date_count, Membership.price
			FROM ".COMPANY_MEMBERSHIP." CompanyMembership
			LEFT JOIN ".COMPANY." Company ON Company.id = CompanyMembership.company_id
			LEFT JOIN ".MEMBERSHIP." Membership ON Membership.id = CompanyMembership.membership_id
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
		$param['is_new'] = (empty($param['is_new'])) ? 0 : $param['is_new'];
		$string_where = (empty($param['where'])) ? '' : $param['where'];
		
		if ($param['is_new'] == 1) {
			$select_query = "SELECT COUNT(*) TotalRecord FROM ".COMPANY_MEMBERSHIP." WHERE 1 $string_where";
		} else {
			$select_query = "SELECT FOUND_ROWS() TotalRecord";
		}
		
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$TotalRecord = $row['TotalRecord'];
		
		return $TotalRecord;
    }
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".COMPANY_MEMBERSHIP." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data berhasil dihapus.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		
		if (count(@$param['column']) > 0) {
			$param['is_custom'] = (empty($param['is_custom'])) ? '&nbsp;' : $param['is_custom'];
			if ($row['status'] == 'pending') {
				$param['is_custom'] .= $param['is_pending'];
			}
			
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}