<?php
	$name = (empty($name)) ? 'Modul Name' : $name;
	$class = (empty($class)) ? 'icon-reorder' : $class;
?>
<div class="box-title">
	<h3>
		<i class="<?php echo $class; ?>"></i>
		<?php echo $name; ?>
	</h3>
</div>