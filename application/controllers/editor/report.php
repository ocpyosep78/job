<?php
class report extends EDITOR_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'editor/report' );
    }
	
	function grid() {
		$_POST['column'] = array( 'id', 'company_nama', 'email', 'content' );
		$_POST['is_custom'] = '<img class="button-cursor delete" src="'.base_url('static/img/button_delete.png').'"> ';
		
		$array = $this->Report_model->get_array($_POST);
		$count = $this->Report_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Report_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Report_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}