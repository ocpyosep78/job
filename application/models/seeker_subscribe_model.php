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
		$array_mail = array();
		
		// array vacancy
		$param_vacancy['vacancy_status_id'] = VACANCY_STATUS_APPROVE;
		$param_vacancy['publish_date_same'] = $this->config->item('current_datetime');
		$param_vacancy['limit'] = 1000;
		$array_vacancy = $this->Vacancy_model->get_array($param_vacancy);
		
		// array subscribe
		$param_subscribe['limit'] = 10000;
		$array_subscribe = $this->get_array($param_subscribe);
		
		// array mail
		$array_mail = array();
		foreach ($array_subscribe as $key) {
			if (!isset($array_mail[$key['email']])) {
				$array_mail[$key['email']] = array( 'counter' => 0, 'message' => '' );
			}
			
			$array_mail[$key['email']]['subkategori_id'][] = $key['subkategori_id'];
		}
		
		// insert vacancy to each email
		foreach ($array_vacancy as $vacancy) {
			$message  = "<br />";
			$message .= "Judul : ".$vacancy['nama']."<br />";
			$message .= "Nama perusahan : ".$vacancy['company_nama']."<br />";
			$message .= "Lokasi : ".$vacancy['kota_nama']."<br />";
//			$message .= "Subkategori : ".$vacancy['subkategori_nama']."<br />";
			$message .= "Link : <a href=".$vacancy['vacancy_link'].">".$vacancy['vacancy_link']."</a>";
			$message .= "<br />";
			
			foreach ($array_mail as $email => $seeker) {
				if (in_array($vacancy['subkategori_id'], $seeker['subkategori_id']) && $array_mail[$email]['counter'] <= 10) {
					$array_mail[$email]['message'] .= $message;
					$array_mail[$email]['counter']++;
				}
			}
		}
		
		// sent mail
		foreach ($array_mail as $email => $seeker) {
			if (empty($seeker['counter'])) {
				continue;
			}
			
			$param_email['to'] = $email;
			$param_email['title'] = 'Jobs Subscribe';
			$param_email['message'] = $seeker['message'];
			sent_mail($param_email);
		}
		
		return array( 'status' => true, 'message' => 'Email berhasil ' );
	}
}