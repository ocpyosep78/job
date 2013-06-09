<?php

class combo extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$action = (!empty($_POST['action'])) ? $_POST['action'] : '';
		
		// default id & name
		$id = 'id';
		$title = 'nama';
		
		if ($action == 'kota') {
			$array = $this->Kota_model->get_array(array( 'propinsi_id' => $_POST['propinsi_id'], 'limit' => 100 ));
		}
		
		echo ShowOption(array( 'Array' => $array, 'ArrayID' => $id, 'ArrayTitle' => $title ));
		exit;
	}
}                                                