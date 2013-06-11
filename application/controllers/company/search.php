<?php
class search extends COMPANY_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'company/search' );
    }
	
	function grid() {
		$_POST['column'] = array( 'seeker_no', 'full_name', 'score', 'email', 'phone' );
		
		$array = $this->Seeker_model->get_array($_POST);
		$count = $this->Seeker_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
}