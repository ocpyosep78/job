<?php
class sent extends SEEKER_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'seeker/sent' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array( 'status' => false );
		if ($action == 'sent_mail') {
			$result = array( 'status' => true, 'message' => 'Email berhasil dikirim' );
		}
		
		echo json_encode($result);
	}
}