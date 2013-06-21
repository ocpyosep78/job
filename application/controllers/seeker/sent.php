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
			$param = $_POST;
			$this->load->library('phpmailer');
			$seeker = $this->Seeker_model->get_session();
			
			// attachment
			$attach = array();
			if (!empty($param['with_resume'])) {
				$attach[] = $seeker['file_resume_path'];
			}
			if (!empty($param['with_photo'])) {
				$attach[] = $seeker['photo_path'];
			}
			if (!empty($param['surat_lamaran_id'])) {
				$surat_lamaran = $this->Surat_Lamaran_model->get_by_id(array( 'id' => $param['surat_lamaran_id'] ));
				
				$surat_pdf = base_url('seeker/pdf/lamaran/'.$param['surat_lamaran_id']);
				$content_pdf = file_get_contents($surat_pdf);
				
				$file_name = $this->config->item('base_path').'/static/_temp/'.$surat_lamaran['nama'].'.pdf';
				@unlink($file_name);
				Write($file_name, $content_pdf);
				
				$attach[] = $file_name;
			}
			
			// Sent Email
			$content = $this->load->view( 'seeker/email/lamaran', array( 'seeker' => $seeker, 'content' => $param['content'] ), true );
			$MailParam = array(
				'EmailTo' => $param['to'],
				'EmailFrom' => 'no-reply@duniakarir.com',
				'EmailFromName' => 'Dunia Karir',
				'EmailSubject' => $param['subject'],
				'EmailBody' => $content,
				'Attachment' => $attach
			);
			$result = SmtpMailer($MailParam);
			$result['status'] = ($result['success']) ? true : false;
			
			// delete file
			@unlink($file_name);
		}
		
		echo json_encode($result);
	}
}