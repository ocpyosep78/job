<?php
class jenis_subscribe extends EDITOR_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'subscribe/jenis_subscribe' );
    }
	
	function grid() {
		$_POST['column'] = array( 'nama' );
		$_POST['is_custom'] = '<img class="button-cursor mail" src="'.base_url('static/img/button_mail.png').'"> ';
		
		$array = $this->Jenis_Subscribe_model->get_array($_POST);
		$count = $this->Jenis_Subscribe_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'sent_mail') {
			$array_email = $this->Subscribe_model->get_array(array( 'jenis_subscribe_id' => $_POST['id'], 'limit' => 1000 ));
			foreach ($array_email as $row) {
				$param = array(
					'to' => $row['email'],
					'title' => $_POST['nama'],
					'message' => $_POST['content'],
				);
				sent_mail($param);
			}
			
			$result['status'] = true;
			$result['message'] = 'Email berhasil dikirim.';
		}
		
		echo json_encode($result);
	}
}