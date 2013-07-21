<?php
class subscribe extends SEEKER_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'seeker/subscribe' );
    }
	
	function grid() {
		$_POST['column'] = array( 'kategori_nama', 'subkategori_nama' );
		$_POST['is_custom']  = '<img class="button-cursor edit" src="'.base_url('static/img/button_edit.png').'"> ';
		$_POST['is_custom'] .= '<img class="button-cursor delete" src="'.base_url('static/img/button_remove.png').'"> ';
		
		$array = $this->Seeker_Subscribe_model->get_array($_POST);
		$count = $this->Seeker_Subscribe_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$param_count = $_POST;
			$param_count['is_new'] = 1;
			$count = $this->Seeker_Subscribe_model->get_count($param_count);
			
			if ($count >= 5 && empty($_POST['id'])) {
				$result['status'] = '0';
				$result['message'] = 'Maksimal 5 kategori yang dapat disimpan.';
			} else {
				$result = $this->Seeker_Subscribe_model->update($_POST);
			}
		} else if ($action == 'delete') {
			$result = $this->Seeker_Subscribe_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}