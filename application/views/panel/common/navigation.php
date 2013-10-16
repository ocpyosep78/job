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
		
		<ul class='main-nav'>
			<?php if ($this->Seeker_model->is_login()) { ?>
			<li><a href="<?php echo base_url('seeker/resume'); ?>">Resume</a></li>
			<li><a href="<?php echo base_url('seeker/apply'); ?>">My Jobs Applied</a></li>
			<li><a href="<?php echo base_url('seeker/lamaran'); ?>">Surat Lamaran</a></li>
			<li><a href="<?php echo base_url('seeker/sent'); ?>">Kirim Lamaran</a></li>
			<li><a href="<?php echo base_url('seeker/subscribe'); ?>">Subscribe</a></li>
			<li><a href="<?php echo base_url('seeker/setting'); ?>">Setting</a></li>
			<?php } else if ($this->Company_model->is_login()) { ?>
			<?php $company = $this->Company_model->get_session(); ?>
			<?php $membership = $this->Company_model->get_membership_status($company); ?>
			<li><a href="<?php echo base_url('company/home'); ?>">Dashboard</a></li>
			<li><a href="<?php echo base_url('company/post'); ?>">Create Page</a></li>
			<li><a href="<?php echo base_url('company/vacancy'); ?>">Add Jobs Position</a></li>
			<?php if ($membership) { ?> 
			<li><a href="<?php echo base_url('company/search'); ?>">Find Resume</a></li>
			<?php } ?>
			<li><a href="<?php echo base_url('company/download'); ?>">Download</a></li>
			<li><a href="<?php echo base_url('company/profile'); ?>">Profile</a></li>
			<li><a href="<?php echo base_url('company/membership'); ?>">Membership</a></li>
			<?php } else if ($this->Editor_model->is_login()) { ?>
			<li>
				<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
					<span>Administrator</span>
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo base_url('editor/home'); ?>">Dashboard</a></li>
					<li><a href="<?php echo base_url('editor/article'); ?>">Article</a></li>
					<li><a href="<?php echo base_url('editor/event'); ?>">Event</a></li>
					<li><a href="<?php echo base_url('editor/vacancy'); ?>">Lowongan</a></li>
					<li><a href="<?php echo base_url('editor/membership'); ?>">Membership</a></li>
					<li><a href="<?php echo base_url('editor/widget'); ?>">Widget</a></li>
					<li><a href="<?php echo base_url('editor/seeker'); ?>">Pelamar</a></li>
					<li><a href="<?php echo base_url('editor/company'); ?>">Perusahaan</a></li>
					<li><a href="<?php echo base_url('editor/news'); ?>">News</a></li>
					<li><a href="<?php echo base_url('editor/editor'); ?>">Editor</a></li>
					<li><a href="<?php echo base_url('editor/report'); ?>">Report</a></li>
				</ul>
			</li>
			<li>
				<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
					<span>Master</span>
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo base_url('master/kategori'); ?>">Kategori</a></li>
					<li><a href="<?php echo base_url('master/subkategori'); ?>">Subkategori</a></li>
					<li><a href="<?php echo base_url('master/membership'); ?>">Membership</a></li>
					<li><a href="<?php echo base_url('master/industri'); ?>">Industri</a></li>
					<li><a href="<?php echo base_url('master/jenis_pekerjaan'); ?>">Jenis Pekerjaan</a></li>
					<li><a href="<?php echo base_url('master/jenjang'); ?>">Jenjang</a></li>
					<li><a href="<?php echo base_url('master/pengalaman'); ?>">Pengalaman</a></li>
					<li><a href="<?php echo base_url('master/position'); ?>">Posisi</a></li>
					<li><a href="<?php echo base_url('master/propinsi'); ?>">Propinsi</a></li>
					<li><a href="<?php echo base_url('master/kota'); ?>">Kota</a></li>
				</ul>
			</li>
			<li>
				<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
					<span>Subscribe</span>
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo base_url('subscribe/jenis_subscribe'); ?>">Jenis Subscribe</a></li>
					<li><a href="<?php echo base_url('subscribe/daftar'); ?>">Subscribe</a></li>
					<li><a href="<?php echo base_url('subscribe/mail'); ?>">Mail</a></li>
				</ul>
			</li>
		<?php } ?>
		</ul>
		
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

