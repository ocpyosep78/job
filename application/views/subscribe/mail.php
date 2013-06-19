<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Kirim Email' ) ); ?>
<body data-layout="fixed">
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Kirim Email', 'class' => 'icon-edit' ) ); ?>
		
		<div class="box-content">
			<form class='form-horizontal form-validate' id="form-mail">
				<div class="control-group">
					<label for="input-to" class="control-label">To</label>
					<div class="controls"><input type="text" name="to" id="input-to" class="input-xxlarge" data-rule-required="true" data-rule-email="true" /></div>
				</div>
				<div class="control-group">
					<label for="input-subject" class="control-label">Title / Subject</label>
					<div class="controls"><input type="text" name="subject" id="input-subject" class="input-xxlarge" data-rule-required="true" /></div>
				</div>
				<div class="control-group">
					<label for="nama_perusahaan" class="control-label">Isi Email</label>
					<div class="controls"><textarea name="content" id="input-content1" class="tinymce span9" style="height: 350px; width: 700px;"></textarea></div>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="button" class="btn">Cancel</button>
				</div>
			</form>
		</div>
	</div></div></div></div></div>
</div>
<script>
	$('#form-mail').submit(function() {
		if (! $('#form-mail').valid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('form-mail');
		param.action = 'sent_mail';
		Func.ajax({ url: web.host + 'subscribe/mail/action', param: param, callback: function(result) {
			if (result.status == 1) {
				Func.show_notice({ text: result.message });
			}
		} });
		
		return false;
	});
</script>
</body>
</html>