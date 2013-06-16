<?php
class pengalaman extends EDITOR_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'master/pengalaman' );
    }
	
	function grid() {
		$_POST['column'] = array( 'nama' );
		
		$array = $this->Pengalaman_model->get_array($_POST);
		$count = $this->Pengalaman_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Pengalaman_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Pengalaman_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}