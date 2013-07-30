<?php
class sent_mail extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$result = $this->Seeker_Subscribe_model->sent_mail();
		echo json_encode($result);
    }
}