<?php
class resume extends SEEKER_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'seeker/resume' );
    }
    
    function edit() {
		$this->load->view( 'seeker/resume_edit' );
    }
	
	function grid() {
		$seeker = $this->Seeker_model->get_session();
		$_POST['seeker_id'] = $seeker['id'];
		
		$grid_name = $_POST['grid_name'];
		if ($grid_name == 'seeker_expert') {
			$_POST['column'] = array( 'content' );
			$array = $this->Seeker_Expert_model->get_array($_POST);
			$count = $this->Seeker_Expert_model->get_count();
		}
		
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Seeker_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Seeker_model->delete($_POST);
		}
		
		else if ($action == 'update_seeker_expert') {
			$result = $this->Seeker_Expert_model->update($_POST);
		} else if ($action == 'delete_seeker_expert') {
			$result = $this->Seeker_Expert_model->delete($_POST);
		}
		
		if (!empty($_POST['update_session'])) {
			$seeker = $this->Seeker_model->get_by_id(array( 'id' => $_POST['id'] ));
			$this->Seeker_model->set_session($seeker);
		}
		
		echo json_encode($result);
	}
}