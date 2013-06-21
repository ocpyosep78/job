<?php
	$count = array(
		'article' => $this->Article_model->get_count(array( 'is_new' => 1 )),
		'event' => $this->Event_model->get_count(array( 'is_new' => 1 )),
		'seeker' => $this->Seeker_model->get_count(array( 'is_new' => 1 )),
		'company' => $this->Company_model->get_count(array( 'is_new' => 1 )),
		'membership' => $this->Company_Membership_model->get_count(array( 'is_new' => 1, 'where' => "AND status = 'pending'" ))
	);
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Dashboard' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Dashboard', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content"><div class="row-fluid"><div class="span12">
			<ul class="tiles">
				<li class="orange long"><a href="<?php echo base_url('editor/article'); ?>"><span><i class="icon-envelope"></i> <?php echo $count['article']; ?></span><span class="name">Article</span></a></li>
				<li class="brown long"><a href="<?php echo base_url('editor/event'); ?>"><span><i class="icon-glass"></i> <?php echo $count['event']; ?></span><span class="name">Event</span></a></li>
				<li class="green long"><a href="<?php echo base_url('editor/seeker'); ?>"><span><i class="icon-user"></i> <?php echo $count['seeker']; ?></span><span class="name">Pelamar</span></a></li>
				<li class="teal long"><a href="<?php echo base_url('editor/company'); ?>"><span><i class="icon-home"></i> <?php echo $count['company']; ?></span><span class="name">Perusahaan</span></a></li>
				<li class="blue long"><a href="<?php echo base_url('editor/membership'); ?>"><span><i class="icon-home"></i> <?php echo $count['membership']; ?></span><span class="name">Membership</span></a></li>
			</ul>
		</div></div></div>
	</div></div></div></div></div>
</div>
</body>
</html>