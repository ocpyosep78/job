<?php
class seeker extends EDITOR_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'editor/seeker' );
    }
	
	function grid() {
		$_POST['column'] = array( 'id', 'seeker_no', 'first_name', 'last_name', 'email' );
		$_POST['is_custom']  = '<img class="button-cursor view" src="'.base_url('static/img/button_view.png').'"> ';
		$_POST['is_custom'] .= '<img class="button-cursor mail" src="'.base_url('static/img/button_mail.png').'"> ';
		$_POST['is_custom'] .= '<img class="button-cursor edit" src="'.base_url('static/img/button_edit.png').'"> ';
		$_POST['is_custom'] .= '<img class="button-cursor delete" src="'.base_url('static/img/button_delete.png').'"> ';
		$_POST['is_custom_disable'] = 1;
		
		$array = $this->Seeker_model->get_array($_POST);
		$count = $this->Seeker_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			if (!empty($_POST['passwd']))
				$_POST['passwd'] = EncriptPassword($_POST['passwd']);
			
			$result = $this->Seeker_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Seeker_model->delete($_POST);
		} else if ($action == 'sent_mail') {
			sent_mail($_POST);
			
			$result['status'] = true;
			$result['message'] = 'Email berhasil terkirim';
		}
		
		echo json_encode($result);
	}
}