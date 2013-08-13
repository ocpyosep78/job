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
						<li><a href="<?php echo base_url('blog'); ?>" title="Blog">Blog</a></li>
						<li><a href="<?php echo base_url('event'); ?>" title="Events">Events</a></li>
						<li><a href="<?php echo base_url('region'); ?>" title="Region">Region</a></li>
					</ul>
				</nav>
			</div>
			<div class="span3-header search-container">
				<form action="<?php echo base_url('search'); ?>" method="post" class="search-form" id="form-header">
					<input type="hidden" name="propinsi_id" value="0" />
					<input type="text" name="keyword" placeholder="Search" value="<?php echo $keyword; ?>" />
					<input type="submit" name="submit" value="Search" />
				</form>
				<script>
					$('#form-header').submit(function() {
						var name = Func.GetName($('#form-header [name="keyword"]').val());
						var action = $('#form-header').attr('action') + '/' + name;
						$('#form-header').attr('action', action);
					});
				</script>
			</div>
		</div>
	</div>
</header>