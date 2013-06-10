<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apply_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array('id', 'seeker_id', 'vacancy_id', 'apply_status_id', 'apply_date', 'is_delete', 'addtional_info');
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, APPLY);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, APPLY);
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
            $select_query  = "SELECT * FROM ".APPLY." WHERE id = '".$param['id']."' LIMIT 1";
        } 
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		// replace search
		$param['field_replace']['location'] = 'Kota.nama';
		$param['field_replace']['company_nama'] = 'Company.nama';
		$param['field_replace']['apply_status_name'] = 'ApplyStatus.nama';
		
		$string_seeker = (empty($param['seeker_id'])) ? '' : "AND Apply.seeker_id = '".$param['seeker_id']."'";
		$string_delete = (isset($param['is_delete'])) ? "AND Apply.is_delete = '".$param['is_delete']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'nama ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS Apply.*,
				Vacancy.position, Company.nama company_nama, Kota.nama kota_nama, Propinsi.nama propinsi_nama,
				ApplyStatus.nama apply_status_name
			FROM ".APPLY." Apply
			LEFT JOIN ".APPLY_STATUS." ApplyStatus ON ApplyStatus.id = Apply.apply_status_id
			LEFT JOIN ".VACANCY." Vacancy ON Vacancy.id = Apply.vacancy_id
			LEFT JOIN ".COMPANY." Company ON Company.id = Vacancy.company_id
			LEFT JOIN ".KOTA." Kota ON Kota.id = Vacancy.kota_id
			LEFT JOIN ".PROPINSI." Propinsi ON Propinsi.id = Kota.propinsi_id
			WHERE 1 $string_seeker $string_delete $string_filter
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
		$delete_query  = "DELETE FROM ".APPLY." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data berhasil dihapus.';

        return $result;
    }
	
	function sync($row, $column = array()) {
		$row = StripArray($row);
		
		if (!empty($row['content'])) {
			$row['content_html'] = save_tinymce($row['content']);
		}
		if (!empty($row['content_short'])) {
			$row['content_short_html'] = save_tinymce($row['content_short']);
		}
		if (!empty($row['kota_nama']) && !empty($row['propinsi_nama'])) {
			$row['location'] = $row['propinsi_nama'].' - '.$row['kota_nama'];
		}
		
		if (count($column) > 0) {
			$row = dt_view($row, $column, array('is_delete' => 1));
		}
		
		return $row;
	}
}