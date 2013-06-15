<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array('id', 'editor_id', 'nama', 'alias', 'content', 'photo', 'photo_desc', 'lokasi', 'waktu', 'google_map', 'publish_date');
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, EVENT);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, EVENT);
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
				SELECT Event.*, Editor.nama editor_name
				FROM ".EVENT." Event
				LEFT JOIN ".EDITOR." Editor ON Editor.id = Event.Editor_id
				WHERE Event.id = '".$param['id']."'
				LIMIT 1
			";
        } else if (isset($param['alias'])) {
            $select_query  = "
				SELECT Event.*, Editor.nama editor_name
				FROM ".EVENT." Event
				LEFT JOIN ".EDITOR." Editor ON Editor.id = Event.Editor_id
				WHERE Event.alias = '".$param['alias']."'
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
		$string_sorting = GetStringSorting($param, @$param['column'], 'nama ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS Event.*
			FROM ".EVENT." Event
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
			$select_query = "SELECT COUNT(*) TotalRecord FROM ".EVENT."";
		} else {
			$select_query = "SELECT FOUND_ROWS() TotalRecord";
		}
		
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$TotalRecord = $row['TotalRecord'];
		
		return $TotalRecord;
    }
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".EVENT." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data berhasil dihapus.';

        return $result;
    }
	
	function sync($row, $column = array()) {
		$row = StripArray($row, array('publish_date'));
		$row['event_link'] = base_url('event/'.$row['alias']);
		$row['content_html'] = save_tinymce($row['content']);
		$row['google_map_html'] = save_tinymce($row['google_map']);
		$row['content_short'] = GetLengthChar($row['content'], 175, '');
		
		if (! empty($row['photo'])) {
			$row['photo_link'] = base_url('static/upload/'.$row['photo']);
		} 
		
		if (count($column) > 0) {
			unset($row['content']);
			unset($row['google_map']);
			
			$row = dt_view($row, $column, array('is_edit' => 1));
		}
		
		return $row;
	}
	
	function resize_image($param) {
		if (!empty($param['photo'])) {
			$image_source = $this->config->item('base_path').'/static/upload/'.$param['photo'];
			ImageResize($image_source, $image_source, 700, 350, 1);
		}
	}
}