<?php
class membership extends EDITOR_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'editor/membership' );
    }
	
	function grid() {
		$_POST['column'] = array( 'date_request', 'company_nama', 'post_count', 'date_count', 'price', 'status' );
		$_POST['is_pending']  = '<img class="button-cursor confirm" src="'.base_url('static/img/button_check.png').'"> ';
		$_POST['is_pending'] .= '<img class="button-cursor delete" src="'.base_url('static/img/button_remove.png').'"> ';
		
		$array = $this->Company_Membership_model->get_array($_POST);
		$count = $this->Company_Membership_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			if (isset($_POST['status']) && $_POST['status'] == 'confirm') {
				$membership = $this->Company_Membership_model->get_by_id(array( 'id' => $_POST['id'] ));
				$company = $this->Company_model->get_by_id(array( 'id' => $membership['company_id'] ));
				
				// add vancancy count
				$param_update['vacancy_count_left'] = $company['vacancy_count_left'] + $membership['post_count'];
				
				// add duration
				$current_date = $this->config->item('current_date');
				$membership_date = (empty($company['membership_date'])) ? $current_date : $company['membership_date'];
				if (ConvertToUnixTime($membership_date) < ConvertToUnixTime($current_date)) {
					$membership_date = $current_date;
				}
				$param_update['membership_date'] = AddDate($membership_date, $membership['date_count']);
				
				// update
				$param_update['id'] = $company['id'];
				$this->Company_model->update($param_update);
			}
			
			$result = $this->Company_Membership_model->update($_POST);
		}
		
		echo json_encode($result);
	}
}