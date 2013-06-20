<?php
	$seeker = $this->Seeker_model->get_session();
	$seeker_resume = $this->Seeker_model->get_resume(array( 'id' => $seeker['id'] ));
	$array_surat_lamaran = $this->Surat_Lamaran_model->get_array(array( 'seeker_id' => $seeker['id'] ));
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Kirim Lamaran' ) ); ?>
<body data-layout="fixed">
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Kirim Lamaran', 'class' => 'icon-edit' ) ); ?>
		
		<div class="box-content">
			<?php if (! $seeker_resume['is_pass']) { ?>
			<div class="row-fluid margin-top">
				<div class="alert alert-info">Harap melengkapi resume sebelum melamar pekerjaan.</div>
			</div>
			<?php } ?>
			
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
					<label for="input-company" class="control-label">Nama Perusahaan</label>
					<div class="controls"><input type="text" name="company" id="input-company" class="input-xxlarge" data-rule-required="true" /></div>
				</div>
				<div class="control-group">
					<label for="nama_perusahaan" class="control-label">Cover Letter</label>
					<div class="controls"><textarea name="content" id="input-content1" class="tinymce span9" style="height: 350px; width: 700px;"></textarea></div>
				</div>
				<div class="control-group" style="margin-bottom: 0px;">
					<div class="controls"><label for="nama_perusahaan" class="control-label" style="width: 700px;">Yang kan di kirim : (attachment)</label></div>
				</div>
				<div class="control-group">
					<div class="controls">
						<label class='checkbox'><input type="checkbox" name="with_resume" value="1" /> Resume</label>
						<label class='checkbox'><input type="checkbox" name="with_photo" value="1" /> Foto Saya</label>
						<div style="float: left; width: 20px;"><input type="checkbox" name="with_letter" value="1" /></div>
						<select name="surat_lamaran_id" class='input-large'>
							<?php echo ShowOption(array( 'Array' => $array_surat_lamaran, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
						</select>
					</div>
				</div>
				<div class="form-actions">
					<?php if ($seeker_resume['is_pass']) { ?>
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="button" class="btn">Cancel</button>
					<?php } ?>
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
		param.with_resume = ($('[name="with_resume"]').is(":checked")) ? 1 : 0;
		param.with_photo = ($('[name="with_photo"]').is(":checked")) ? 1 : 0;
		
		var with_letter = ($('[name="with_letter"]').is(":checked")) ? 1 : 0;
		delete param.with_letter;
		if (with_letter == 1) {
			param.surat_lamaran_id = $('[name="surat_lamaran_id"]').val();
		} else {
			delete param.surat_lamaran_id;
		}
		
		Func.ajax({ url: web.host + 'seeker/sent/action', param: param, callback: function(result) {
			if (result.status == 1) {
				Func.show_notice({ text: result.message });
			}
		} });
		
		return false;
	});
</script>
</body>
</html>