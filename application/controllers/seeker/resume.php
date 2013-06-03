<?php
class resume extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'seeker/resume' );
    }
    
    function edit() {
		$this->load->view( 'seeker/resume_edit' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Resume_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Resume_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}