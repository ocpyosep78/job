<?php $this->load->view( 'panel/common/meta' ); ?>
<body data-layout="fixed">
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Edit Resume', 'class' => 'icon-edit' ) ); ?>
		
		<div class="box-content">
			<form class='form-horizontal form-validate' id="form-resume">
				<div class="control-group">
					<label for="first_name" class="control-label">First Name</label>
					<div class="controls">
						<input type="text" name="first_name" id="first_name" class="input-xlarge" data-rule-required="true" />
						<span class="help-block">Maximum 20 characters</span>
					</div>
				</div>
				<div class="control-group">
					<label for="last_name" class="control-label">Last Name</label>
					<div class="controls">
						<input type="text" name="last_name" id="last_name" class="input-xlarge">
						<span class="help-block">Maximum 20 characters</span>
					</div>
				</div>
				<div class="control-group">
					<label for="first_name" class="control-label">Tanggal</label>
					<div class="controls">
						<input type="text" name="first_name" id="first_name" class="input-xlarge datepick" />
						<span class="help-block">Maximum 20 characters</span>
					</div>
				</div>
				<div class="control-group">
					<label for="nama_ibu_kandung" class="control-label">Nama Ibu Kandung</label>
					<div class="controls">
						<input type="text" name="nama_ibu_kandung" id="nama_ibu_kandung" class="input-xlarge">
						<span class="help-block">Maximum 20 characters</span>
					</div>
				</div>
				<div class="control-group">
					<label for="address" class="control-label">Adress</label>
					<div class="controls">
						<textarea name="address" id="address" class="input-block-level"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label for="provinsi" class="control-label">Provinsi</label>
					<div class="controls">
						<select name="provinsi" id="provinsi" class='input-large'>
							<option value="1">Provinsi-1</option>
							<option value="2">Provinsi-2</option>
							<option value="3">Provinsi-3</option>
							<option value="4">Provinsi-4</option>
							<option value="5">Provinsi-5</option>
							<option value="6">Provinsi-6</option>
							<option value="7">Provinsi-7</option>
							<option value="8">Provinsi-8</option>
							<option value="9">Provinsi-9</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label for="kota" class="control-label">Kota</label>
					<div class="controls">
						<select name="kota" id="kota" class='input-large'>
							<option value="1">Kota-1</option>
							<option value="2">Kota-2</option>
							<option value="3">Kota-3</option>
							<option value="4">Kota-4</option>
							<option value="5">Kota-5</option>
							<option value="6">Kota-6</option>
							<option value="7">Kota-7</option>
							<option value="8">Kota-8</option>
							<option value="9">Kota-9</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label for="home_phone_number" class="control-label">Home Phone Number</label>
					<div class="controls">
						<input type="text" name="home_phone_number" id="home_phone_number" class="input-xlarge">
						<span class="help-block">example: +62 21 5678910</span>
					</div>
				</div>
				<div class="control-group">
					<label for="mobile_number" class="control-label">Mobile Number</label>
					<div class="controls">
						<input type="text" name="mobile_number" id="mobile_number" class="input-xlarge">
						<span class="help-block">example: +62 21 5678910</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Gender</label>
					<div class="controls">
						<label class='radio'>
							<input type="radio" name="male"> Male
						</label>
						<label class='radio'>
							<input type="radio" name="female"> Female
						</label>
					</div>
				</div>
				<div class="control-group">
					<label for="tempat" class="control-label">Tempat</label>
					<div class="controls">
						<input type="text" name="tempat" id="tempat" class="input-xlarge">
						<select name="tanggal" id="Tanggal" class='input-large'>
							<?php
								for ($i=1; $i<=31; $i++) {
									echo "<option value=".$i.">".$i."</option>";
								}
							?>
						</select>
						<select name="bulan" id="Bulan" class='input-large'>
							<option value="1">Januari</option>
							<option value="2">Februari</option>
							<option value="3">Maret</option>
							<option value="4">April</option>
							<option value="5">Mei</option>
							<option value="6">Juni</option>
							<option value="7">Juli</option>
							<option value="8">Agustus</option>
							<option value="9">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
						</select>
						<select name="tahun" id="Tahun" class='input-large'>
							<?php
								for ($i=1950; $i<=2013; $i++) {
									echo "<option value=".$i.">".$i."</option>";
								}
							?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label for="umur" class="control-label">Umur</label>
					<div class="controls">
						<input type="text" name="umur" id="umur" class="input-xlarge">
					</div>
				</div>
				<div class="control-group">
					<label for="citizenship" class="control-label">Citizenship</label>
					<div class="controls">
						<input type="text" name="citizenship" id="citizenship" class="input-xlarge">
						<span class="help-block">Enter you citizenship / Masukkan kewarganegaraan anda</span>
					</div>
				</div>
				<div class="control-group">
					<label for="religion" class="control-label">Religion</label>
					<div class="controls">
						<input type="text" name="religion" id="religion" class="input-xlarge">
						<span class="help-block">Enter you citizenship / Masukkan kewarganegaraan anda</span>
					</div>
				</div>
				<div class="control-group">
					<label for="marital_status" class="control-label">Marital Status</label>
					<div class="controls">
						<select name="marital_status" id="marital_status" class='input-large'>
							<option value="1">Single</option>
							<option value="2">Married</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label for="social_information" class="control-label">Social Information</label>
				</div>
				
				<div class="box box-color box-bordered teal">
					<div class="box-title">
						<h3><i class="icon-file"></i> Social Information</h3>
					</div>
					<div class="box-content">
						<div class="control-group">
							<label for="facebook" class="control-label">Facebook</label>
							<div class="controls">
								<input type="text" name="facebook" id="facebook" class="input-xlarge">
							</div>
						</div>
						<div class="control-group">
							<label for="twitter" class="control-label">Twitter</label>
							<div class="controls">
								<input type="text" name="twitter" id="twitter" class="input-xlarge">
							</div>
						</div>
					</div>
				</div>
				
				<div class="form-actions">
					<button type="submit" class="btn btn-primary save">Save changes</button>
					<button type="button" class="btn">Cancel</button>
				</div>
			</form>
		</div>
	</div></div></div></div></div>
	
	<script>
		$('#form-resume .save').click(function() {
			if (! $('#form-resume').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('form-resume');
			param.action = 'update';
			Func.ajax({ url: web.host + 'seeker/resume/action', param: param, callback: function(result) {
				if (result.status == 1) {
					Func.show_notice({ text: result.message });
				}
			} });
			
			return false;
		});
	</script>
</div>
</body>
</html>