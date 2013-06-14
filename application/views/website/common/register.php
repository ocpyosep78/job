<?php
	$create_account = $this->Widget_model->get_by_id(array( 'alias' => 'create_account' ));
	$social_link = $this->Widget_model->get_by_id(array( 'alias' => 'social_link' ));
?>

<div class='register-widget'>
	<?php echo $create_account['content']; ?>
	<div class='actions'>
		<a href="<?php echo base_url('login'); ?>" title='Sign in' class='sign-in btn btn-main'>Sign In</a>
		<a href="<?php echo base_url('registrasi'); ?>" title='Registration' class='registration btn btn-blue'>Registration</a>
	</div>
	<div class='social-links'>
		<?php echo $social_link['content_without_p']; ?>
	</div>
</div>