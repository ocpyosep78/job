<div id="left">
	<?php if ($this->Seeker_model->is_login()) { ?>
	<div class="subnav">
		<div class="subnav-title">
			<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Pelamar</span></a>
		</div>
		<ul class="subnav-menu">
			<li><a href="<?php echo base_url('seeker/resume'); ?>">Resume</a></li>
			<!-- <li><a href="<?php echo base_url('seeker/resume/edit'); ?>">Resume Edit</a></li>	-->
			<li><a href="<?php echo base_url('seeker/apply'); ?>">My Jobs Applied</a></li>
			<li><a href="<?php echo base_url('seeker/lamaran'); ?>">Surat Lamaran</a></li>
			<li><a href="<?php echo base_url('seeker/sent'); ?>">Kirim Lamaran</a></li>
			<li><a href="<?php echo base_url('seeker/setting'); ?>">Setting</a></li>
			<!-- <li><a href="<?php echo base_url('seeker/info_tambahan'); ?>">Info Tambahan</a></li>	-->
		</ul>
	</div>
	<?php } else if ($this->Company_model->is_login()) { ?>
	<div class="subnav">
		<div class="subnav-title">
			<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Perusahaan</span></a>
		</div>
		<ul class="subnav-menu">
			<li><a href="<?php echo base_url('company/post'); ?>">Create Page</a></li>
			<li><a href="<?php echo base_url('company/vacancy'); ?>">Add Jobs Position</a></li>
			<li><a href="<?php echo base_url('company/search'); ?>">Find Resume</a></li>
			<li><a href="<?php echo base_url('company/download'); ?>">Download</a></li>
			<!-- <li><a href="<?php echo base_url('company/slide'); ?>">Slide</a></li>	-->
			<li><a href="<?php echo base_url('company/profile'); ?>">Profile</a></li>
			<li><a href="<?php echo base_url('company/membership'); ?>">Membership</a></li>
		</ul>
	</div>
	<?php } else if ($this->Editor_model->is_login()) { ?>
	<div class="subnav">
		<div class="subnav-title">
			<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Administrator</span></a>
		</div>
		<ul class="subnav-menu">
			<li><a href="<?php echo base_url('editor/home'); ?>">Dashboard</a></li>
			<li><a href="<?php echo base_url('editor/article'); ?>">Article</a></li>
			<li><a href="<?php echo base_url('editor/event'); ?>">Event</a></li>
			<li><a href="<?php echo base_url('editor/widget'); ?>">Widget</a></li>
			<li><a href="<?php echo base_url('editor/seeker'); ?>">Pelamar</a></li>
			<li><a href="<?php echo base_url('editor/company'); ?>">Perusahaan</a></li>
			<li><a href="<?php echo base_url('editor/editor'); ?>">Editor</a></li>
		</ul>
	</div>
	<div class="subnav">
		<div class="subnav-title">
			<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Master</span></a>
		</div>
		<ul class="subnav-menu">
			<li><a href="<?php echo base_url('master/kategori'); ?>">Kategori</a></li>
			<li><a href="<?php echo base_url('master/subkategori'); ?>">Subkategori</a></li>
			<li><a href="<?php echo base_url('master/industri'); ?>">Industri</a></li>
			<li><a href="<?php echo base_url('master/jenis_pekerjaan'); ?>">Jenis Pekerjaan</a></li>
			<li><a href="<?php echo base_url('master/jenjang'); ?>">Jenjang</a></li>
			<li><a href="<?php echo base_url('master/pengalaman'); ?>">Pengalaman</a></li>
			<li><a href="<?php echo base_url('master/position'); ?>">Posisi</a></li>
		</ul>
	</div>
	<?php } ?>
</div>
