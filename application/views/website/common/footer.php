<?php
	$about = $this->Widget_model->get_by_id(array( 'alias' => 'about_dunia_karir' ));
	$payment = $this->Widget_model->get_by_id(array( 'alias' => 'payment' ));
?>
<footer>
	<div class='container'>
		<div class='row'>
			<div class='span9 footer-big'>
				<div class='span6'><?php echo $about['content']; ?></div>
				<div class='span3'>
					<h1>Payment Methods</h1>
					<div class='payment-links'>
						<?php echo $payment['content']; ?>
					</div>
					<h1>Newsletter</h1>
					<form action="" method="post" accept-charset="utf-8">
						<input type='email' name='newsletter-email' placeholder='Enter Your E-Mail' />
						<input type='submit' name='submit' value='Enter' class='btn btn-white' />
					</form>
				</div>
				<div class='footer-links'>
					<ul>
						<li class='active'><a href='<?php echo base_url(); ?>' title='Home'>Home</a></li>
						<li><a href='<?php echo base_url('blog'); ?>' title='Blog'>Blog</a> </li>
						<li><a href='<?php echo base_url('event'); ?>' title='Events'>Events</a></li>
					</ul>
				</div>
			</div>
			<div class='span3'>
				<h1>Contact Us</h1>
				<form id="form-contact">
					<span class="message"></span>
					<input type="hidden" name="action" value="sent_mail" />
					<input type="text" name="title" placeholder="Your Name" class="required" alt="Field belum diisi" />
					<input type="email" name="email" placeholder="Your E-Mail" class="required" alt="Field belum diisi" />
					<textarea name="message" placeholder="Your Message" class="required" alt="Field belum diisi"></textarea>
					<input type="submit" name="submit" value="Send" class="form-submit btn btn-white" />
				</form>
			</div>
		</div>
	</div>
</footer>

<div id='ending-line'>
	<div class='container'>
		<div class='row'>
			<div class='copyright pull-left span4'>
				<span>Duniakarir &copy; 2012, developed by <a href="http://teothemes.com">TeoThemes</a></span>
			</div>
			<div class='go-up-container span4'>
				<a href='#' title='Go Up' class='go-up'>Go up</a>
			</div>
			<div class='bottom-logo pull-right span4'>
				<a href="#"><img src='<?php echo base_url(); ?>static/upload/bottom-logo.png' /></a>
			</div>
		</div>
	</div>
</div>

</body>
</html>