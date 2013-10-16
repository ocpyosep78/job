<?php
	$iphone = $this->Widget_model->get_by_id(array( 'alias' => 'iphone' ));
?>
<?php echo $iphone['content']; ?>
