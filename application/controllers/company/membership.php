<?php
class membership extends COMPANY_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'company/membership' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$this->Company_Membership_model->set_cancel(array( 'company_id' => $_POST['company_id'] ));
			
			if (empty($_POST['id'])) {
				$_POST['status'] = 'pending';
				$_POST['date_request'] = $this->config->item('current_datetime');
			}
			$result = $this->Company_Membership_model->update($_POST);
		}
		
		echo json_encode($result);
	}
}