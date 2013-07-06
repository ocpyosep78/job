<?php
class vacancy extends EDITOR_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'editor/vacancy' );
    }
	
	function grid() {
		$_POST['column'] = array( 'id', 'nama', 'company_nama', 'vacancy_status_nama', 'publish_date', 'close_date' );
		$_POST['is_custom']  = '<img class="button-cursor view" src="'.base_url('static/img/button_view.png').'"> ';
		$_POST['is_custom'] .= '<img class="button-cursor mail" src="'.base_url('static/img/button_mail.png').'"> ';
		$_POST['is_custom'] .= '<img class="button-cursor edit" src="'.base_url('static/img/button_edit.png').'"> ';
		$_POST['is_custom'] .= '<img class="button-cursor confirm" src="'.base_url('static/img/button_check.png').'"> ';
		$_POST['is_custom'] .= '<img class="button-cursor delete" src="'.base_url('static/img/button_remove.png').'"> ';
		
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
		} else if ($action == 'get_by_id') {
			$result = $this->Vacancy_model->get_by_id(array( 'id' => $_POST['id'] ));
		} else if ($action == 'sent_mail') {
			sent_mail($_POST);
			
			$result['status'] = true;
			$result['message'] = 'Email berhasil terkirim';
		}
		
		echo json_encode($result);
	}
}