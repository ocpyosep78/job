<?php
class news extends EDITOR_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'editor/news' );
    }
	
	function grid() {
		$_POST['column'] = array( 'nama', 'content_title' );
		$_POST['is_custom'] = '<img class="button-cursor edit" src="'.base_url('static/img/button_edit.png').'"> ';
		
		$array = $this->News_model->get_array($_POST);
		$count = $this->News_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->News_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->News_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}