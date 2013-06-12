<?php
class download extends COMPANY_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'company/download' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update_mail') {
			$param_update = array( 'id' => $_POST['id'], 'apply_status_id' => $_POST['apply_status_id'] );
			$result = $this->Apply_model->update($param_update);
		}
		
		echo json_encode($result);
	}
	
	function view() {
		preg_match('/([\d]+)$/i', $_SERVER['REQUEST_URI'], $match);
		$seeker_no = (!empty($match[1])) ? $match[1] : '';
		
		$this->load->view( 'seeker/resume', array( 'seeker_no' => $seeker_no ) );
	}
}