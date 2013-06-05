<?php

class home extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$segments = $this->uri->segments;
		
		// page
		if (isset($segments[1]) && !empty($segments[1])) {
			if (in_array($segments[1], array('blog', 'blog_detail', 'event', 'event_detail', 'company', 'listing', 'listing_detail', 'login', 'ajax'))) {
				$this->$segments[1]();
			}
		}
		
		// index
		else {
			$this->load->view( 'website/home' );
		};
    }
	
	function blog() {
		$this->load->view( 'website/blog' );
	}
	
	function blog_detail() {
		$this->load->view( 'website/blog_detail' );
	}
	
	function event() {
		$this->load->view( 'website/event' );
	}
	
	function event_detail() {
		$this->load->view( 'website/event_detail' );
	}
	
	function company() {
		$this->load->view( 'website/company' );
	}
	
	function listing() {
		$this->load->view( 'website/listing' );
	}
	
	function listing_detail() {
		$this->load->view( 'website/listing_detail' );
	}
	
	function login() {
		$this->load->view( 'website/login' );
	}
	
	function ajax() {
		$action = (empty($_POST['action'])) ? '' : $_POST['action'];
		if (isset($_POST['action'])) {
			unset($_POST['action']);
		}
		
		// additional action
		preg_match('/ajax\/([a-z0-9]+)/i', $_SERVER['REQUEST_URI'], $match);
		$action = (empty($action) && !empty($match[1])) ? $match[1] : $action;
		
		$result = array( 'status' => false );
		if ($action == 'login_seeker') {
			$seeker = $this->Seeker_model->get_by_id(array('email' => $_POST['email']));
			if (count($seeker) == 0 || empty($_POST['email'])) {
				$result['message'] = 'user anda tidak ditemukan.';
				echo json_encode($result);
				exit;
			}
			
			if (EncriptPassword($_POST['passwd']) != $seeker['passwd']) {
				$result['message'] = 'Password tidak sama.';
				echo json_encode($result);
				exit;
			}
			
			$this->Seeker_model->set_session($seeker);
			$result['status'] = true;
			$result['link'] = base_url('seeker/resume');
		} else if ($action == 'login_company') {
			$company = $this->Company_model->get_by_id(array('email' => $_POST['email']));
			if (count($company) == 0 || empty($_POST['email'])) {
				$result['message'] = 'user anda tidak ditemukan.';
				echo json_encode($result);
				exit;
			}
			
			if (EncriptPassword($_POST['passwd']) != $company['passwd']) {
				$result['message'] = 'Password tidak sama.';
				echo json_encode($result);
				exit;
			}
			
			$this->Company_model->set_session($company);
			$result['status'] = true;
			$result['link'] = base_url('company/post');
		} else if ($action == 'login_editor') {
			$editor = $this->Editor_model->get_by_id(array('email' => $_POST['email']));
			if (count($editor) == 0 || empty($_POST['email'])) {
				$result['message'] = 'user anda tidak ditemukan.';
				echo json_encode($result);
				exit;
			}
			
			if (EncriptPassword($_POST['passwd']) != $editor['passwd']) {
				$result['message'] = 'Password tidak sama.';
				echo json_encode($result);
				exit;
			}
			
			$this->Editor_model->set_session($editor);
			$result['status'] = true;
			$result['link'] = base_url('editor/home');
		} else if ($action == 'logout') {
			$this->Seeker_model->delete_session();
			$this->Company_model->delete_session();
			$this->Editor_model->delete_session();
			
			header("Location: ".base_url());
			exit;
		}
		
		echo json_encode($result);
	}
}