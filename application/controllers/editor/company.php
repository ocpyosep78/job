<?php
class company extends EDITOR_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'editor/company' );
    }
	
	function grid() {
		$_POST['column'] = array( 'id', 'nama', 'phone', 'email', 'website' );
		
		$array = $this->Company_model->get_array($_POST);
		$count = $this->Company_model->get_count();
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
			
			$result = $this->Company_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Company_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}