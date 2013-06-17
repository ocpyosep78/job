<?php
class view extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		preg_match('/view\/index\/([0-9a-z]+)$/i', $_SERVER['REQUEST_URI'], $match);
		$alias = (!empty($match[1])) ? $match[1] : '';
		if (empty($alias)) {
			header("Location: ".base_url());
			exit;
		}
		
		$seeker = $this->Seeker_model->get_by_id(array( 'alias' => $alias ));
		$this->load->view( 'seeker/resume', array( 'seeker_no' => $seeker['seeker_no'] ) );
    }
}