<?php
	$array_breadcrumb = array( array( 'title' => 'Index', 'link' => base_url() ), array( 'title' => 'Login' ) );
	
	$message = '';
	if (!empty($_GET['reset'])) {
		$seeker = $this->Seeker_model->get_by_id(array( 'reset' => $_GET['reset'] ));
		$company = $this->Company_model->get_by_id(array( 'reset' => $_GET['reset'] ));
		
		$user = array();
		if (count($seeker) > 0) {
			$user = $seeker;
			$model_name = 'Seeker_model';
		} else if (count($company) > 0) {
			$user = $company;
			$model_name = 'Company_model';
		} else {
			$message = 'Maaf, link ini sudah tidak berlaku.';
		}
		
		if (count($user) > 0) {
			$passwd_new = substr(EncriptPassword(time()), 0, 10);
			$param_update = array( 'id' => $user['id'], 'passwd' => EncriptPassword($passwd_new), 'reset' => '' );
			$this->$model_name->update($param_update);
			
			$message = 'Password anda berhasil direset, silahkan memeriksa email anda.';
			$param['to'] = $user['email'];
			$param['message']  = "Password anda berhasil direset, berikut informasi password baru anda : $passwd_new \n\n";
			sent_mail($param);
		}
	}
	else if (!empty($_GET['validation'])) {
		$seeker = $this->Seeker_model->get_by_id(array( 'validation' => $_GET['validation'] ));
		$company = $this->Company_model->get_by_id(array( 'validation' => $_GET['validation'] ));
		
		$user = array();
		if (count($seeker) > 0) {
			$user = $seeker;
			$model_name = 'Seeker_model';
		} else if (count($company) > 0) {
			$user = $company;
			$model_name = 'Company_model';
		} else {
			$message = 'Maaf, link ini sudah tidak berlaku.';
		}
		
		if (count($user) > 0) {
			$param_update = array( 'id' => $user['id'], 'is_active' => 1, 'validation' => '' );
			$this->$model_name->update($param_update);
			
			$message = 'Validasi anda berhasil, account anda sudah bisa digunakan.';
		}
	}
	else if (!empty($_GET['request'])) {
		$type = @$_GET['type'];
		$request = $_GET['request'];
		
		if ($request == 'validation') {
			$user = array();
			if ($type == 'seeker') {
				$model_name = 'Seeker_model';
			} else if (($type == 'company')) {
				$model_name = 'Company_model';
			}
			
			// get data
			$user = $this->$model_name->get_by_id(array( 'email' => $_GET['email'] ));
			
			$is_active = 0;
			if (! empty($user['is_active'])) {
				$is_active = $user['is_active'];
				$message = 'Account anda sudah aktif, silahkan login.';
			} else if (empty($user['validation'])) {
				$validation = substr(md5(time() . rand(1000,9999)), 0, 20);
				$param['id'] = $user['id'];
				$param['validation'] = $validation;
				$this->$model_name->update($param);
			} else {
				$validation = $user['validation'];
			}
			
			if (empty($is_active)) {
				$link_validation = base_url('login?validation='.$validation);
				$param_mail['to'] = $user['email'];
				$param_mail['title'] = 'Account Validation';
				$param_mail['message'] = 'Silahkan klik link berikut untuk mengaktifkan user anda.<br />'.$link_validation;
				sent_mail($param_mail);
				
				$message = 'Email validasi berhasil kirim ulang ke email anda.';
			}
		}
	}
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<section id='main'>
	<div class='container'><div class='row'>
		<div class='span9 content'>
			<?php $this->load->view( 'website/common/breadcrumb', array( 'array_breadcrumb' => $array_breadcrumb, 'sub_title' => 'Login' ) ); ?>
			
			<div class='span9 news blog-article no-margin' style="padding: 0 0 100px 0;">
				<div class="hide center message-login" style="text-align: center; padding: 10px 0 15px 0; font-size: 14px; color: #FF0000;"><?php echo $message; ?></div>
				
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
						<input type="hidden" name="action" value="forget_seeker" />
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
						<input type="hidden" name="action" value="register_seeker" />
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
						<input type="hidden" name="action" value="forget_company" />
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
						<input type="hidden" name="action" value="register_company" />
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
			$('.message-login').html(result.message);
			$('.message-login').slideDown();
		}
	} });
	
	return false;
});
$('#form-seeker-forget, #form-company-forget').submit(function() {
	$('.message-login').hide();
	var form_id = $(this).attr('id');
	var param = Site.Form.GetValue(form_id);
	Func.ajax({ url: web.host + $(this).data('ajaxpost'), param: param, callback: function(result) {
		$('.message-login').text(result.message);
		$('.message-login').slideDown();
	} });
	
	return false;
});
$('#form-seeker-register, #form-company-register').submit(function() {
	$('.message-login').hide();
	var form_id = $(this).attr('id');
	var param = Site.Form.GetValue(form_id);
	Func.ajax({ url: web.host + $(this).data('ajaxpost'), param: param, callback: function(result) {
		$('.message-login').text(result.message);
		$('.message-login').slideDown();
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

if ($('.message-login').text().length > 0) {
	$('.message-login').slideDown();
}

var link = window.location.href;
var temp = link.match('registrasi');
if (temp != null && temp[0] == 'registrasi') {
	console.log(10)
	$('.show-register').eq(0).click();
	$('.show-register').eq(2).click();
}
</script>

<?php $this->load->view( 'website/common/footer' ); ?>