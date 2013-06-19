<?php
class daftar extends EDITOR_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'subscribe/daftar' );
    }
	
	function grid() {
		$_POST['column'] = array( 'email', 'jenis_subscribe_nama', 'status_text' );
		$_POST['is_update_subscribe'] = 1;
		
		$array = $this->Subscribe_model->get_array($_POST);
		$count = $this->Subscribe_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Subscribe_model->update($_POST);
		}
		
		echo json_encode($result);
	}
}