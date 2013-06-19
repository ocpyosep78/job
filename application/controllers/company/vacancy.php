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
		$_POST['company_id'] = $company['id'];
		$_POST['column'] = array( 'nama', 'position', 'vacancy_status_name', 'publish_date' );
		
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
			$result = $this->Vacancy_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Vacancy_model->delete($_POST);
		} else if ($action == 'get_by_id') {
			$result = $this->Vacancy_model->get_by_id($_POST);
		}
		
		echo json_encode($result);
	}
}