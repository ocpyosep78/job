<?php
class publish extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		// first try
		preg_match('/index\/([a-z0-9]+)$/i', $_SERVER['REQUEST_URI'], $match);
		$seeker_key = (empty($match[1])) ? '' : $match[1];
		
		// second try
		if (empty($seeker_key)) {
			preg_match('/seeker\/([0-9]+)\//i', $_SERVER['REQUEST_URI'], $match);
			$seeker_key = (empty($match[1])) ? '' : $match[1];
		}
		
		$seeker_no = $this->Seeker_model->get_by_id(array( 'seeker_no' => $seeker_key ));
		$seeker_alias = $this->Seeker_model->get_by_id(array( 'alias' => $seeker_key ));
		$seeker_temp = (count($seeker_no) > 0) ? $seeker_no : $seeker_alias;
		
		// get complete data
		$seeker = $this->Seeker_model->get_by_id(array( 'id' => $seeker_temp['id'] ));
		
		if (count($seeker) == 0) {
			echo 'Pelamar yang anda cari tidak ditemukan.';
			exit;
		}
		
		// check user
		$user_session = $this->Seeker_model->get_session();
		$allow_update = (@$user_session['id'] == $seeker['id']) ? true : false;
		
		$this->load->view( 'seeker/publish_seeker', array( 'seeker' => $seeker, 'allow_update' => $allow_update ) );
    }
	
	function convert($seeker_no) {
		$this->load->library('mpdf');
		
		$seeker = $this->Seeker_model->get_by_id(array( 'seeker_no' => $seeker_no ));
		$seeker = $this->Seeker_model->get_by_id(array( 'id' => $seeker['id'] ));
		
		$content = $this->load->view( 'seeker/publish_seeker', array( 'seeker' => $seeker, 'allow_update' => false, 'is_pdf' => true ), true );
		$this->mpdf->WriteHTML($content);
		$this->mpdf->Output();
	}
}