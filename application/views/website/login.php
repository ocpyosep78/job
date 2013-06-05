<?php
	$array_breadcrumb = array( array( 'title' => 'Index', 'link' => base_url() ), array( 'title' => 'Login' ) );
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<section id='main'>
	<div class='container'><div class='row'>
		<div class='span9 content'>
			<?php $this->load->view( 'website/common/breadcrumb', array( 'array_breadcrumb' => $array_breadcrumb ) ); ?>
			
			<div class='span9 news blog-article no-margin' style="padding: 0 0 100px 0;">
				<h2>Login</h2>
				<div class="hide center message-login" style="text-align: center; padding: 0 0 15px 0; font-size: 14px; color: #FF0000;"></div>
				
				<div class="cnt-block">
					<form class="cnt-form" id="form-seeker" data-ajaxpost="ajax/seeker">
						<input type="hidden" name="action" value="login_seeker" />
						<h1>PENCARI KERJA</h1>
						<fieldset class="inputs">
							<input class="user" type="text" placeholder="Email" name="email" autofocus required>   
							<input class="pass" type="password" placeholder="Password" name="passwd" required>
						</fieldset>
						<fieldset class="actions">
							<input type="submit" class="btn-submit" value="Log in">
							<a href="">Lupa password?</a><a href="">Register</a>
						</fieldset>
					</form>
				</div>
				<div class="cnt-block">
					<form class="cnt-form" id="form-company" data-ajaxpost="ajax/company">
						<input type="hidden" name="action" value="login_company" />
						<h1>PERUSAHAAN</h1>
						<fieldset class="inputs">
							<input class="user" type="text" placeholder="Username" name="email" required>   
							<input class="pass" type="password" placeholder="Password" name="passwd" required>
						</fieldset>
						<fieldset class="actions">
							<input type="submit" class="btn-submit" value="Log in">
							<a href="">Lupa password?</a><a href="">Register</a>
						</fieldset>
					</form>
				</div>
				<div class="clear"></div>
			</div>
		</div>

		<aside class='span3'>
			<div class='inner'>
				<?php $this->load->view( 'website/common/register' ); ?>
				<?php $this->load->view( 'website/common/site_banner' ); ?>
			</div>
		</aside>
	</div></div>
</section>

<script>
$('#form-seeker, #form-company').submit(function() {
	$('.message-login').hide();
	var form_id = $(this).attr('id');
	var param = Site.Form.GetValue(form_id);
	Func.ajax({ url: web.host + $(this).data('ajaxpost'), param: param, callback: function(result) {
		if (result.status) {
			window.location = result.link;
		} else {
			$('.message-login').text(result.message);
			$('.message-login').slideDown();
		}
	} });
	
	return false;
});
</script>

<?php $this->load->view( 'website/common/footer' ); ?>