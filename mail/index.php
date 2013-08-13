<?php
	include 'config.php';
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<style>
		.clear { clear: both; }
		label.error { display: inline-block; padding: 0 0 10px 0; color: red; font-size: 12px; }
		
		#form-mail .left { float: left; width : 150px; text-align: right; padding: 0 10px 10px 0; }
		#form-mail .right { float: left; width : 600px; }
	</style>
	
	<script>var web = <?php echo json_encode(array( 'host' => HOST )); ?>;</script>
	<script src="<?php echo HOST.'/static/js/jquery.min.js'; ?>"></script>
	<script src="<?php echo HOST.'/static/js/tinymce/jscripts/tiny_mce/jquery.tinymce.js'; ?>"></script>
	<script src="<?php echo HOST.'/static/js/validation/jquery.validate.min.js'; ?>"></script>
	<script src="<?php echo HOST.'/static/js/validation/additional-methods.min.js'; ?>"></script>
	<script src="<?php echo HOST.'/static/js/common.js'; ?>"></script>
</head>
<body>
<div id="form-mail"><form>
	<div class="left">To :</div>
	<div class="right"><input type="text" name="to" style="width: 500px;" /></div>
	<div class="clear"></div>
	<div class="left">Subject :</div>
	<div class="right"><input type="text" name="subject" style="width: 500px;" /></div>
	<div class="clear"></div>
	<div class="left">Message :</div>
	<div class="right"><textarea name="message" class="tinymce" style="width: 500px; height: 400px;"></textarea></div>
	<div class="clear"></div>
	<div class="left">&nbsp;</div>
	<div class="right" style="padding: 10px 0 0 0;"><input type="submit" name="submit" style="width: 100px;" /></div>
	<div class="clear"></div>
</form></div>

<script>
	$('textarea.tinymce').tinymce({
		// Location of TinyMCE script
		script_url : web.host + '/static/js/tinymce/jscripts/tiny_mce/tiny_mce.js',
		
		// General options
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true
	});
	
	$('#form-mail form').validate({
		rules: {
			to: { required: true, email: true },
			subject: { required: true }
		}
	});
	
	$('#form-mail form').submit(function() {
		if (! $('#form-mail form').valid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('form-mail');
		param.action = 'sent_mail';
		Func.ajax({ url: web.host + '/index.php', param: param, callback: function(result) {
			alert(result.message);
			if (result.status == 1) {
				$('#form-mail form')[0].reset();
			}
		} });
		
		return false;
	});
</script>
</body>
</html>