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
			// Sent Email
			$MailParam = array(
				'EmailTo' => $_POST['to'],
				'EmailFrom' => 'no-reply@duniakarir.com',
				'EmailFromName' => 'Dunia Karir',
				'EmailSubject' => $_POST['subject'],
				'EmailBody' => $_POST['content']
			);
			$result = SmtpMailer($MailParam);
		}
		
		echo json_encode($result);
	}
}