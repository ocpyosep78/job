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
		}
		
		echo json_encode($result);
	}
}