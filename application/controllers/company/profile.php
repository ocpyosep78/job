<?php
class profile extends COMPANY_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'company/profile' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			if (empty($_POST['passwd'])) {
				unset($_POST['passwd']);
			} else {
				$_POST['passwd'] = EncriptPassword($_POST['passwd']);
			}
			
			$result = $this->Company_model->update($_POST);
		}
		
		if (!empty($_POST['update_session'])) {
			$company = $this->Company_model->get_by_id(array( 'id' => $_POST['id'] ));
			$this->Company_model->set_session($company);
		}
		
		echo json_encode($result);
	}
}