<?php
class lamaran extends SEEKER_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'seeker/lamaran' );
    }
	
	function grid() {
		$seeker = $this->Seeker_model->get_session();
		$_POST['seeker_id'] = $seeker['id'];
		$_POST['column'] = array( 'nama' );
		
		$array = $this->Surat_Lamaran_model->get_array($_POST);
		$count = $this->Surat_Lamaran_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			if (empty($_POST['id'])) {
				$array = $this->Surat_Lamaran_model->get_array(array( 'seeker_id' => $_POST['seeker_id'] ));
				if (count($array) > 5) {
					$result = array( 'status' => false, 'message' => 'Maksimal 5 surat lamaran yang dapat disimpan.' );
					echo json_encode($result);
					exit;
				}
			}
			
			$result = $this->Surat_Lamaran_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Surat_Lamaran_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}