<?php
	$seeker = $this->Seeker_model->get_session();
	$setting = $this->Seeker_Setting_model->get_by_id(array( 'seeker_id' => $seeker['id'] ));
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
				<div class="cnt-setting"><?php echo json_encode($setting); ?></div>
			</div>
			
			<form method="POST" class='form-horizontal' id="form-setting">
				<input type="hidden" name="id" value="0" />
				<input type="hidden" name="seeker_id" value="0" />
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
						<label class='radio'><input type="radio" name="is_subscribe" value="1"> Yes</label>
						<label class='radio'><input type="radio" name="is_subscribe" value="0"> No</label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Sekarang saya telah bekerja</label>
					<div class="controls">
						<label class='radio'><input type="radio" name="is_work" value="1"> Yes</label>
						<label class='radio'><input type="radio" name="is_work" value="0"> No</label>
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
	$('[name="seeker_id"]').val(seeker.id);
	
	// setting
	var raw_setting = $('.cnt-setting').text();
	eval('var setting = ' + raw_setting);
	if (typeof(setting.is_public) != 'undefined') {
		$('[name="id"]').val(setting.id);
		$('[name="is_public"][value=' + setting.is_public + ']').attr('checked', 'checked');
		$('[name="is_subscribe"][value=' + setting.is_subscribe + ']').attr('checked', 'checked');
		$('[name="is_work"][value=' + setting.is_work + ']').attr('checked', 'checked');
	}
	
	$('#form-setting').submit(function() {
		if (! $('#form-setting').valid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('form-setting');
		param.action = 'update';
		param.is_public = $('input[name=is_public]:checked').val();
		param.is_subscribe = $('input[name=is_subscribe]:checked').val();
		param.is_work = $('input[name=is_work]:checked').val();
		
		Func.ajax({ url: web.host + 'seeker/setting/action', param: param, callback: function(result) {
			if (result.status == 1) {
				$('[name="id"]').val(result.id);
				Func.show_notice({ text: result.message });
			}
		} });
		
		return false;
	});
</script>
</body>
</html>