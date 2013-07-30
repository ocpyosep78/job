<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seeker_Subscribe_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'seeker_id', 'subkategori_id' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, SEEKER_SUBSCRIBE);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, SEEKER_SUBSCRIBE);
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
            $select_query  = "SELECT * FROM ".SEEKER_SUBSCRIBE." WHERE id = '".$param['id']."' LIMIT 1";
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
		$param['field_replace']['kategori_nama'] = 'Kategori.nama';
		$param['field_replace']['subkategori_nama'] = 'Subkategori.nama';
		
		$string_seeker = (empty($param['seeker_id'])) ? '' : "AND SeekerSubscribe.seeker_id = '".$param['seeker_id']."'";
		$string_subkategori = (empty($param['subkategori_id'])) ? '' : "AND SeekerSubscribe.subkategori_id = '".$param['subkategori_id']."'";
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'seeker_id ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS SeekerSubscribe.*, Seeker.email,
				Subkategori.nama subkategori_nama, Subkategori.kategori_id, Kategori.nama kategori_nama
			FROM ".SEEKER_SUBSCRIBE." SeekerSubscribe
			LEFT JOIN ".SUBKATEGORI." Subkategori ON Subkategori.id = SeekerSubscribe.subkategori_id
			LEFT JOIN ".KATEGORI." Kategori ON Kategori.id = Subkategori.kategori_id
			LEFT JOIN ".SEEKER." Seeker ON Seeker.id = SeekerSubscribe.seeker_id
			WHERE 1 $string_seeker $string_subkategori $string_filter
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
		
		if ($param['is_new'] == 1) {
			$string_seeker = (!empty($param['seeker_id'])) ? "AND seeker_id = '".$param['seeker_id']."'" : "";
			
			$select_query = "SELECT COUNT(*) TotalRecord FROM ".SEEKER_SUBSCRIBE." WHERE 1 $string_seeker";
		} else {
			$select_query = "SELECT FOUND_ROWS() TotalRecord";
		}
		
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$TotalRecord = $row['TotalRecord'];
		
		return $TotalRecord;
    }
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".SEEKER_SUBSCRIBE." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data berhasil dihapus.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
	
	function sent_mail() {
		$param_vacancy['vacancy_status_id'] = VACANCY_STATUS_APPROVE;
		$param_vacancy['publish_date_same'] = $this->config->item('current_datetime');
		$param_vacancy['limit'] = 1000;
		$array_vacancy = $this->Vacancy_model->get_array($param_vacancy);
		
		// make format base on category
		$array_category = array();
		foreach ($array_vacancy as $vacancy) {
			unset($vacancy['content']);
			unset($vacancy['content_short']);
			$array_category[$vacancy['subkategori_id']][] = $vacancy;
		}
		
		// sent mail each category
		foreach ($array_category as $subkategori_id => $temp) {
			// generate content
			$param_email['title'] = 'Jobs Subscribe';
			$param_email['message']  = "";
			foreach ($temp as $key => $vacancy) {
				$param_email['message'] .= "<br />";
				$param_email['message'] .= "Judul : ".$vacancy['nama']."<br />";
				$param_email['message'] .= "Nama perusahan : ".$vacancy['company_nama']."<br />";
				$param_email['message'] .= "Lokasi : ".$vacancy['kota_nama']."<br />";
				$param_email['message'] .= "Link : <a href=".$vacancy['vacancy_link'].">".$vacancy['vacancy_link']."</a>";
				$param_email['message'] .= "<br />";
				
				if ($key >= 9) {
					break;
				}
			}
			
			// collect subscriber
			$param_subscribe['subkategori_id'] = $vacancy['subkategori_id'];
			$param_subscribe['limit'] = 1000;
			$array_subscribe = $this->get_array($param_subscribe);
			
			// sent mail
			foreach ($array_subscribe as $seeker) {
				$param_email['to'] = $seeker['email'];
				sent_mail($param_email);
			}
		}
	}
}