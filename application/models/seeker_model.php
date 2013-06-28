<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seeker_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array(
			'id', 'kelamin_id', 'kota_id', 'marital_id', 'seeker_no', 'first_name', 'last_name', 'email', 'tempat_lahir', 'tgl_lahir', 'address', 'phone', 'hp',
			'passwd', 'photo', 'last_login', 'last_update', 'agama', 'kebangsaan', 'facebook', 'twitter', 'ibu_kandung', 'file_resume', 'alias', 'reset',
			'validation', 'is_active'
		);
    }

    function update($param) {
        $result = array();
       
		// set default data
		$param['last_update'] = $this->config->item('current_datetime');
	   
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
	
	function update_no($param) {
		$param_update['id'] = $param['id'];
		$param_update['seeker_no'] = $this->get_max_no();
		$this->update($param_update);
	}
	
    function get_by_id($param) {
        $array = array();
       
        if (isset($param['id'])) {
            $select_query  = "
				SELECT Seeker.*, Kota.nama kota_nama, Propinsi.id propinsi_id, Propinsi.nama propinsi_nama, Negara.nama negara_nama,
					Kelamin.nama kelamin_nama, Marital.nama marital_nama
				FROM ".SEEKER." Seeker
				LEFT JOIN ".MARITAL." Marital ON Marital.id = Seeker.marital_id
				LEFT JOIN ".KELAMIN." Kelamin ON Kelamin.id = Seeker.kelamin_id
				LEFT JOIN ".KOTA." Kota ON Kota.id = Seeker.kota_id
				LEFT JOIN ".PROPINSI." Propinsi ON Propinsi.id = Kota.propinsi_id
				LEFT JOIN ".NEGARA." Negara ON Negara.id = Propinsi.negara_id
				WHERE Seeker.id = '".$param['id']."'
				LIMIT 1
			";
        } else if (isset($param['seeker_no'])) {
            $select_query  = "
				SELECT Seeker.*, Kota.nama kota_nama, Propinsi.id propinsi_id, Propinsi.nama propinsi_nama,
					Kelamin.nama kelamin_nama, Marital.nama marital_nama
				FROM ".SEEKER." Seeker
				LEFT JOIN ".MARITAL." Marital ON Marital.id = Seeker.marital_id
				LEFT JOIN ".KELAMIN." Kelamin ON Kelamin.id = Seeker.kelamin_id
				LEFT JOIN ".KOTA." Kota ON Kota.id = Seeker.kota_id
				LEFT JOIN ".PROPINSI." Propinsi ON Propinsi.id = Kota.propinsi_id
				WHERE Seeker.seeker_no = '".$param['seeker_no']."'
				LIMIT 1
			";
        } else if (isset($param['email'])) {
            $select_query  = "
				SELECT Seeker.*, Kota.nama kota_nama, Propinsi.id propinsi_id, Propinsi.nama propinsi_nama,
					Kelamin.nama kelamin_nama, Marital.nama marital_nama
				FROM ".SEEKER." Seeker
				LEFT JOIN ".MARITAL." Marital ON Marital.id = Seeker.marital_id
				LEFT JOIN ".KELAMIN." Kelamin ON Kelamin.id = Seeker.kelamin_id
				LEFT JOIN ".KOTA." Kota ON Kota.id = Seeker.kota_id
				LEFT JOIN ".PROPINSI." Propinsi ON Propinsi.id = Kota.propinsi_id
				WHERE Seeker.email = '".$param['email']."'
				LIMIT 1
			";
        } else if (isset($param['alias'])) {
            $select_query  = "SELECT * FROM ".SEEKER." WHERE alias = '".$param['alias']."' LIMIT 1";
        } else if (isset($param['reset'])) {
            $select_query  = "SELECT * FROM ".SEEKER." WHERE reset = '".$param['reset']."' LIMIT 1";
        } else if (isset($param['validation'])) {
            $select_query  = "SELECT * FROM ".SEEKER." WHERE validation = '".$param['validation']."' LIMIT 1";
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
		$param['field_replace']['usia'] = 'Seeker.tgl_lahir';
		$param['field_replace']['full_name'] = 'Seeker.first_name';
		
		$string_is_active = (isset($param['is_active'])) ? "AND Seeker.is_active = '".$param['is_active']."'" : '';
		$string_with_alias = (isset($param['with_alias'])) ? "AND Seeker.alias != ''" : '';
		$string_with_photo = (isset($param['with_photo'])) ? "AND Seeker.photo != ''" : '';
		$string_with_tgl_lahir = (isset($param['with_tgl_lahir'])) ? "AND Seeker.tgl_lahir != ''" : '';
		$string_with_file_resume = (isset($param['with_file_resume'])) ? "AND Seeker.file_resume != ''" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'Seeker.first_name ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS Seeker.*, Jenjang.nama jenjang_nama, Kota.nama kota_nama,
				SeekerSummary.score, SeekerSummary.school, SeekerSummary.experience, Marital.nama marital_nama
			FROM ".SEEKER." Seeker
			LEFT JOIN ".SEEKER_SUMMARY." SeekerSummary ON SeekerSummary.seeker_id = Seeker.id
			LEFT JOIN ".JENJANG." Jenjang ON Jenjang.id = SeekerSummary.jenjang_id
			LEFT JOIN ".MARITAL." Marital ON Marital.id = Seeker.marital_id
			LEFT JOIN ".KOTA." Kota ON Kota.id = Seeker.kota_id
			WHERE 1 $string_is_active $string_with_alias $string_with_photo $string_with_tgl_lahir $string_with_file_resume $string_filter
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
			$select_query = "SELECT COUNT(*) TotalRecord FROM ".SEEKER."";
		} else {
			$select_query = "SELECT FOUND_ROWS() TotalRecord";
		}
		
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$TotalRecord = $row['TotalRecord'];
		
		return $TotalRecord;
    }
	
	function get_alias($id, $title) {
		$alias = trim(strtolower($title));
		$alias = preg_replace('/[^a-z0-9]+/i', '', $alias);
		
		$loop = true;
		do {
			$seeker = $this->get_by_id(array('alias' => $alias));
			if (count($seeker) == 0) {
				$loop = false;
				break;
			} else if (count($seeker) > 0 && $seeker['id'] == $id) {
				$loop = false;
				break;
			} else {
				preg_match('/-(\d)+$/i', $alias, $Match);
				if (count($Match) == 0) {
					$alias .= '-1';
				} else {
					$Increment = (isset($Match[1])) ? $Match[1] + 1 : 2;
					$alias = preg_replace('/-(\d)+$/i', '-' . $Increment, $alias);
				}
			}
		} while ($loop);
		
		return $alias;
	}
	
	function get_resume($param) {
		$seeker = $this->get_by_id($param);
		$seeker_summary = $this->Seeker_Summary_model->get_by_id(array( 'seeker_id' => $seeker['id'] ));
		$result = array( 'is_pass' => true, 'message' => 'Siap melamar lowongan' );
		
		if (empty($seeker['full_name'])) {
			
			$result = array( 'is_pass' => false, 'message' => 'Silahkan melengkapi biodata anda' );
		} else if (empty($seeker['photo'])) {
			$result = array( 'is_pass' => false, 'message' => 'Silahkan memperbarui photo anda.' );
		} else if (empty($seeker['file_resume'])) {
			$result = array( 'is_pass' => false, 'message' => 'Silahkan upload resume anda.' );
		} else if (empty($seeker_summary['school'])) {
			$result = array( 'is_pass' => false, 'message' => 'Silahkan memperbarui sekolah terakhir anda.' );
		} else if (empty($seeker_summary['score'])) {
			$result = array( 'is_pass' => false, 'message' => 'Silahkan memperbarui nilai terakhir anda.' );
		} else if (empty($seeker_summary['jenjang_nama'])) {
			$result = array( 'is_pass' => false, 'message' => 'Silahkan pendidikan terakhir anda.' );
		}
		
		return $result;
	}
	
	function get_max_no() {
		$seeker_no = '50124587';
		$select_query  = "SELECT MAX(Seeker.seeker_no) seeker_no FROM ".SEEKER." Seeker LIMIT 1";
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $seeker_no = $row['seeker_no'] + 1;
        }
       
        return $seeker_no;
	}
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".SEEKER." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data berhasil dihapus.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row, array( 'tgl_lahir' ));
		$row['full_name'] = $row['first_name'];
		$row['usia'] = get_usia($row['tgl_lahir']);
		if (isset($row['first_name']) && isset($row['last_name'])) {
			$row['full_name'] = trim($row['first_name'].' '.$row['last_name']);
		}
		
		// link
		$row['seeker_link'] = base_url();
		if (!empty($row['alias'])) {
			$row['seeker_link'] = base_url('seeker/publish/index/'.$row['alias']);
		}
		if (!empty($row['seeker_no'])) {
			$row['seeker_no_link'] = base_url('seeker/publish/index/'.$row['seeker_no']);
			$row['seeker_no_pdf'] = base_url('seeker/publish/convert/'.$row['seeker_no']);
		}
		
		$row['photo_link'] = base_url('static/img/no-images.jpg');
		if (!empty($row['photo'])) {
			$row['photo_link'] = base_url('static/upload/'.$row['photo']);
			$row['photo_path'] = $this->config->item('base_path').'/static/upload/'.$row['photo'];
			$row['photo_path'] = str_replace('\\', '/', $row['photo_path']);
		}
		
		$row['file_resume_link'] = '';
		if (!empty($row['file_resume'])) {
			$row['file_resume_link'] = base_url('static/upload/'.$row['file_resume']);
			$row['file_resume_path'] = $this->config->item('base_path').'/static/upload/'.$row['file_resume'];
			$row['file_resume_path'] = str_replace('\\', '/', $row['file_resume_path']);
		}
		
		/*
		if (count($column) > 0) {
			$row = dt_view($row, $column, array('is_edit' => 1));
		}
		/* */
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
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