<?php
	$company = $this->Company_model->get_session();
	$array_propinsi = $this->Propinsi_model->get_array(array('negara_id' => NEGARA_INDONESIA_ID));
	$array_industri = $this->Industri_model->get_array();
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Profile' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Profile', 'class' => 'icon-edit' ) ); ?>
		
		<div class="box-content">
			<div class="hide">
				<div class="cnt-company"><?php echo json_encode($company); ?></div>
				<iframe name="iframe_company_logo" src="<?php echo base_url('panel/upload?callback=company_logo'); ?>"></iframe>
				<iframe name="iframe_company_banner" src="<?php echo base_url('panel/upload?callback=company_banner'); ?>"></iframe>
			</div>
			
			<form class='form-horizontal form-validate' id="form-company">
				<input type="hidden" name="id" value="0" />
				
				<div class="box box-color box-bordered teal">
					<div class="box-title"><h3><i class="icon-file"></i> Company Login Details</h3></div>
					<div class="box-content">
						<div class="control-group">
							<label for="input-email" class="control-label">Email Address</label>
							<div class="controls"><input type="text" name="email" id="input-email" class="input-xlarge" data-rule-required="true" data-rule-email="true" data-rule-samevalue="true" data-classname="email" /></div>
						</div>
						<div class="control-group">
							<label for="input-email_check" class="control-label">Retype Email Address</label>
							<div class="controls"><input type="text" name="email_check" id="input-email_check" class="input-xlarge" data-rule-samevalue="true" data-classname="email" /></div>
						</div>
						<div class="control-group">
							<label for="input-passwd" class="control-label">Password</label>
							<div class="controls"><input type="password" name="passwd" id="input-password" class="input-xlarge" data-rule-samevalue="true" data-classname="password" /></div>
						</div>
						<div class="control-group">
							<label for="input-passwd_check" class="control-label">Retype your Password</label>
							<div class="controls"><input type="password" name="passwd_check" id="input-passwd_check" class="input-xlarge" data-rule-samevalue="true" data-classname="password" /></div>
						</div>
					</div>
				</div>
				
				<div class="box box-color box-bordered teal">
					<div class="box-title"><h3><i class="icon-file"></i> Company Information</h3></div>
					<div class="box-content">
						<div class="control-group">
							<label for="input-nama" class="control-label">Company Name</label>
							<div class="controls"><input type="text" name="nama" id="input-nama" class="input-xlarge" data-rule-required="true" /></div>
						</div>
						<div class="control-group">
							<label for="input-description" class="control-label">Company Description</label>
							<div class="controls"><textarea name="description" id="input-description" class="input-block-level"></textarea></div>
						</div>
						<div class="control-group">
							<label for="input-address" class="control-label">Company Address</label>
							<div class="controls"><textarea name="address" id="input-address" class="input-block-level"></textarea></div>
						</div>
						<div class="control-group">
							<label for="input-industri_id" class="control-label">Industry</label>
							<div class="controls"><select name="industri_id" id="input-industri_id" class='input-xlarge'>
								<?php echo ShowOption(array( 'Array' => $array_industri, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
							</select></div>
						</div>
						<div class="control-group">
							<label for="input-propinsi_id" class="control-label">Location</label>
							<div class="controls"><select name="propinsi_id" id="input-propinsi_id" class='input-xlarge'>
								<?php echo ShowOption(array( 'Array' => $array_propinsi, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
							</select></div>
						</div>
						<div class="control-group">
							<label for="input-kota_id" class="control-label">City</label>
							<div class="controls"><select name="kota_id" id="input-kota_id" class='input-xlarge' data-rule-required="true">
								<option value="">-</option>
							</select></div>
						</div>
						<div class="control-group">
							<label for="input-kodepos" class="control-label">Zip Code</label>
							<div class="controls"><input type="text" name="kodepos" id="input-kodepos" class="input-medium" data-rule-required="true" /></div>
						</div>
						<div class="control-group">
							<label for="input-phone" class="control-label">Phone Number</label>
							<div class="controls"><input type="text" name="phone" id="input-phone" class="input-xlarge" data-rule-required="true" placeholder="+62" /></div>
						</div>
						<div class="control-group">
							<label for="input-faximile" class="control-label">Fax Number</label>
							<div class="controls"><input type="text" name="faximile" id="input-faximile" class="input-xlarge" placeholder="+62" /></div>
						</div>
						<div class="control-group">
							<label for="input-website" class="control-label">Company Website</label>
							<div class="controls"><input type="text" name="website" id="input-website" class="input-xlarge" placeholder="http://" /></div>
						</div>
						<div class="control-group">
							<label for="input-google_map" class="control-label">Google Map URL</label>
							<div class="controls"><input type="text" name="google_map" id="input-google_map" class="input-xxlarge" /></div>
						</div>
					</div>
				</div>
				
				<div class="box box-color box-bordered teal">
					<div class="box-title"><h3><i class="icon-file"></i> Contact Person</h3></div>
					<div class="box-content">
						<div class="control-group">
							<label for="input-sales" class="control-label">Sales</label>
							<div class="controls"><input type="text" name="sales" id="input-sales" class="input-xlarge" /></div>
						</div>
						<div class="control-group">
							<label for="input-contact_name" class="control-label">Contact Name</label>
							<div class="controls"><input type="text" name="contact_name" id="input-contact_name" class="input-xlarge" data-rule-required="true" /></div>
						</div>
						<div class="control-group">
							<label for="input-contact_no" class="control-label">Mobile Number</label>
							<div class="controls"><input type="text" name="contact_no" id="input-contact_no" class="input-xlarge" data-rule-required="true" /></div>
						</div>
						<div class="control-group">
							<label for="input-contact_email" class="control-label">Email</label>
							<div class="controls"><input type="text" name="contact_email" id="input-contact_email" class="input-xlarge" data-rule-required="true" data-rule-email="true" /></div>
						</div>
						<div class="control-group">
							<label for="input-logo" class="control-label">Logo Perusahaan</label>
							<div class="controls">
								<input type="text" name="logo" id="input-logo" class="input-xlarge" readonly="readonly" />
								<button type="button" class="btn btn-success browse-logo" style="width: 125px;">Upload Logo</button>
							</div>
						</div>
						<div class="control-group">
							<label for="input-banner" class="control-label">Banner Perusahaan</label>
							<div class="controls">
								<input type="text" name="banner" id="input-banner" class="input-xlarge" readonly="readonly" />
								<button type="button" class="btn btn-success browse-banner" style="width: 125px;">Upload Banner</button>
							</div>
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
					<button type="submit" class="btn btn-primary">Save changes</button>
					<button type="button" class="btn">Cancel</button>
				</div>
			</form>
		</div>
	</div></div></div></div></div>
</div>
<script>
	company_logo = function(p) {
		$('[name="logo"]').val(p.file_name);
	}
	company_banner = function(p) {
		$('[name="banner"]').val(p.file_name);
	}
	
	var company = Func.get_company();
	$('[name="id"]').val(company.id);
	$('[name="kota_id"]').val(company.kota_id);
	$('[name="industri_id"]').val(company.industri_id);
	$('[name="propinsi_id"]').val(company.propinsi_id);
	$('[name="nama"]').val(company.nama);
	$('[name="phone"]').val(company.phone);
	$('[name="faximile"]').val(company.faximile);
	$('[name="website"]').val(company.website);
	$('[name="address"]').val(company.address);
	$('[name="email"]').val(company.email);
	$('[name="email_check"]').val(company.email);
	$('[name="description"]').val(company.description);
	$('[name="kodepos"]').val(company.kodepos);
	$('[name="sales"]').val(company.sales);
	$('[name="contact_name"]').val(company.contact_name);
	$('[name="contact_email"]').val(company.contact_email);
	$('[name="contact_no"]').val(company.contact_no);
	$('[name="logo"]').val(company.logo);
	$('[name="banner"]').val(company.banner);
	$('[name="google_map"]').val(company.google_map);
	
	// set kota
	combo.kota({ propinsi_id: company.propinsi_id, target: $('[name="kota_id"]'), callback: function() { $('[name="kota_id"]').val(company.kota_id); } });
	
	// form
	$('[name="propinsi_id"]').change(function() {
		combo.kota({ propinsi_id: $('[name="propinsi_id"]').val(), target: $('[name="kota_id"]') })
	});
	$('.browse-logo').click(function() { window.iframe_company_logo.browse() });
	$('.browse-banner').click(function() { window.iframe_company_banner.browse() });
	
	$('#form-company').submit(function() {
		if (! $('#form-company').valid()) {
			return false;
		} else if (! $('[name="declaration"]').is(":checked")) {
			return false;
		}
		
		var param = Site.Form.GetValue('form-company');
		param.action = 'update';
		param.update_session = 1;
		Func.ajax({ url: web.host + 'company/profile/action', param: param, callback: function(result) {
			Func.show_notice({ text: result.message });
		} });
		
		return false;
	});
</script>
</body>
</html>