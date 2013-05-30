<?php

class home extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$segments = $this->uri->segments;
		
		// page
		if (isset($segments[1]) && !empty($segments[1])) {
			if (in_array($segments[1], array('blog', 'blog_detail', 'event', 'event_detail', 'company', 'listing', 'listing_detail', 'login'))) {
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
}