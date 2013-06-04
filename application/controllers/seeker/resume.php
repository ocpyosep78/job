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
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Seeker_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Seeker_model->delete($_POST);
		}
		
		if (!empty($_POST['update_seesion'])) {
			$seeker = $this->Seeker_model->get_by_id(array( 'id' => $_POST['id'] ));
			$this->Seeker_model->set_session($seeker);
		}
		
		echo json_encode($result);
	}
}