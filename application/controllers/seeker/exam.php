<?php
class exam extends SEEKER_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'seeker/exam' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		// load email
		$this->load->library('phpmailer');
		
		$result = array( 'status' => 0 );
		if ($action == 'take-exam') {
			$param_exam['id'] = $_POST['exam_id'];
			$param_exam['status '] = 'Download';
			$param_exam['exam_time_end'] = $this->config->item('current_datetime');
			$this->Exam_model->update($param_exam);
			
			$result = $this->Exam_model->get_by_id(array( 'id' => $_POST['exam_id'] ));
			$result['status'] = 1;
		}
		else if ($action == 'upload-exam') {
			$exam = $this->Exam_model->get_by_id(array( 'id' => $_POST['exam_id'] ));
			$apply = $this->Apply_model->get_by_id(array( 'id' => $exam['apply_id'] ));
			$vacancy = $this->Vacancy_model->get_by_id(array( 'id' => $apply['vacancy_id'] ));
			$seeker = $this->Seeker_model->get_by_id(array( 'id' => $apply['seeker_id'] ));
			
			// check time
			$total_time = $this->Exam_model->get_total_time($exam['exam_time']);
			$current_time = GetUnixTime($this->config->item('current_datetime'));
			$end_time = GetUnixTime($exam['exam_time_end']);
			$total_time = ($end_time + $total_time) - $current_time;
			$is_over = ($total_time <= 0) ? true : false;
			if ($is_over) {
				$result['message'] = 'Waktu ujian telah berakhir, anda tidak dapat melanjutkan.';
				echo json_encode($result);
				exit;
			}
			
			// update exam
			$param_exam['id'] = $exam['id'];
			$param_exam['status'] = 'Done';
			$this->Exam_model->update($param_exam);
			
			// update apply
			$param_apply['id'] = $exam['apply_id'];
			$param_apply['apply_status_id'] = VACANCY_STATUS_DONE;
			$result = $this->Apply_model->update($param_apply);
			$result['status'] = 1;
			
			$file_exam = $this->config->item('base_path').'/static/upload/'.$_POST['exam_file'];
			$MailParam = array(
				'EmailTo' => $exam['email'],
				'EmailFrom' => 'no-reply@duniakarir.com',
				'EmailFromName' => 'Dunia Karir',
				'EmailSubject' => $vacancy['nama'],
				'EmailBody' => 'Berikut hasil ujian dari '.$seeker['full_name'].' pada '.$this->config->item('current_datetime'),
				'Attachment' => array( $file_exam )
			);
			SmtpMailer($MailParam);
		}
		
		echo json_encode($result);
	}
}