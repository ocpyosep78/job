<?php
	$seeker = $this->Seeker_model->get_by_id(array( 'id' => $apply['seeker_id']));
?>
Kepada <?php echo $seeker['full_name']; ?><br /><br />
Ini adalah notifikasi pemberitahuan, bahwa anda di undang untuk mengikuti exam online di <?php echo $apply['company_nama']; ?>,
silahkan lihat dashboard anda segera..<br /><br />

Login : <a href="<?php echo base_url('login'); ?>"><?php echo base_url('login'); ?></a><br /><br />

Terima Kasih<br />