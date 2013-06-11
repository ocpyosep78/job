<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vacancy_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array(
			'id', 'company_id', 'subkategori_id', 'nama', 'position', 'vacancy_status_id', 'article_link', 'content_short', 'content', 'opsi_1',
			'opsi_2', 'kota_id', 'jenjang_id', 'jenis_pekerjaan_id', 'seeker_exp_id', 'gaji', 'publish_date', 'close_date', 'email_apply',
			'email_quick'
		);
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, VACANCY);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, VACANCY);
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
            $select_query  = "SELECT * FROM ".VACANCY." WHERE id = '".$param['id']."' LIMIT 1";
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
		$string_sorting = GetStringSorting($param, @$param['column'], 'Vacancy.nama ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS Vacancy.*
			FROM ".VACANCY." Vacancy
			LEFT JOIN ".COMPANY." Company ON Company.id = Vacancy.company_id
			LEFT JOIN ".SUBKATEGORI." Subkategori ON Subkategori.id = Vacancy.subkategori_id
			LEFT JOIN ".KATEGORI." Kategori ON Kategori.id = Subkategori.kategori_id
			LEFT JOIN ".VACANCY_STATUS." VacancyStatus ON VacancyStatus.id = Vacancy.vacancy_status_id
			LEFT JOIN ".KOTA." Kota ON Kota.id = Vacancy.kota_id
			LEFT JOIN ".JENJANG." Jenjang ON Jenjang.id = Vacancy.jenjang_id
			LEFT JOIN ".JENIS_PEKERJAAN." JenisPekerjaan ON JenisPekerjaan.id = Vacancy.jenis_pekerjaan_id
			LEFT JOIN ".SEEKER_EXP." SeekerExp ON SeekerExp.id = Vacancy.seeker_exp_id
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
		$select_query = "SELECT FOUND_ROWS() TotalRecord";
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$TotalRecord = $row['TotalRecord'];
		
		return $TotalRecord;
    }
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".VACANCY." WHERE id = '".$param['id']."' LIMIT 1";
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