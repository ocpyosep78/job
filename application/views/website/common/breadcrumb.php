<?php
	$array_breadcrumb = (isset($array_breadcrumb)) ? $array_breadcrumb : array();
	$array_button = (isset($array_button)) ? $array_button : array();
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
				
				<?php if (count($array_button) > 0) { ?>
				<div class='buttons'>
					<div class="btn-group">
						<?php foreach ($array_button as $button) { ?>
						<a class="btn show-region" href="<?php echo $button['link']; ?>"><?php echo $button['title']; ?></a>
						<?php } ?>
					</div>
				</div>
				<?php } ?>
			</div>
			<?php if (!empty($sub_title)) { ?>
			<h1><?php echo $sub_title; ?></h1>
			<?php } ?>
		</div>
	</div>
<?php } ?>