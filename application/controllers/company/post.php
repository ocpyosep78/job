<?php
class post extends COMPANY_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'company/post' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			// make sure 1 record for 1 company
			$company = $this->Company_model->get_session();
			$post = $this->Company_Post_model->get_by_id(array( 'company_id' => $company['id'] ));
			$_POST['id'] = @$post['id'];
			
			$result = $this->Company_Post_model->update($_POST);
		}
		
		echo json_encode($result);
	}
}