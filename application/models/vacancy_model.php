<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vacancy_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array(
			'id', 'company_id', 'subkategori_id', 'nama', 'position', 'vacancy_status_id', 'article_url', 'article_link', 'content_short',
			'content', 'opsi_1', 'opsi_2', 'kota_id', 'jenjang_id', 'jenis_pekerjaan_id', 'pengalaman_id', 'gaji', 'publish_date', 'close_date',
			'email_apply', 'email_quick', 'total_view', 'total_seeker', 'job_reff'
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
	
	function update_view($param) {
		$vacancy = $this->get_by_id(array( 'id' => $param['id'] ));
		
		$param_update['id'] = $vacancy['id'];
		$param_update['total_view'] = $vacancy['total_view']  + 1;
		$this->update($param_update);
	}
	
	function update_seeker($param) {
		$vacancy = $this->get_by_id(array( 'id' => $param['id'] ));
		
		$param_update['id'] = $vacancy['id'];
		$param_update['total_seeker'] = $vacancy['total_seeker']  + 1;
		$this->update($param_update);
	}
	
    function get_by_id($param) {
        $array = array();
       
        if (isset($param['id'])) {
            $select_query  = "
				SELECT Vacancy.*,
					Kategori.id kategori_id, Kota.id kota_id, Kota.propinsi_id, Industri.nama industri_nama, Kota.nama kota_nama,
					Company.nama company_nama, Company.alias company_alias, Company.website company_website, Company.logo company_logo, Company.banner company_banner,
					Kategori.nama kategori_nama, Subkategori.nama subkategori_nama
				FROM ".VACANCY." Vacancy
				LEFT JOIN ".COMPANY." Company ON Company.id = Vacancy.company_id
				LEFT JOIN ".INDUSTRI." Industri ON Industri.id = Company.industri_id
				LEFT JOIN ".SUBKATEGORI." Subkategori ON Subkategori.id = Vacancy.subkategori_id
				LEFT JOIN ".KATEGORI." Kategori ON Kategori.id = Subkategori.kategori_id
				LEFT JOIN ".VACANCY_STATUS." VacancyStatus ON VacancyStatus.id = Vacancy.vacancy_status_id
				LEFT JOIN ".KOTA." Kota ON Kota.id = Vacancy.kota_id
				LEFT JOIN ".JENJANG." Jenjang ON Jenjang.id = Vacancy.jenjang_id
				LEFT JOIN ".JENIS_PEKERJAAN." JenisPekerjaan ON JenisPekerjaan.id = Vacancy.jenis_pekerjaan_id
				LEFT JOIN ".PENGALAMAN." Pengalaman ON Pengalaman.id = Vacancy.pengalaman_id
				WHERE Vacancy.id = '".$param['id']."'
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
		
		// overwrite field name
		$param['field_replace']['id'] = 'Vacancy.id';
		$param['field_replace']['nama'] = 'Vacancy.nama';
		$param['field_replace']['position'] = 'Vacancy.position';
		$param['field_replace']['company_nama'] = 'Company.nama';
		$param['field_replace']['vacancy_status_name'] = 'VacancyStatus.nama';
		$param['field_replace']['vacancy_status_nama'] = 'VacancyStatus.nama';
		
		$string_company = (empty($param['company_id'])) ? '' : "AND Vacancy.company_id = '".$param['company_id']."'";
		$string_kategori = (empty($param['kategori_id'])) ? '' : "AND Kategori.id = '".$param['kategori_id']."'";
		$string_subkategori = (empty($param['subkategori_id'])) ? '' : "AND Subkategori.id = '".$param['subkategori_id']."'";
		$string_publish_date = (empty($param['publish_date'])) ? '' : "AND Vacancy.publish_date <= DATE('".$param['publish_date']."')";
		$string_vacancy_status = (empty($param['vacancy_status_id'])) ? '' : "AND Vacancy.vacancy_status_id = '".$param['vacancy_status_id']."'";
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'Vacancy.close_date DESC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS
				Vacancy.*,
				Company.nama company_nama, Company.alias company_alias, Company.website company_website, Company.logo company_logo, Company.banner company_banner,
				Company.email company_email,
				Kota.id kota_id, Kota.nama kota_nama, Kota.propinsi_id, Industri.nama industri_nama, VacancyStatus.nama vacancy_status_name,
				Kategori.id kategori_id, Kategori.nama kategori_nama, Subkategori.nama subkategori_nama, JenisPekerjaan.nama jenis_pekerjaan_nama,
				CompanyKota.nama company_kota_nama, VacancyStatus.nama vacancy_status_nama
			FROM ".VACANCY." Vacancy
			LEFT JOIN ".COMPANY." Company ON Company.id = Vacancy.company_id
			LEFT JOIN ".KOTA." CompanyKota ON CompanyKota.id = Company.kota_id
			LEFT JOIN ".INDUSTRI." Industri ON Industri.id = Company.industri_id
			LEFT JOIN ".SUBKATEGORI." Subkategori ON Subkategori.id = Vacancy.subkategori_id
			LEFT JOIN ".KATEGORI." Kategori ON Kategori.id = Subkategori.kategori_id
			LEFT JOIN ".VACANCY_STATUS." VacancyStatus ON VacancyStatus.id = Vacancy.vacancy_status_id
			LEFT JOIN ".KOTA." Kota ON Kota.id = Vacancy.kota_id
			LEFT JOIN ".JENJANG." Jenjang ON Jenjang.id = Vacancy.jenjang_id
			LEFT JOIN ".JENIS_PEKERJAAN." JenisPekerjaan ON JenisPekerjaan.id = Vacancy.jenis_pekerjaan_id
			LEFT JOIN ".PENGALAMAN." Pengalaman ON Pengalaman.id = Vacancy.pengalaman_id
			WHERE 1 $string_company $string_kategori $string_subkategori $string_publish_date $string_vacancy_status $string_filter
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
			$string_company = (!empty($param['company_id'])) ? "AND company_id = '".$param['company_id']."'" : "";
			
			$select_query = "SELECT COUNT(*) TotalRecord FROM ".VACANCY." Vacancy WHERE 1 $string_company";
		} else {
			$select_query = "SELECT FOUND_ROWS() TotalRecord";
		}
		
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
	
	function sync($row, $param = array()) {
		$row = StripArray($row, array('publish_date', 'close_date'));
		
		// approved vacancy cannot be edit
		if (isset($row['vacancy_status_id']) && $row['vacancy_status_id'] == VACANCY_STATUS_APPROVE) {
			if (isset($param['is_edit'])) {
				unset($param['is_edit']);
				$param['is_custom'] = '&nbsp;';
			}
		}
		
		if (isset($row['company_alias'])) {
			$row['company_link'] = base_url($row['company_alias']);
			$row['vacancy_link'] = base_url($row['company_alias'].'/'.$row['id'].'-'.get_name($row['nama']));
			$row['vacancy_quick_apply_link'] = $row['vacancy_link'].'/quick';
		}
		
		$row['company_logo_link'] = base_url('static/img/company.png');
		if (!empty($row['company_logo'])) {
			$row['company_logo_link'] = base_url('static/upload/'.$row['company_logo']);
		}
		
		$row['company_banner_link'] = base_url('static/img/company_banner.jpg');
		if (!empty($row['company_banner'])) {
			$row['company_banner_link'] = base_url('static/upload/'.$row['company_banner']);
		}
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
	
	function is_on_membership($param) {
		$membership = $this->Company_model->get_membership_detail(array( 'id' => $param['company_id'] ));
		
		$unix_closed_date = ConvertToUnixTime($param['close_date']);
		$unix_membership = ConvertToUnixTime($membership['membership_date']);
		
		$result = ($unix_closed_date > $unix_membership) ? false : true;
		return $result;
	}
}