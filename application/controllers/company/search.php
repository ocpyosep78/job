<?php
class search extends COMPANY_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'company/search' );
    }
	
	function grid() {
		$_POST['is_active'] = 1;
		$_POST['with_alias'] = 1;
		$_POST['with_photo'] = 1;
		$_POST['with_tgl_lahir'] = 1;
		$_POST['with_file_resume'] = 1;
		$_POST['column'] = array(
			'seeker_no', 'full_name', 'usia', 'score', 'jenjang_nama', 'school', 'kota_nama', 'marital_nama', 'experience'
		);
		
		$_POST['is_custom']  = '<img class="button-cursor download" src="'.base_url('static/img/button_document.png').'"> ';
		$_POST['is_custom'] .= '<img class="button-cursor view" src="'.base_url('static/img/button_view.png').'"> ';
		$_POST['is_custom'] .= '<img class="button-cursor mail" src="'.base_url('static/img/button_mail.png').'"> ';
		
		$array = $this->Seeker_model->get_array($_POST);
		$count = $this->Seeker_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'sent_mail') {
			$param = array( 'to' => $_POST['to'], 'title' => $_POST['subject'], 'message' => $_POST['content'] );
			sent_mail($param);
			
			$result['status'] = true;
			$result['message'] = 'Email berhasil dikirim.';
		}
		
		echo json_encode($result);
	}
}