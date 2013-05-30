<?php $this->load->view( 'website/common/meta' ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<section id='main'>
	<div class='container'><div class='row'>
		<div class='span9 content'>
			<div class='main-top span9'>
				<div class='span4 no-margin'>
					<h1>Blog</h1>
					<div class='options-line'>
						<div class='breadcrumb-container'>
							<ul class="breadcrumb">
								<li><a href="index.html">Index</a> <span class="divider">&raquo;</span></li>
								 <li><a href="index.html">Kategori</a> <span class="divider">&raquo;</span></li>
								  <li><a href="index.html">Subkategori</a> <span class="divider">&raquo;</span></li>
							</ul>
						</div>
					</div>
				</div>
				<div class='span5 tags-container'>
					<div class="overlay"></div>
					<a href="" class='next-tags'>Next</a>
					<div class='tags'>
						<a href="#"><span>Designer</span></a>
						<a href="#"><span>Apps</span></a>
						<a href="#"><span>Mattew</span></a>
						<a href="#"><span>Love</span></a>
						<a href="#"><span>Hobbies</span></a>
						<a href="#"><span>Mix</span></a>
						<a href="#"><span>Music</span></a>
						<a href="#"><span>World</span></a>

					</div>
				</div>
			</div>
			<div class='span9 news no-margin'>
				<article class='span3-article'>
					<div class='inner'>
						<figure>
							<img src="<?php echo base_url(); ?>static/upload/home-article1.jpg" />
						</figure>
						<h2><a href='#'>mr. Lorem ipsum sit dolor</a></h2>
						<p>
							Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam
						</p>
					</div>
				</article>
				 <article class='span3-article'>
				   <div class='inner'>
						<figure>
							<img src="<?php echo base_url(); ?>static/upload/home-article1.jpg">
						</figure>
					   <h2><a href='#'>mr. Lorem ipsum sit dolor</a></h2>
						<p>
							Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam
						</p>
					</div>
				</article>
				<article class='span3-article'>
					<div class='inner'>
						<figure>
							<img src="<?php echo base_url(); ?>static/upload/home-article2.jpg">
						</figure>
						<h2><a href='#'>mr. Lorem ipsum sit dolor</a></h2>
						<p>
							Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam
						</p>
					</div>
				</article>
			</div>
			<div class='standard-pagination'>
				<ul>
					<li class='active'><a href='#' class='btn'>1</a></li>
					<li><a href='#' class='btn'>2</a></li>
					<li><a href='#' class='btn'>3</a></li>
					<li><a href='#' class='btn'>4</a></li>
					<li><a href='#' class='btn'>5</a></li>
					<li><a href='#' class='btn'>6</a></li>
					<li><a href='#' class='btn'>7</a></li>
					<li><a href='#' class='btn'>8</a></li>
					<li><a href='#' class='btn'>9</a></li>
					<li><a href='#' class='btn'>10</a></li>
				</ul>
			</div>
		</div>
		<aside class='span3'>
			<div class='inner'>
				<?php $this->load->view( 'website/common/register' ); ?>
				<?php $this->load->view( 'website/common/category_list' ); ?>
				<div class='cart'></div>
			</div>
		</aside>
	</div></div>
</section>

<?php $this->load->view( 'website/common/footer' ); ?>