<?php
	$seeker = $this->Seeker_model->get_session();
	
	$array_propinsi = $this->Propinsi_model->get_array(array('negara_id' => NEGARA_INDONESIA_ID));
	$array_kelamin = $this->Kelamin_model->get_array();
	$array_marital = $this->Marital_model->get_array();
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Edit Resume' ) ); ?>
<body data-layout="fixed">
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Edit Resume', 'class' => 'icon-edit' ) ); ?>
		
		<div class="box-content">
			<div class="hide">
				<div class="cnt-seeker"><?php echo json_encode($seeker); ?></div>
			</div>
			
			<form class='form-horizontal form-validate' id="form-resume">
				<input type="hidden" name="id" value="0" />
				
				<div class="control-group">
					<label for="first_name" class="control-label">First Name</label>
					<div class="controls">
						<input type="text" name="first_name" id="first_name" class="input-xlarge" data-rule-required="true" maxlength="20" />
						<span class="help-block">Maximum 20 characters</span>
					</div>
				</div>
				<div class="control-group">
					<label for="last_name" class="control-label">Last Name</label>
					<div class="controls">
						<input type="text" name="last_name" id="last_name" class="input-xlarge" maxlength="20" />
						<span class="help-block">Maximum 20 characters</span>
					</div>
				</div>
				<div class="control-group">
					<label for="address" class="control-label">Address</label>
					<div class="controls">
						<textarea name="address" id="address" class="input-block-level"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label for="propinsi_id" class="control-label">Propinsi</label>
					<div class="controls"><select name="propinsi_id" id="propinsi_id" class="input-xlarge">
						<?php echo ShowOption(array( 'Array' => $array_propinsi, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
					</select></div>
				</div>
				<div class="control-group">
					<label for="kota_id" class="control-label">Kota</label>
					<div class="controls"><select name="kota_id" id="kota_id" class="input-xlarge">
						<?php echo ShowOption(array( 'Array' => array(), 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
					</select></div>
				</div>
				<div class="control-group">
					<label for="phone" class="control-label">Home Phone Number</label>
					<div class="controls">
						<input type="text" name="phone" id="phone" class="input-xlarge">
						<span class="help-block">example: +62 21 5678910</span>
					</div>
				</div>
				<div class="control-group">
					<label for="hp" class="control-label">Mobile Number</label>
					<div class="controls">
						<input type="text" name="hp" id="hp" class="input-xlarge">
						<span class="help-block">example: +62 21 5678910</span>
					</div>
				</div>
				<div class="control-group">
					<label for="kelamin_id" class="control-label">Gender</label>
					<div class="controls"><select name="kelamin_id" id="kelamin_id" class='input-xlarge'>
						<?php echo ShowOption(array( 'Array' => $array_kelamin, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
					</select></div>
				</div>
				<div class="control-group">
					<label for="tempat_lahir" class="control-label">Tempat Lahir</label>
					<div class="controls">
						<input type="text" name="tempat_lahir" id="tempat_lahir" class="input-xlarge" />
					</div>
				</div>
				<div class="control-group">
					<label for="tgl_lahir" class="control-label">Tanggal Lahir</label>
					<div class="controls">
						<input type="text" name="tgl_lahir" id="tgl_lahir" class="input-xlarge datepick" />
					</div>
				</div>
				<div class="control-group">
					<label for="kebangsaan" class="control-label">Citizenship</label>
					<div class="controls">
						<input type="text" name="kebangsaan" id="kebangsaan" class="input-xlarge">
						<span class="help-block">Enter you kebangsaan / Masukkan kewarganegaraan anda</span>
					</div>
				</div>
				<div class="control-group">
					<label for="agama" class="control-label">Religion</label>
					<div class="controls">
						<input type="text" name="agama" id="agama" class="input-xlarge">
						<span class="help-block">Enter you religion / Masukkan agama anda</span>
					</div>
				</div>
				<div class="control-group">
					<label for="marital_id" class="control-label">Marital Status</label>
					<div class="controls"><select name="marital_id" id="marital_id" class='input-xlarge'>
						<?php echo ShowOption(array( 'Array' => $array_marital, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
					</select></div>
				</div>
				<div class="control-group">
					<label for="ibu_kandung" class="control-label">Nama Ibu Kandung</label>
					<div class="controls">
						<input type="text" name="ibu_kandung" id="ibu_kandung" class="input-xlarge" />
					</div>
				</div>
				
				<div class="box box-color box-bordered teal">
					<div class="box-title">
						<h3><i class="icon-file"></i> Social Information</h3>
					</div>
					<div class="box-content">
						<div class="control-group">
							<label for="input-facebook" class="control-label">Facebook</label>
							<div class="controls"><input type="text" name="facebook" id="input-facebook" class="input-xlarge"></div>
						</div>
						<div class="control-group">
							<label for="input-twitter" class="control-label">Twitter</label>
							<div class="controls"><input type="text" name="twitter" id="input-twitter" class="input-xlarge"></div>
						</div>
					</div>
				</div>
				
				<div class="box box-color box-bordered teal">
					<div class="box-title">
						<h3><i class="icon-file"></i> Change Password</h3>
					</div>
					<div class="box-content">
						<div class="control-group">
							<label for="input-passwd" class="control-label">Password</label>
							<div class="controls"><input type="password" name="passwd" id="input-passwd" class="input-xlarge" data-rule-samevalue="true" data-classname="password" /></div>
						</div>
						<div class="control-group">
							<label for="input-passwd_confirm" class="control-label">Confirm Password</label>
							<div class="controls"><input type="password" name="passwd_confirm" id="input-passwd_confirm" class="input-xlarge" data-rule-samevalue="true" data-classname="password" /></div>
						</div>
					</div>
				</div>
				
				<div class="control-group">
					<div class="controls" style="margin: 0; padding: 25px 0 0 0;">
						<label class="checkbox">
							<input type="checkbox" name="declaration" value="1" />
							Declaration<br />
							I confirm that the information given in this application is true, accurate  and complete and I agree to the use of my information as detailed in the privacy statement.
						</label>
					</div>
				</div>
				
				<div class="form-actions">
					<button type="submit" class="btn btn-primary save">Save changes</button>
					<a href="<?php echo base_url('seeker/resume'); ?>" class="btn">Resume</a>
				</div>
			</form>
		</div>
	</div></div></div></div></div>
</div>

<script>
	var seeker = Func.get_seeker();
	$('[name="id"]').val(seeker.id);
	$('[name="first_name"]').val(seeker.first_name);
	$('[name="last_name"]').val(seeker.last_name);
	$('[name="address"]').val(seeker.address);
	$('[name="propinsi_id"]').val(seeker.propinsi_id);
	$('[name="kota_id"]').val(seeker.kota_id);
	$('[name="phone"]').val(seeker.phone);
	$('[name="hp"]').val(seeker.hp);
	$('[name="kelamin_id"]').val(seeker.kelamin_id);
	$('[name="tempat_lahir"]').val(seeker.tempat_lahir);
	$('[name="tgl_lahir"]').val(Func.SwapDate(seeker.tgl_lahir));
	$('[name="kebangsaan"]').val(seeker.kebangsaan);
	$('[name="agama"]').val(seeker.agama);
	$('[name="marital_id"]').val(seeker.marital_id);
	$('[name="ibu_kandung"]').val(seeker.ibu_kandung);
	$('[name="facebook"]').val(seeker.facebook);
	$('[name="twitter"]').val(seeker.twitter);
	
	// set kota
	combo.kota({ propinsi_id: seeker.propinsi_id, target: $('[name="kota_id"]'), callback: function() { $('[name="kota_id"]').val(seeker.kota_id); } });
	
	// change event
	$('[name="propinsi_id"]').change(function() {
		combo.kota({ propinsi_id: $('[name="propinsi_id"]').val(), target: $('[name="kota_id"]') })
	});
	
	$('#form-resume').submit(function() {
		if (! $('#form-resume').valid()) {
			return false;
		} else if (! $('[name="declaration"]').is(":checked")) {
			return false;
		}
		
		var param = Site.Form.GetValue('form-resume');
		param.action = 'update';
		param.tgl_lahir = Func.SwapDate(param.tgl_lahir);
		param.update_session = 1;
		Func.ajax({ url: web.host + 'seeker/resume/action', param: param, callback: function(result) {
			if (result.status == 1) {
				Func.show_notice({ text: result.message });
			}
		} });
		
		return false;
	});
</script>
</body>
</html>