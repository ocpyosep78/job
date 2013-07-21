<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seeker_Exam_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'exam_id', 'seeker_id', 'exam_start', 'exam_file' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, SEEKER_EXAM);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, SEEKER_EXAM);
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
            $select_query  = "SELECT * FROM ".SEEKER_EXAM." WHERE id = '".$param['id']."' LIMIT 1";
        } else if (isset($param['vacancy_id']) && isset($param['seeker_id'])) {
			$select_query  = "
				SELECT *
				FROM ".SEEKER_EXAM." SeekerExam
				LEFT JOIN ".EXAM." Exam ON Exam.id = SeekerExam.exam_id
				WHERE
					Exam.vacancy_id = '".$param['vacancy_id']."'
					AND SeekerExam.seeker_id = '".$param['seeker_id']."'
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
		
		$string_seeker = (empty($param['seeker_id'])) ? '' : "AND SeekerExam.seeker_id = '".$param['seeker_id']."'";
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'nama ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS SeekerExam.*
			FROM ".SEEKER_EXAM." SeekerExam
			WHERE 1 $string_seeker $string_filter
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
		$delete_query  = "DELETE FROM ".SEEKER_EXAM." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data berhasil dihapus.';

        return $result;
    }
	
	function sync($row, $column = array()) {
		$row = StripArray($row, array( 'exam_start' ));
		
		return $row;
	}
	
	function is_start($param) {
		$seeker_exam = $this->get_by_id(array( 'vacancy_id' => $param['vacancy_id'], 'seeker_id' => $param['seeker_id'] ));
		
		$result = (count($seeker_exam) == 0) ? false : true;
		return $result;
	}
	
	function is_over($param) {
		$is_start = $this->is_start($param);
		if (! $is_start) {
			return false;
		}
		
		// no end time
		$exam = $this->Exam_model->get_by_id(array( 'vacancy_id' => $param['vacancy_id'] ));
		if (empty($exam['exam_time'])) {
			return false;
		}
		
		// convert to second
		$time_left = $this->get_time_left($param);
		
		$result = ($time_left < 0) ? true : false;
		return $result;
	}
	
	function get_time_left($param) {
		$seeker_exam = $this->get_by_id($param);
		$exam = $this->Exam_model->get_by_id(array( 'vacancy_id' => $param['vacancy_id'] ));
		
		// get start time
		if (count($seeker_exam) == 0) {
			$start_time = GetUnixTime($this->config->item('current_datetime'));
		} else {
			$start_time = GetUnixTime($seeker_exam['exam_start']);
		}
		
		$current_time = GetUnixTime($this->config->item('current_datetime'));
		$addition_time = $this->Exam_model->get_total_time($exam['exam_time']);
		$download_time = 3 * 60;
		$end_time = $start_time + $addition_time + $download_time;
		$left_time = $end_time - $current_time;
		
		return $left_time;
	}
}