<?php
?>

<div id="left">
	<!--
	<form action="search-results.html" method="GET" class='search-form'>
		<div class="search-pane">
			<input type="text" name="search" placeholder="Search here...">
			<button type="submit"><i class="icon-search"></i></button>
		</div>
	</form>
	-->
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
			<li><a href="<?php echo base_url('seeker/info_tambahan'); ?>">Info Tambahan</a></li>
		</ul>
	</div>
	<div class="subnav">
		<div class="subnav-title">
			<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Perusahaan</span></a>
		</div>
		<ul class="subnav-menu">
			<li><a href="<?php echo base_url('company/post'); ?>">Create Page</a></li>
			<li><a href="<?php echo base_url('company/vacancy'); ?>">Add Jobs Position</a></li>
			<li><a href="<?php echo base_url('company/search'); ?>">Find Resume</a></li>
			<li><a href="<?php echo base_url('company/download'); ?>">Download</a></li>
			<li><a href="<?php echo base_url('company/slide'); ?>">Slide</a></li>
			<li><a href="<?php echo base_url('company/profile'); ?>">Profile</a></li>
			<li><a href="<?php echo base_url('company/membership'); ?>">Membership</a></li>
		</ul>
	</div>
	<div class="subnav">
		<div class="subnav-title">
			<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Administrator</span></a>
		</div>
		<ul class="subnav-menu">
			<li><a href="<?php echo base_url('editor/login'); ?>">Login</a></li>
			<li><a href="<?php echo base_url('editor/home'); ?>">Dashboard</a></li>
			<li><a href="<?php echo base_url('editor/article'); ?>">Article</a></li>
			<li><a href="<?php echo base_url('editor/event'); ?>">Event</a></li>
			<li><a href="<?php echo base_url('editor/widget'); ?>">Widget</a></li>
			<li><a href="<?php echo base_url('editor/seeker'); ?>">Pelamar</a></li>
			<li><a href="<?php echo base_url('editor/company'); ?>">Perusahaan</a></li>
			<li><a href="<?php echo base_url('editor/user'); ?>">Editor</a></li>
		</ul>
	</div>
</div>
