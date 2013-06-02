<?php
class apply extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'seeker/apply' );
    }
	
	function grid() {
		$array = array(
			array("Other browsers","All others","-",'<img src="http://olshop.simetri.in/static/img/button_edit.png" class="button-cursor edit"> <img src="http://olshop.simetri.in/static/img/button_delete.png" class="button-cursor delete"></i>',"U"),
			array("Other browsers","All others","-",'<img src="http://olshop.simetri.in/static/img/button_edit.png" class="button-cursor edit"> <img src="http://olshop.simetri.in/static/img/button_delete.png" class="button-cursor delete"></i>',"U"),
			array("Other browsers","All others","-",'<img src="http://olshop.simetri.in/static/img/button_edit.png" class="button-cursor edit"> <img src="http://olshop.simetri.in/static/img/button_delete.png" class="button-cursor delete"></i>',"U"),
			array("Other browsers","All others","-",'<img src="http://olshop.simetri.in/static/img/button_edit.png" class="button-cursor edit"> <img src="http://olshop.simetri.in/static/img/button_delete.png" class="button-cursor delete"></i>',"U"),
			array("Other browsers","All others","-",'<img src="http://olshop.simetri.in/static/img/button_edit.png" class="button-cursor edit"> <img src="http://olshop.simetri.in/static/img/button_delete.png" class="button-cursor delete"></i>',"U"),
			array("Other browsers","All others","-",'<img src="http://olshop.simetri.in/static/img/button_edit.png" class="button-cursor edit"> <img src="http://olshop.simetri.in/static/img/button_delete.png" class="button-cursor delete"></i>',"U"),
			array("Other browsers","All others","-",'<img src="http://olshop.simetri.in/static/img/button_edit.png" class="button-cursor edit"> <img src="http://olshop.simetri.in/static/img/button_delete.png" class="button-cursor delete"></i>',"U"),
			array("Other browsers","All others","-",'<img src="http://olshop.simetri.in/static/img/button_edit.png" class="button-cursor edit"> <img src="http://olshop.simetri.in/static/img/button_delete.png" class="button-cursor delete"></i>',"U"),
			array("Other browsers","All others","-",'<img src="http://olshop.simetri.in/static/img/button_edit.png" class="button-cursor edit"> <img src="http://olshop.simetri.in/static/img/button_delete.png" class="button-cursor delete"></i>',"U"),
			array("Other browsers","All others","-",'<img src="http://olshop.simetri.in/static/img/button_edit.png" class="button-cursor edit"> <img src="http://olshop.simetri.in/static/img/button_delete.png" class="button-cursor delete"></i>',"U")
		);
		$grid = array(
			'sEcho' => $_POST['sEcho'],
			'iTotalRecords' => 104,
			'iTotalDisplayRecords' => 104,
			'aaData' => $array
		);
		echo json_encode($grid);
	}
}