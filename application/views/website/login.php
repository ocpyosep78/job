<?php
	$array_breadcrumb = array( array( 'title' => 'Index', 'link' => base_url() ), array( 'title' => 'Login' ) );
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<section id='main'>
	<div class='container'><div class='row'>
		<div class='span9 content'>
			<?php $this->load->view( 'website/common/breadcrumb', array( 'array_breadcrumb' => $array_breadcrumb, 'title' => 'Login' ) ); ?>
			
			<div class='span9 news blog-article no-margin' style="padding: 0 0 100px 0;">
				<h1 class="span6 no-margin">&nbsp;</h1>
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
							<a class="cursor show-password">Lupa password?</a>
							<a class="cursor show-register">Register</a>
						</fieldset>
					</form>
					
					<form class="cnt-form hide" id="form-seeker-forget" data-ajaxpost="ajax/seeker">
						<input type="hidden" name="action" value="login_seeker" />
						<h1>PENCARI KERJA</h1>
						<fieldset class="inputs">
							<input class="user" type="text" placeholder="Email" name="email" required>
						</fieldset>
						<fieldset class="actions">
							<input type="submit" class="btn-submit" value="Sent Email">
							<a class="cursor show-login" style="margin-left: 75px;">Login</a>
							<a class="cursor show-register">Register</a>
						</fieldset>
					</form>
					
					<form class="cnt-form hide" id="form-seeker-register" data-ajaxpost="ajax/seeker">
						<input type="hidden" name="action" value="login_company" />
						<h1>PENCARI KERJA</h1>
						<fieldset class="inputs">
							<input class="user" type="text" placeholder="Email" name="email" required>
							<input class="pass" type="password" placeholder="Password" name="passwd" required>
						</fieldset>
						<fieldset class="actions">
							<input type="submit" class="btn-submit" value="Register">
							<a class="cursor show-login" style="margin-left: 75px;">Login</a>
						</fieldset>
					</form>
				</div>
				<div class="cnt-block">
					<form class="cnt-form" id="form-company" data-ajaxpost="ajax/company">
						<input type="hidden" name="action" value="login_company" />
						<h1>PERUSAHAAN</h1>
						<fieldset class="inputs">
							<input class="user" type="text" placeholder="Email" name="email" required>
							<input class="pass" type="password" placeholder="Password" name="passwd" required>
						</fieldset>
						<fieldset class="actions">
							<input type="submit" class="btn-submit" value="Log in">
							<a class="cursor show-password">Lupa password?</a>
							<a class="cursor show-register">Register</a>
						</fieldset>
					</form>
					
					<form class="cnt-form hide" id="form-company-forget" data-ajaxpost="ajax/company">
						<input type="hidden" name="action" value="login_company" />
						<h1>PERUSAHAAN</h1>
						<fieldset class="inputs">
							<input class="user" type="text" placeholder="Email" name="email" required>
						</fieldset>
						<fieldset class="actions">
							<input type="submit" class="btn-submit" value="Sent Email">
							<a class="cursor show-login" style="margin-left: 75px;">Login</a>
							<a class="cursor show-register">Register</a>
						</fieldset>
					</form>
					
					<form class="cnt-form hide" id="form-company-register" data-ajaxpost="ajax/company">
						<input type="hidden" name="action" value="login_company" />
						<h1>PERUSAHAAN</h1>
						<fieldset class="inputs">
							<input class="user" type="text" placeholder="Email" name="email" required>
							<input class="pass" type="password" placeholder="Password" name="passwd" required>
						</fieldset>
						<fieldset class="actions">
							<input type="submit" class="btn-submit" value="Register">
							<a class="cursor show-login" style="margin-left: 75px;">Login</a>
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

$('.show-password').click(function() {
	$(this).parents('.cnt-block').find('form').hide();
	$(this).parents('.cnt-block').find('form').eq(1).show();
});
$('.show-login').click(function() {
	$(this).parents('.cnt-block').find('form').hide();
	$(this).parents('.cnt-block').find('form').eq(0).show();
});
$('.show-register').click(function() {
	$(this).parents('.cnt-block').find('form').hide();
	$(this).parents('.cnt-block').find('form').eq(2).show();
});

var link = window.location.href;
var temp = link.match('registrasi');
if (temp != null && temp[0] == 'registrasi') {
	console.log(10)
	$('.show-register').eq(0).click();
	$('.show-register').eq(2).click();
}
</script>

<?php $this->load->view( 'website/common/footer' ); ?>