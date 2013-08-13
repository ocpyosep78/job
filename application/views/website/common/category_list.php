<?php
	preg_match('/path\/([a-z0-9\-]+)$/i', $_SERVER['REQUEST_URI'], $match);
	$alias = (isset($match[1]) && !empty($match[1])) ? $match[1] : '';
	
	$kategori = $this->Kategori_model->get_by_id(array( 'alias' => $alias ));
	if (count($kategori) > 0) {
		$array_subkategori = $this->Subkategori_model->get_array(array( 'kategori_id' => $kategori['id'], 'limit' => 20 ));
	} else {
		$array_kategori = $this->Kategori_model->get_array(array( 'limit' => 20 ));
	}
?>

<?php if (isset($array_subkategori)) { ?>
<div class='categories widget'>
	<div class='top-line'>
		<h1>Sub Categories</h1>
	</div>
	<div class="list">
		<ul>
			<?php foreach ($array_subkategori as $item) { ?>
			<li><a href="<?php echo $item['link']; ?>"><?php echo $item['nama']; ?></a></li>
			<?php } ?>
		</ul>
	</div>
</div>
<?php } else { ?>
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
<?php } ?>