<?php
class apply extends SEEKER_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'seeker/apply' );
    }
	
	function grid() {
		$seeker = $this->Seeker_model->get_session();
		$_POST['is_delete'] = 0;
		$_POST['seeker_id'] = $seeker['id'];
		$_POST['column'] = array( 'position', 'company_nama', 'location', 'apply_date', 'apply_status_name' );
		
		$array = $this->Apply_model->get_array($_POST);
		$count = $this->Apply_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Apply_model->update($_POST);
		}
		
		echo json_encode($result);
	}
}