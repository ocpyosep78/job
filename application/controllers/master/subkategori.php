<?php
class subkategori extends EDITOR_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'master/subkategori' );
    }
	
	function grid() {
		$_POST['column'] = array( 'kategori_nama', 'nama', 'alias');
		
		$array = $this->Subkategori_model->get_array($_POST);
		$count = $this->Subkategori_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Subkategori_model->update($_POST);
			
			// tag
			$this->Subkategori_Tag_model->delete(array( 'subkategori_id' => $result['id'] ));
			if (!empty($_POST['tag'])) {
				$array_tag = explode(',', $_POST['tag']);
				foreach ($array_tag as $tag_name) {
					$tag = $this->Tag_model->get_by_id(array( 'title' => $tag_name, 'force_insert' => 1 ));
					$this->Subkategori_Tag_model->update(array( 'subkategori_id' => $result['id'], 'tag_id' => $tag['id'] ));
				}
			}
		} else if ($action == 'get_by_id') {
			$result = $this->Subkategori_model->get_by_id(array( 'id' => $_POST['id'] ));
			$array_tag = $this->Subkategori_Tag_model->get_array(array( 'subkategori_id' => $_POST['id'] ));
			$result['tag'] = get_tag_name($array_tag);
		} else if ($action == 'delete') {
			$result = $this->Subkategori_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}