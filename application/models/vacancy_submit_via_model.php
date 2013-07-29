<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vacancy_Submit_Via_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
    function get_array($param = array()) {
        $array[] = array( 'id' => VACANCY_SUBMIT_VIA_EMAIL, 'text' => 'Kirim via email' );
        $array[] = array( 'id' => VACANCY_SUBMIT_VIA_LINK, 'text' => 'Kirim via link' );
		
        return $array;
    }
}