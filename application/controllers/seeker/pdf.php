<?php
class pdf extends CI_Controller {
    function __construct() {
        parent::__construct();
		$this->load->library('mpdf');
    }
    
    function lamaran($id) {
		$surat = $this->Surat_Lamaran_model->get_by_id(array( 'id' => $id ));
		$this->mpdf->WriteHTML($surat['content']);
		$this->mpdf->Output();
    }
}