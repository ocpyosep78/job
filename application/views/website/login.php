<?php $this->load->view( 'website/common/meta' ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<section id='main'>
	<div class='container'><div class='row'>
		<div class='span9 content'>
				<div class='main-top span9'>
					<div class='span9 no-margin'>
					   
						<div class='options-line'>
							<div class='breadcrumb-container'>
								<ul class="breadcrumb">
									<li><a href="index.html">Index</a> <span class="divider">&raquo;</span></li>
									<li><a href="blog.html">Blog</a> <span class="divider">&raquo;</span></li>
									<li class="active">mr. Lorem ipsum sit dolor</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class='span9 news blog-article no-margin' style="padding: 0 0 100px 0;">
					<h2>Login</h2>
					
					<div class="cnt-block">
						<form class="cnt-form">
							<h1>PENCARI KERJA</h1>
							<fieldset class="inputs">
								<input class="user" type="text" placeholder="Username" autofocus required>   
								<input class="pass" type="password" placeholder="Password" required>
							</fieldset>
							<fieldset class="actions">
								<input type="submit" class="btn-submit" value="Log in">
								<a href="">Lupa password?</a><a href="">Register</a>
							</fieldset>
						</form>
					</div>
					<div class="cnt-block">
						<form class="cnt-form">
							<h1>PERUSAHAAN</h1>
							<fieldset class="inputs">
								<input class="user" type="text" placeholder="Username" autofocus required>   
								<input class="pass" type="password" placeholder="Password" required>
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

<?php $this->load->view( 'website/common/footer' ); ?>