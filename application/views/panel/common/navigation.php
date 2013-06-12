<?php
	$nama = '';
	$link_edit = '';
	if ($this->Seeker_model->is_login()) {
		$user = $this->Seeker_model->get_session();
		$nama = $user['full_name'];
		$link_edit = base_url('seeker/resume/edit');
	} else if ($this->Company_model->is_login()) {
		$user = $this->Company_model->get_session();
		$nama = $user['nama'];
		$link_edit = base_url('company/profile');
	} else if ($this->Editor_model->is_login()) {
		$user = $this->Editor_model->get_session();
		$nama = $user['nama'];
		$link_edit = base_url('editor/editor');
	}
	
?>
<div id="navigation">
	<div class="container-fluid">
		<a href="#" id="brand">JOBS</a>
		<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
		<div class="user">
			<div class="dropdown">
				<a href="#" class='dropdown-toggle' data-toggle="dropdown">
					<?php echo $nama; ?>
					<img src="<?php echo base_url('static/theme/flat/img/demo/user-avatar.jpg'); ?>" alt="">
				</a>
				<ul class="dropdown-menu pull-right">
					<li><a href="<?php echo $link_edit; ?>">Edit profile</a></li>
					<li><a href="<?php echo base_url('ajax/logout'); ?>">Sign out</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>