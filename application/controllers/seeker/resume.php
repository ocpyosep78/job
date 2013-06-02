<?php
class resume extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'seeker/resume' );
    }
    
    function edit() {
		$this->load->view( 'seeker/resume_edit' );
    }
}