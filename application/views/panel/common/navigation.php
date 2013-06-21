<?php
	$nama = '';
	$show = true;
	$link_edit = '';
	if ($this->Seeker_model->is_login()) {
		$user = $this->Seeker_model->get_session();
		$nama = $user['full_name'];
		$link_edit = base_url('seeker/resume/edit');
		$link_logo = $user['photo_link'];
	} else if ($this->Company_model->is_login()) {
		$user = $this->Company_model->get_session();
		$nama = (empty($user['nama'])) ? $user['email'] : $user['nama'];
		$link_edit = base_url('company/profile');
		$link_logo = $user['logo_link'];
	} else if ($this->Editor_model->is_login()) {
		$user = $this->Editor_model->get_session();
		$nama = $user['nama'];
		$link_edit = base_url('editor/editor');
		$link_logo = base_url('static/theme/flat/img/demo/user-avatar.jpg');
	} else {
		$show = false;
	}
	
?>
<div id="navigation">
	<div class="container-fluid">
		<a href="<?php echo base_url(); ?>" id="brand">JOBS</a>
		<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
		<?php if($show) { ?>
		<div class="user">
			<div class="dropdown">
				<a href="#" class='dropdown-toggle' data-toggle="dropdown">
					<?php echo $nama; ?>
					<img src="<?php echo $link_logo; ?>" style="width: 28px; height: 28px;" />
				</a>
				<ul class="dropdown-menu pull-right">
					<li><a href="<?php echo $link_edit; ?>">Edit profile</a></li>
					<li><a href="<?php echo base_url('ajax/logout'); ?>">Sign out</a></li>
				</ul>
			</div>
		</div>
		<?php } ?>
	</div>
</div>