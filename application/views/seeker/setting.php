<?php
	$seeker = $this->Seeker_model->get_session();
?>

<?php $this->load->view( 'panel/common/meta' ); ?>
<body data-layout="fixed">
<?php $this->load->view( 'panel/common/navigation' ); ?>

<style>
.control-label { width: 300px !important; }
.controls { margin-left: 300px !important; }
</style>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Setting', 'class' => 'icon-edit' ) ); ?>
		
		<div class="box-content">
			<div class="hide">
				<div class="cnt-seeker"><?php echo json_encode($seeker); ?></div>
			</div>
			
			<form method="POST" class='form-horizontal' id="form-setting">
				<div class="control-group">
					<label class="control-label">Show my profile to public</label>
					<div class="controls">
						<label class='radio'><input type="radio" name="is_public" value="1" /> Yes</label>
						<label class='radio'><input type="radio" name="is_public" value="0" /> No</label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Berhenti berlangganan Subscribe jobs</label>
					<div class="controls">
						<label class='radio'><input type="radio" name="berhenti_berlangganan_subscribe_jobs"> Yes</label>
						<label class='radio'><input type="radio" name="berhenti_berlangganan_subscribe_jobs"> No</label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Sekarang saya telah bekerja</label>
					<div class="controls">
						<label class='radio'><input type="radio" name="sekarang_saya_telah_bekerja"> Yes</label>
						<label class='radio'><input type="radio" name="sekarang_saya_telah_bekerja"> No</label>
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<button type="button" class="btn">Cancel</button>
				</div>
			</form>
		</div>
	</div></div></div></div></div>
</div>


<script>
	var seeker = Func.get_seeker();
	$('[name="id"]').val(seeker.id);
	// lanjutin disini
	
	$('#form-setting').submit(function() {
		if (! $('#form-setting').valid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('form-setting');
		param.action = 'update';
		param.is_public = $('input[name=is_public]:checked').val()
		console.log(param);
		
		Func.ajax({ url: web.host + 'seeker/setting/action', param: param, callback: function(result) {
			if (result.status == 1) {
				Func.show_notice({ text: result.message });
			}
		} });
		
		return false;
	});
</script>
</body>
</html>