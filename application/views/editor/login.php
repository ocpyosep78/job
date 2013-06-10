<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Login Editor' ) ); ?>
<body class='login'>
<div class="wrapper">
	<h1><a href="index.html"><img src="<?php echo base_url('static/theme/flat/img/logo-big.png'); ?>" alt="" class='retina-ready' width="59" height="49">FLAT</a></h1>
	<div class="login-body">
		<h2>SIGN IN</h2>
		<form class='form-validate' id="form-login">
			<input type="hidden" name="action" value="login_editor" />
			<div class="control-group">
				<div class="email controls">
					<input type="text" name='email' placeholder="Email address" class='input-block-level' data-rule-required="true" data-rule-email="true">
				</div>
			</div>
			<div class="control-group">
				<div class="pw controls">
					<input type="password" name="passwd" placeholder="Password" class='input-block-level' data-rule-required="true">
				</div>
			</div>
			<div class="submit"><input type="submit" value="Sign me in" class='btn btn-primary'></div>
		</form>
		<div class="forget"><a href="#"><span>Forgot password?</span></a></div>
	</div>
</div>
<script>
	$('#form-login').submit(function() {
		if (! $('#form-login').valid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('form-login');
		Func.ajax({ url: web.host + 'ajax/login', param: param, callback: function(result) {
			if (result.status) {
				window.location = result.link;
			} else {
				Func.show_notice({ text: result.message });
			}
		} });
		
		return false;
	});
	
	$('[name="email"]').focus();
</script>
</body>
</html>