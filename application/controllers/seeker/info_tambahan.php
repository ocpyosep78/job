<?php
class info_tambahan extends SEEKER_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'seeker/info_tambahan' );
    }
}