<?php
class vacancy_exam extends COMPANY_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'company/vacancy_exam' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			// collect apply
			if (empty($_POST['apply_id'])) {
				$param_apply_temp = array( 'vacancy_id' => $_POST['vacancy_id'], 'is_delete' => 0, 'limit' => 1000, 'apply_status_id' => APPLY_STATUS_INTERVIEW );
				$array_apply_temp = $this->Apply_model->get_array_seeker($param_apply_temp);
				foreach ($array_apply_temp as $apply) {
					$array_apply[] = $apply['id'];
				}
			} else {
				$array_apply[] = $_POST['apply_id'];
			}
			
			foreach ($array_apply as $apply_id) {
				$param_exam['apply_id'] = $apply_id;
				$param_exam['exam_time'] = $_POST['exam_time'];
				$param_exam['exam_file'] = $_POST['exam_file'];
				$param_exam['email'] = $_POST['email'];
				$param_exam['status'] = 'Created';
				$result = $this->Exam_model->update($param_exam);
				
				$param_apply['id'] = $apply_id;
				$param_apply['apply_status_id'] = VACANCY_STATUS_EXAM;
				$this->Apply_model->update($param_apply);
			}
			
		}
		
		echo json_encode($result);
	}
}