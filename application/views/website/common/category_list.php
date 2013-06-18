<?php
	$array_kategori = $this->Kategori_model->get_array(array( 'limit' => 20 ));
?>
<div class='categories widget'>
	<div class='top-line'>
		<h1>Categories</h1>
	</div>
	<div class="list">
		<ul>
			<?php foreach ($array_kategori as $item) { ?>
			<li><a href="<?php echo $item['link']; ?>"><?php echo $item['nama']; ?></a></li>
			<?php } ?>
		</ul>
	</div>
</div>