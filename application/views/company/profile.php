<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main">
		<div class="container-fluid">
			<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Profile', 'class' => 'icon-edit' ) ); ?>
							
							<div class="box-content">
								<form action="#" method="POST" class='form-horizontal'>
									<div class="box box-color box-bordered teal">
										<div class="box-title">
											<h3><i class="icon-file"></i> Company Login Details</h3>
										</div>
										<div class="box-content">
											<div class="control-group">
												<label for="email_address" class="control-label">Email Address</label>
												<div class="controls">
													<input type="text" name="email_address" id="email_address" class="input-xlarge">
												</div>
											</div>
											<div class="control-group">
												<label for="retype_email_address" class="control-label">Retype Email Address</label>
												<div class="controls">
													<input type="text" name="retype_email_address" id="retype_email_address" class="input-xlarge">
												</div>
											</div>
											<div class="control-group">
												<label for="password" class="control-label">Password</label>
												<div class="controls">
													<input type="password" name="password" id="password" placeholder="*********" class="input-xlarge">
												</div>
											</div>
											<div class="control-group">
												<label for="retype_your_password" class="control-label">Retype your Password</label>
												<div class="controls">
													<input type="password" name="retype_your_password" id="retype_your_password" placeholder="*********" class="input-xlarge">
												</div>
											</div>
										</div>
									</div>
									<div class="box box-color box-bordered teal">
										<div class="box-title">
											<h3><i class="icon-file"></i> Company Information</h3>
										</div>
										<div class="box-content">
											<div class="control-group">
												<label for="company_name" class="control-label">Company Name</label>
												<div class="controls">
													<input type="text" name="company_name" id="company_name" class="input-xlarge">
												</div>
											</div>
											<div class="control-group">
												<label for="company_description" class="control-label">Company Description</label>
												<div class="controls">
													<textarea name="company_description" id="company_description" class="input-block-level"></textarea>
												</div>
											</div>
											<div class="control-group">
												<label for="company_address" class="control-label">Company Address</label>
												<div class="controls">
													<textarea name="company_address" id="company_address" class="input-block-level"></textarea>
												</div>
											</div>
											<div class="control-group">
												<label for="industry" class="control-label">Industry</label>
												<div class="controls">
													<select name="industry" id="industry" class='input-large'>
														<option value="1">Option-1</option>
														<option value="2">Option-2</option>
														<option value="3">Option-3</option>
														<option value="4">Option-4</option>
														<option value="5">Option-5</option>
														<option value="6">Option-6</option>
														<option value="7">Option-7</option>
														<option value="8">Option-8</option>
														<option value="9">Option-9</option>
													</select>
												</div>
											</div>
											<div class="control-group">
												<label for="location" class="control-label">Location</label>
												<div class="controls">
													<select name="location" id="location" class='input-large'>
														<option value="1">Option-1</option>
														<option value="2">Option-2</option>
														<option value="3">Option-3</option>
														<option value="4">Option-4</option>
														<option value="5">Option-5</option>
														<option value="6">Option-6</option>
														<option value="7">Option-7</option>
														<option value="8">Option-8</option>
														<option value="9">Option-9</option>
													</select>
												</div>
											</div>
											<div class="control-group">
												<label for="city" class="control-label">City</label>
												<div class="controls">
													<select name="city" id="city" class='input-large'>
														<option value="1">Option-1</option>
														<option value="2">Option-2</option>
														<option value="3">Option-3</option>
														<option value="4">Option-4</option>
														<option value="5">Option-5</option>
														<option value="6">Option-6</option>
														<option value="7">Option-7</option>
														<option value="8">Option-8</option>
														<option value="9">Option-9</option>
													</select>
												</div>
											</div>
											<div class="control-group">
												<label for="zip_code" class="control-label">Zip Code</label>
												<div class="controls">
													<input type="text" name="zip_code" id="zip_code" class="input-xlarge">
												</div>
											</div>
											<div class="control-group">
												<label for="phone_number" class="control-label">Phone Number</label>
												<div class="controls">
													<input type="text" name="phone_number" id="phone_number" class="input-xlarge" value="+62">
												</div>
											</div>
											<div class="control-group">
												<label for="fax_number" class="control-label">Fax Number</label>
												<div class="controls">
													<input type="text" name="fax_number" id="fax_number" class="input-xlarge" value="+62">
												</div>
											</div>
											<div class="control-group">
												<label for="company_website" class="control-label">Company Website</label>
												<div class="controls">
													<input type="text" name="company_website" id="company_website" class="input-xlarge" value="http://">
												</div>
											</div>
										</div>
									</div>
									<div class="box box-color box-bordered teal">
										<div class="box-title">
											<h3><i class="icon-file"></i> Contact Person</h3>
										</div>
										<div class="box-content">
											<div class="control-group">
												<label for="contact_name" class="control-label">Contact Name</label>
												<div class="controls">
													<input type="text" name="contact_name" id="contact_name" class="input-xlarge">
												</div>
											</div>
											<div class="control-group">
												<label for="mobile_number" class="control-label">Mobile Number</label>
												<div class="controls">
													<input type="text" name="mobile_number" id="mobile_number" class="input-xlarge">
												</div>
											</div>
											<div class="control-group">
												<label for="email" class="control-label">Email</label>
												<div class="controls">
													<input type="text" name="email" id="email" class="input-xlarge">
												</div>
											</div>
											<div class="control-group">
												<label for="logo_perusahaan" class="control-label">Logo Perusahaan</label>
												<div class="controls">
													<input type="file" name="logo_perusahaan" id="logo_perusahaan" class="input-block-level">
												</div>
											</div>
											<div class="control-group">
												<label for="banner_perusahaan" class="control-label">Banner Perusahaan</label>
												<div class="controls">
													<input type="file" name="banner_perusahaan" id="banner_perusahaan" class="input-block-level">
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Save changes</button>
										<button type="button" class="btn">Cancel</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
		</div>
	</div></div>
</body>
</html>