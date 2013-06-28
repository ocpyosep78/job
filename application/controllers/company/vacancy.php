<?php
class vacancy extends COMPANY_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'company/vacancy' );
    }
	
	function grid() {
		$company = $this->Company_model->get_session();
		$_POST['is_edit'] = 1;
		$_POST['is_custom']  = '<img class="button-cursor view" src="'.base_url('static/img/button_view.png').'"> ';
		$_POST['is_custom'] .= '<img class="button-cursor edit" src="'.base_url('static/img/button_edit.png').'"> ';
		$_POST['is_custom'] .= '<img class="button-cursor delete" src="'.base_url('static/img/button_delete.png').'"> ';
		$_POST['company_id'] = $company['id'];
		
		$_POST['column'] = array( 'nama', 'vacancy_status_name', 'publish_date', 'close_date', 'total_view', 'total_seeker' );
		
		$array = $this->Vacancy_model->get_array($_POST);
		$count = $this->Vacancy_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			if (empty($_POST['id'])) {
				// reduce vacancy count
				$this->Company_model->vacancy_count_reduce(array( 'id' => $_POST['company_id'] ));
			}
			
			$result = $this->Vacancy_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Vacancy_model->delete($_POST);
		} else if ($action == 'get_by_id') {
			$result = $this->Vacancy_model->get_by_id($_POST);
		}
		
		echo json_encode($result);
	}
}