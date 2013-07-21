<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exam_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'vacancy_id', 'exam_time', 'exam_file', 'email' );
    }
	
    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, EXAM);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, EXAM);
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
            $select_query  = "SELECT * FROM ".EXAM." WHERE id = '".$param['id']."' LIMIT 1";
        } else if (isset($param['vacancy_id'])) {
            $select_query  = "SELECT * FROM ".EXAM." WHERE vacancy_id = '".$param['vacancy_id']."' LIMIT 1";
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
		$string_sorting = GetStringSorting($param, @$param['column'], 'apply_id ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS Exam.*
			FROM ".EXAM." Exam
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
	
	function get_total_time($exam_time) {
		preg_match('/(\d+)\H/i', $exam_time, $match);
		$hour = (isset($match[1])) ? $match[1] : 0;
		$total_time = $hour * 3600;
		
		return $total_time;
	}
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".EXAM." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data berhasil dihapus.';

        return $result;
    }
	
	function sync($row, $column = array()) {
		$row = StripArray($row, array( 'exam_time_end' ));
		
		// file link
		$row['exam_file_link'] = base_url('static/upload/'.$row['exam_file']);
		
		if (count($column) > 0) {
			$row = dt_view($row, $column, array('is_edit' => 1));
		}
		
		return $row;
	}
	
	function has_exam($param) {
		$exam = $this->get_by_id(array( 'vacancy_id' => $param['vacancy_id'] ));
		$has_exam = (count($exam) == 0) ? false : true;
		return $has_exam;
	}
}