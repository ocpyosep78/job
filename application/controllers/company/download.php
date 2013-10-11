<?php
class download extends COMPANY_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'company/download' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update_status') {
			$this->Apply_model->update_status_view($_POST);
		} else if ($action == 'update_mail') {
			$param_update = array( 'id' => $_POST['id'], 'apply_status_id' => $_POST['apply_status_id'] );
			$result = $this->Apply_model->update($param_update);
		} else if ($action == 'update_exam') {
			$apply = $this->Apply_model->get_by_id(array( 'id' => $_POST['apply_id'] ));
			$seeker = $this->Seeker_model->get_by_id(array( 'id' => $apply['seeker_id'] ));
			
			$param_mail['to'] = $seeker['email'];
			$param_mail['title'] = 'Pembertahuan Exam';
			$param_mail['message'] = $this->load->view( 'company/exam_notice', array( 'apply' => $apply ), true );
			sent_mail($param_mail);
			
			$param_apply = array( 'id' => $_POST['apply_id'], 'exam_status_id' => EXAM_OPEN );
			$result = $this->Apply_model->update($param_apply);
		} else if ($action == 'update_exam_all') {
			$result['status'] = 0;
			$result['message'] = 'Tidak ada pelamar baru yang dapat didaftarkan.';
			
			$array_apply = $this->Apply_model->get_array(array( 'vacancy_id' => $_POST['vacancy_id'] ));
			foreach ($array_apply as $apply) {
				if (empty($apply['exam_status_id'])) {
					$seeker = $this->Seeker_model->get_by_id(array( 'id' => $apply['seeker_id']));
					$param_mail['to'] = $seeker['email'];
					$param_mail['title'] = 'Pembertahuan Exam';
					$param_mail['message'] = $this->load->view( 'company/exam_notice', array( 'apply' => $apply ), true );
					sent_mail($param_mail);
					
					$param_apply = array( 'id' => $apply['id'], 'exam_status_id' => EXAM_OPEN );
					$result = $this->Apply_model->update($param_apply);
				}
			}
		}
		
		echo json_encode($result);
	}
	
	function view() {
		preg_match('/([\d]+)$/i', $_SERVER['REQUEST_URI'], $match);
		$seeker_no = (!empty($match[1])) ? $match[1] : '';
		
		$seeker = $this->Seeker_model->get_by_id(array( 'seeker_no' => $seeker_no ));
		$seeker = $this->Seeker_model->get_by_id(array( 'id' => $seeker['id'] ));
		
		$this->load->view( 'seeker/publish_company', array( 'seeker' => $seeker, 'is_company' => true ) );
	}
}