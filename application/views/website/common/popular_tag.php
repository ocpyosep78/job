<?php
	$array_tag = $this->Tag_model->get_popular();
?>

<div class='categories widget'>
	<div class='top-line'>
		<h1>Popular Tag</h1>
	</div>
	<div class="list">
		<ul>
			<?php foreach ($array_tag as $item) { ?>
			<li><a href="<?php echo $item['tag_link']; ?>"><?php echo $item['nama']; ?></a></li>
			<?php } ?>
		</ul>
	</div>
</div>