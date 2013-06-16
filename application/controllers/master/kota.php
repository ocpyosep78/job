<?php
class kota extends EDITOR_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'master/kota' );
    }
	
	function grid() {
		$_POST['column'] = array( 'propinsi_nama', 'nama' );
		$_POST['negara_id'] = NEGARA_INDONESIA_ID;
		
		$array = $this->Kota_model->get_array($_POST);
		$count = $this->Kota_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Kota_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Kota_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}