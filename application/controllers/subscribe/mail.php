<?php
class mail extends EDITOR_Controller {
    function __construct() {
        parent::__construct();
		$this->load->library('phpmailer');
    }
    
    function index() {
		$this->load->view( 'subscribe/mail' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'sent_mail') {
			$mail_type = $_POST['mail_type'];
			if ($mail_type == 1) {
				$array_user[] = array( 'email' => $_POST['to'] );
			} else if ($mail_type == 2) {
				$array_user = $this->Seeker_model->get_array(array( 'limit' => 10000 ));
			} else if ($mail_type == 3) {
				$array_user = $this->Company_model->get_array(array( 'limit' => 10000 ));
			} else if ($mail_type == 4) {
				$array_seeker = $this->Seeker_model->get_array(array( 'limit' => 10000 ));
				$array_company = $this->Company_model->get_array(array( 'limit' => 10000 ));
				$array_user = array_merge($array_seeker, $array_company);
			}
			
			$param['title'] = $_POST['subject'];
			$param['message'] = $_POST['content'];
			foreach ($array_user as $user) {
				$param['to'] = $user['email'];
				sent_mail($_POST);
			}
			
			$result['status'] = true;
			$result['message'] = 'Email berhasil terkirim';
		}
		
		echo json_encode($result);
	}
}