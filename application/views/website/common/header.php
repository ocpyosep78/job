<body>

<header>
	<div class="container">
		<div class="row">
			<div class="span2">
				<a href="<?php echo base_url(); ?>"><figure><i class="logo-replacement"></i></figure></a>
			</div>
			<div class="span7-header">
				<nav>
					<ul>
						<li class="active"><a href="<?php echo base_url(); ?>" title="Home">Home</a> </li>
						<li><a href="<?php echo base_url('blog'); ?>" title="Blog">Blog</a></li>
						<li><a href="<?php echo base_url('event'); ?>" title="Events"> Events </a> </li>
					</ul>
				</nav>
			</div>
			<div class="span3-header search-container">
				<form action="" method="get" accept-charset="utf-8" class="search-form">
					<input type="text" name="search" placeholder="Search" />
					<input type="submit" name="submit" value="Search" />
				</form>
			</div>
		</div>
	</div>
</header>