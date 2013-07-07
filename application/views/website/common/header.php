<?php
	$keyword = (!empty($_POST['keyword'])) ? $_POST['keyword'] : '';
?>
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
						<li><a href="<?php echo base_url('jobs'); ?>" title="Blog">Blog</a></li>
						<li><a href="<?php echo base_url('event'); ?>" title="Events"> Events </a> </li>
					</ul>
				</nav>
			</div>
			<div class="span3-header search-container">
				<form action="<?php echo base_url('search'); ?>" method="post" class="search-form">
					<input type="text" name="keyword" placeholder="Search" value="<?php echo $keyword; ?>" />
					<input type="submit" name="submit" value="Search" />
				</form>
			</div>
		</div>
	</div>
</header>