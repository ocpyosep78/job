<?php
class article extends EDITOR_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'editor/article' );
    }
	
	function grid() {
		$_POST['column'] = array( 'id', 'nama', 'subkategori_nama', 'article_status_nama', 'publish_date' );
		
		$array = $this->Article_model->get_array($_POST);
		$count = $this->Article_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Article_model->update($_POST);
			
			// tag
			$this->Article_Tag_model->delete(array( 'article_id' => $result['id'] ));
			if (!empty($_POST['tag'])) {
				$array_tag = explode(',', $_POST['tag']);
				foreach ($array_tag as $tag_name) {
					$tag = $this->Tag_model->get_by_id(array( 'title' => $tag_name, 'force_insert' => 1 ));
					$this->Article_Tag_model->update(array( 'article_id' => $result['id'], 'tag_id' => $tag['id'] ));
				}
			}
		} else if ($action == 'get_by_id') {
			$result = $this->Article_model->get_by_id($_POST);
			$array_tag = $this->Article_Tag_model->get_array(array( 'article_id' => $_POST['id'] ));
			$result['tag'] = get_tag_name($array_tag);
		} else if ($action == 'delete') {
			$result = $this->Article_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}