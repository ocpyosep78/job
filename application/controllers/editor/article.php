<?php
class article extends EDITOR_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'editor/article' );
    }
	
	function grid() {
		$_POST['column'] = array( 'nama', 'subkategori_nama', 'article_status_nama', 'publish_date' );
		
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
		} else if ($action == 'delete') {
			$result = $this->Article_model->delete($_POST);
		} else if ($action == 'get_by_id') {
			$result = $this->Article_model->get_by_id($_POST);
		}
		
		echo json_encode($result);
	}
}