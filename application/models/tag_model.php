<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tag_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array('id', 'nama', 'alias');
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, TAG);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, TAG);
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
            $select_query  = "SELECT * FROM ".TAG." WHERE id = '".$param['id']."' LIMIT 1";
        } else if (isset($param['alias'])) {
            $select_query  = "SELECT * FROM ".TAG." WHERE alias = '".$param['alias']."' LIMIT 1";
        } else if (isset($param['title'])) {
			$tag_alias = $this->get_name($param['title']);
			$select_query  = "SELECT * FROM ".TAG." WHERE alias = '".$tag_alias."' LIMIT 1";
        }
		
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
		
		if (!empty($param['force_insert']) && count($array) == 0) {
			$param = array( 'nama' => $param['title'], 'alias' => $tag_alias);
			$tag = $this->update($param);
			$array = array_merge($tag, $param);
		}
		
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'nama ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS Tag.*
			FROM ".TAG." Tag
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
	
	function get_name($value) {
		$value = trim($value);
		$value = strtolower($value);
		$value = preg_replace('/[^0-9a-z]+/i', '-', $value);
		$value = preg_replace('/^-/i', '', $value);
		$value = preg_replace('/-$/i', '', $value);
		
		return $value;
	}
	
	function get_popular() {
		$array_tag = array();
		$limit_date = date("Y-m-d", strtotime("-2 month"));
		
		// get from article
		$select_query = "
			SELECT tag_id, COUNT(*) total
			FROM ".ARTICLE." Article
			LEFT JOIN ".ARTICLE_TAG." ArticleTag ON Article.id = ArticleTag.article_id
			WHERE Article.publish_date >= DATE('$limit_date')
			GROUP BY tag_id
			LIMIT 0,10
		";
        $select_result = mysql_query($select_query) or die(mysql_error());
		while ( $row = mysql_fetch_assoc( $select_result ) ) {
			$array_tag[$row['tag_id']] = $row['total'];
		}
		
		// get from event
		$select_query = "
			SELECT tag_id, COUNT(*) total
			FROM ".EVENT." Event
			LEFT JOIN ".EVENT_TAG." EventTag ON Event.id = EventTag.event_id
			WHERE Event.publish_date >= DATE('$limit_date')
			GROUP BY tag_id
			LIMIT 0,10
		";
        $select_result = mysql_query($select_query) or die(mysql_error());
		while ( $row = mysql_fetch_assoc( $select_result ) ) {
			if (isset($array_tag[$row['tag_id']])) {
				$array_tag[$row['tag_id']] += $row['total'];
			} else {
				$array_tag[$row['tag_id']] = $row['total'];
			}
		}
		
		
		// get id popular tag
		arsort($array_tag);
		$array_filter = array();
		foreach ($array_tag as $key => $value) {
			$array_filter[] = $key;
			
			if (count($array_filter) >= 10) {
				break;
			}
		}
		
		// get real popular tag
		$result = array();
		$select_query = "
			SELECT *
			FROM ".TAG." Tag
			WHERE id IN (".implode(',', $array_filter).")
			LIMIT 0,10
		";
        $select_result = mysql_query($select_query) or die(mysql_error());
		while ( $row = mysql_fetch_assoc( $select_result ) ) {
			$result[] = $this->sync($row);
		}
		
		return $result;
	}
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".TAG." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data berhasil dihapus.';

        return $result;
    }
	
	function sync($row, $column = array()) {
		$row = StripArray($row);
		$row['tag_link'] = base_url('tags/'.$row['alias']);
		
		if (count($column) > 0) {
			$row = dt_view($row, $column, array('is_edit' => 1));
		}
		
		return $row;
	}
}