<?php
class home extends EDITOR_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'editor/dashboard' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'sent_subscribe') {
			$result = $this->Seeker_Subscribe_model->sent_mail();
		}
		
		echo json_encode($result);
	}
}