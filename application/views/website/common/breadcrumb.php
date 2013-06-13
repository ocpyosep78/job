<?php
	$array_breadcrumb = (isset($array_breadcrumb)) ? $array_breadcrumb : array();
?>
<?php if (count($array_breadcrumb) > 0) { ?>
	<div class='main-top span9'>
		<div class='span9 no-margin'>
			<?php if (!empty($title)) { ?>
			<h1><?php echo $title; ?></h1>
			<?php } ?>
			<div class='options-line'>
				<div class='breadcrumb-container'>
					<ul class="breadcrumb">
						<?php foreach ($array_breadcrumb as $key => $array) { ?>
							<?php if ($key < (count($array_breadcrumb) - 1)) { ?>
								<li><a href="<?php echo $array['link']; ?>"><?php echo $array['title']; ?></a> <span class="divider">&raquo;</span></li>
							<?php } else if (!empty($array['link'])) { ?>
								<li class="active"><a href="<?php echo $array['link']; ?>"><?php echo $array['title']; ?></a></li>
							<?php } else { ?>
								<li class="active"><?php echo $array['title']; ?></li>
							<?php } ?>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
<?php } ?>