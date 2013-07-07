<?php
	$seeker_login = $this->Seeker_model->is_login();
	$company_login = $this->Company_model->is_login();
	
	$is_login = false;
	if ($seeker_login) {
		$is_login = true;
		$link_dashboard = base_url('seeker/resume');
	} else if ($company_login) {
		$is_login = true;
		$link_dashboard = base_url('company/home');
	}
	
	$create_account = $this->Widget_model->get_by_id(array( 'alias' => 'create_account' ));
	$social_link = $this->Widget_model->get_by_id(array( 'alias' => 'social_link' ));
?>

<div class='register-widget'>
	<?php echo $create_account['content']; ?>
	<div class='actions'>
		<?php if ($is_login) { ?>
		<a href="<?php echo $link_dashboard; ?>" title='Dashboard' class='sign-in btn btn-main'>Dashboard</a>
		<a href="<?php echo base_url('ajax/logout'); ?>" title='Log Out' class='registration btn btn-blue'>Log Out</a>
		<?php } else { ?>
		<a href="<?php echo base_url('login'); ?>" title='Sign in' class='sign-in btn btn-main'>Sign In</a>
		<a href="<?php echo base_url('registrasi'); ?>" title='Registration' class='registration btn btn-blue'>Registration</a>
		<?php } ?>
	</div>
	<div class='social-links'>
		<?php echo $social_link['content_without_p']; ?>
	</div>
</div>