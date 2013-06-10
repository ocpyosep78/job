<?php
class seeker extends EDITOR_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'editor/seeker' );
    }
	
	function grid() {
		$_POST['column'] = array( 'seeker_no', 'first_name', 'last_name', 'email' );
		
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
		}
		
		echo json_encode($result);
	}
}