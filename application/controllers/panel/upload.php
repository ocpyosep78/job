<?php

class upload extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	function upload_single() {
		$this->load->view( 'panel/common/upload_single');
	}
}