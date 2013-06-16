<?php
	$title = (!empty($title)) ? $title : 'FLAT - Blank Page';
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title><?php echo $title; ?></title>
	<link rel="shortcut icon" href="<?php echo base_url('static/theme/flat/img/favicon.ico'); ?>" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url('static/theme/flat/img/apple-touch-icon-precomposed.png'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('static/css/flexslider.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('static/theme/flat/css/bootstrap.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('static/theme/flat/css/bootstrap-responsive.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('static/theme/flat/css/plugins/datepicker/datepicker.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('static/theme/flat/css/plugins/jquery-ui/smoothness/jquery-ui.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('static/theme/flat/css/plugins/jquery-ui/smoothness/jquery.ui.theme.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('static/theme/flat/css/plugins/datatable/TableTools.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('static/theme/flat/css/plugins/chosen/chosen.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('static/theme/flat/css/plugins/gritter/jquery.gritter.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('static/theme/flat/css/plugins/timepicker/bootstrap-timepicker.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('static/theme/flat/css/plugins/select2/select2.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('static/theme/flat/css/plugins/tagsinput/jquery.tagsinput.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('static/theme/flat/css/style.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('static/theme/flat/css/themes.css'); ?>">
	
	<script>var web = { host: '<?php echo base_url(); ?>' };</script>
	<script src="<?php echo base_url('static/theme/flat/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/js/jquery.flexslider.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/nicescroll/jquery.nicescroll.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/imagesLoaded/jquery.imagesloaded.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/jquery-ui/jquery.ui.core.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/jquery-ui/jquery.ui.widget.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/jquery-ui/jquery.ui.mouse.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/jquery-ui/jquery.ui.resizable.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/jquery-ui/jquery.ui.sortable.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/bootbox/jquery.bootbox.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/form/jquery.form.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/validation/jquery.validate.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/validation/additional-methods.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/datatable/jquery.dataTables.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/datatable/ColReorder.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/datatable/TableTools.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/datatable/ColVis.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/datatable/jquery.dataTables.columnFilter.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/chosen/chosen.jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/gritter/jquery.gritter.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/timepicker/bootstrap-timepicker.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/select2/select2.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/plugins/tagsinput/jquery.tagsinput.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/lib/tinymce/jscripts/tiny_mce/jquery.tinymce.js'); ?>"></script>
	<script src="<?php echo base_url('static/js/common.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/eakroko.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/application.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/theme/flat/js/demonstration.js'); ?>"></script>
	
	<!--[if lte IE 9]>
		<script src="<?php echo base_url('static/theme/flat/js/plugins/placeholder/jquery.placeholder.min.js'); ?>"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
</head>