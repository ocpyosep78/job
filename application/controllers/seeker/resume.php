<?php
class resume extends SEEKER_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'seeker/resume' );
    }
    
    function edit() {
		$this->Seeker_model->login_required();
		
		$this->load->view( 'seeker/resume_edit' );
    }
	
	function grid() {
		$grid_name = $_POST['grid_name'];
		if ($grid_name == 'seeker_expert') {
			$_POST['column'] = array( 'content' );
			$array = $this->Seeker_Expert_model->get_array($_POST);
			$count = $this->Seeker_Expert_model->get_count();
		} else if ($grid_name == 'seeker_education') {
			$_POST['column'] = array( 'jenjang_nama', 'nama_sekolah' );
			$array = $this->Seeker_Education_model->get_array($_POST);
			$count = $this->Seeker_Education_model->get_count();
		} else if ($grid_name == 'seeker_exp') {
			$_POST['column'] = array( 'content' );
			$array = $this->Seeker_Exp_model->get_array($_POST);
			$count = $this->Seeker_Exp_model->get_count();
		} else if ($grid_name == 'seeker_language') {
			$_POST['column'] = array( 'nama', 'lisan', 'tulis' );
			$array = $this->Seeker_Language_model->get_array($_POST);
			$count = $this->Seeker_Language_model->get_count();
		} else if ($grid_name == 'seeker_reference') {
			$_POST['column'] = array( 'nama' );
			$array = $this->Seeker_Reference_model->get_array($_POST);
			$count = $this->Seeker_Reference_model->get_count();
		}
		
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			if (isset($_POST['first_name']) && isset($_POST['last_name'])) {
				$_POST['alias'] = $this->Seeker_model->get_alias($_POST['id'], $_POST['first_name'].$_POST['last_name']);
			}
			
			$result = $this->Seeker_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->Seeker_model->delete($_POST);
		}
		
		else if ($action == 'update_seeker_expert') {
			$result = $this->Seeker_Expert_model->update($_POST);
		} else if ($action == 'delete_seeker_expert') {
			$result = $this->Seeker_Expert_model->delete($_POST);
		}
		
		else if ($action == 'update_seeker_education') {
			$result = $this->Seeker_Education_model->update($_POST);
		} else if ($action == 'delete_seeker_education') {
			$result = $this->Seeker_Education_model->delete($_POST);
		}
		
		else if ($action == 'update_seeker_exp') {
			$result = $this->Seeker_Exp_model->update($_POST);
		} else if ($action == 'delete_seeker_exp') {
			$result = $this->Seeker_Exp_model->delete($_POST);
		}
		
		else if ($action == 'update_seeker_language') {
			$result = $this->Seeker_Language_model->update($_POST);
		} else if ($action == 'delete_seeker_language') {
			$result = $this->Seeker_Language_model->delete($_POST);
		}
		
		else if ($action == 'get_seeker_addon') {
			$result = $this->Seeker_Addon_model->get_by_id(array( 'seeker_id' => $_POST['seeker_id'] ));
		} else if ($action == 'update_seeker_addon') {
			$param = $this->Seeker_Addon_model->force_get(array( 'seeker_id' => $_POST['seeker_id'] ));
			$param['kendaraan'] = $_POST['kendaraan'];
			$param['content'] = $_POST['content'];
			$result = $this->Seeker_Addon_model->update($param);
		}
		
		else if ($action == 'update_seeker_reference') {
			$result = $this->Seeker_Reference_model->update($_POST);
		} else if ($action == 'delete_seeker_reference') {
			$result = $this->Seeker_Reference_model->delete($_POST);
		}
		
		else if ($action == 'get_seeker_summary') {
			$result = $this->Seeker_Summary_model->get_by_id(array( 'seeker_id' => $_POST['seeker_id'] ));
			if (count($result) == 0) {
				$result = $this->Seeker_Summary_model->update(array( 'seeker_id' => $_POST['seeker_id'] ));
			}
		} else if ($action == 'update_seeker_summary') {
			$result = $this->Seeker_Summary_model->update($_POST);
			$summary = $this->Seeker_Summary_model->get_by_id(array( 'seeker_id' => $_POST['seeker_id'] ));
			$result = array_merge($result, $summary);
		}
		
		if (!empty($_POST['update_session'])) {
			$seeker = $this->Seeker_model->get_by_id(array( 'id' => $_POST['id'] ));
			$this->Seeker_model->set_session($seeker);
		}
		
		echo json_encode($result);
	}
}