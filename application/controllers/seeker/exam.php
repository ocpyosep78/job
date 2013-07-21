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
			$seeker = $this->Seeker_model->get_session();
			$exam = $this->Exam_model->get_by_id(array( 'id' => $_POST['exam_id'] ));
			$apply = $this->Apply_model->get_by_id(array( 'vacancy_id' => $exam['vacancy_id'], 'seeker_id' => $seeker['id'] ));
			
			$param_seeker_exam['vacancy_id'] = $exam['vacancy_id'];
			$param_seeker_exam['seeker_id'] = $seeker['id'];
			$seeker_exam = $this->Seeker_Exam_model->get_by_id($param_seeker_exam);
			
			if (count($seeker_exam) == 0) {
				$param_insert['exam_id'] = $_POST['exam_id'];
				$param_insert['seeker_id'] = $seeker['id'];
				$param_insert['exam_start'] = $this->config->item('current_datetime');
				$this->Seeker_Exam_model->update($param_insert);
				
				$param_apply['id'] = $apply['id'];
				$param_apply['exam_status_id'] = EXAM_DOWNLOAD;
				$result = $this->Apply_model->update($param_apply);
			}
			
			$result['exam_file_link'] = $exam['exam_file_link'];
			$result['status'] = 1;
		}
		else if ($action == 'upload-exam') {
			$seeker = $this->Seeker_model->get_session();
			$exam = $this->Exam_model->get_by_id(array( 'id' => $_POST['exam_id'] ));
			$vacancy = $this->Vacancy_model->get_by_id(array( 'id' => $exam['vacancy_id'] ));
			$apply = $this->Apply_model->get_by_id(array( 'vacancy_id' => $exam['vacancy_id'], 'seeker_id' => $seeker['id'] ));
			
			// check time
			$is_over = $this->Seeker_Exam_model->is_over(array( 'vacancy_id' => $exam['vacancy_id'], 'seeker_id' => $seeker['id'] ));
			if ($is_over) {
				$result['message'] = 'Waktu ujian telah berakhir, anda tidak dapat melanjutkan.';
				echo json_encode($result);
				exit;
			}
			
			// seeker exam
			$seeker_exam = $this->Seeker_Exam_model->get_by_id(array( 'vacancy_id' => $vacancy['id'], 'seeker_id' => $seeker['id'] ));
			
			// update seeker exam
			$param_exam['id'] = $seeker_exam['id'];
			$param_exam['exam_file'] = $_POST['exam_file'];
			$this->Seeker_Exam_model->update($param_exam);
			
			// update apply
			$param_apply['id'] = $apply['id'];
			$param_apply['exam_status_id'] = EXAM_DONE;
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