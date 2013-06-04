<?php

class SEEKER_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
		$this->Seeker_model->login_required();
    }
}

class COMPANY_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
		$this->Company_model->login_required();
    }
}