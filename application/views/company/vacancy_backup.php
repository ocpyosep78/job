<?php
	$seeker = $this->Seeker_model->get_session();
	
	$array_propinsi = $this->Propinsi_model->get_array(array('negara_id' => NEGARA_INDONESIA_ID));
	$array_marital = $this->Marital_model->get_array();
	$array_jenjang = $this->Jenjang_model->get_array();
?>

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
							<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Add Jobs Position', 'class' => 'icon-edit' ) ); ?>
							
							<div class="box-content">
								<form action="#" method="POST" class='form-horizontal'>
									<div class="control-group">
										<label for="penulis" class="control-label">Penulis</label>
										<div class="controls">
											<label for="penulis2" class="control-label">Penulis2</label>
										</div>
									</div>
									<div class="control-group">
										<label for="kategori" class="control-label">Kategori</label>
										<div class="controls">
											<select name="kategori" id="kategori" class='input-large'>
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
										<label for="sub_kategori" class="control-label">Sub Kategori</label>
										<div class="controls">
											<select name="sub_kategori" id="sub_kategori" class='input-large'>
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
										<label for="marital_id" class="control-label">Status</label>
										<div class="controls"><select name="marital_id" id="marital_id" class='input-xlarge'>
											<?php echo ShowOption(array( 'Array' => $array_marital, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
										</select></div>
									</div>
									<div class="control-group">
										<label for="position" class="control-label">Position</label>
										<div class="controls">
											<input type="text" name="position" id="position" class="input-xlarge" data-rule-required="true" />
										</div>
									</div>
									<div class="control-group">
										<label for="url_artikel" class="control-label">URL Artikel</label>
										<div class="controls">
											<input type="text" name="url_artikel" id="url_artikel" class="input-xlarge" data-rule-required="true" />
										</div>
									</div>
									<div class="control-group">
										<label for="link_artikel" class="control-label">Link Artikel</label>
										<div class="controls">
											<input type="text" name="link_artikel" id="link_artikel" class="input-xlarge" data-rule-required="true" /> Exp: Post-34938723423
										</div>
									</div>
									<div class="control-group">
										<label for="short_desc" class="control-label">Short Desc</label>
										<div class="controls">
											
										</div>
									</div>
									<div class="control-group">
										<label for="detail" class="control-label">Detail</label>
										<div class="controls">
											
										</div>
									</div>
									<div class="control-group">
										<label for="opsi_1" class="control-label">Opsi 1</label>
										<div class="controls">
											<input type="text" name="opsi_1" id="opsi_1" class="input-xlarge" data-rule-required="true" />
										</div>
									</div>
									<div class="control-group">
										<label for="opsi_2" class="control-label">Opsi 2</label>
										<div class="controls">
											<input type="text" name="opsi_2" id="opsi_2" class="input-xlarge" data-rule-required="true" />
										</div>
									</div>
									<div class="control-group">
										<label for="lokasi_kerja" class="control-label">Lokasi Kerja</label>
										<div class="controls"><select name="propinsi_id" id="propinsi_id" class='input-xlarge'>
											<?php echo ShowOption(array( 'Array' => $array_propinsi, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
										</select></div>
									</div>
									<div class="control-group">
										<label for="kota" class="control-label">Kota</label>
										<div class="controls">
											<select name="kota" id="kota" class='input-large'>
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
										<label for="jenjang" class="control-label">Pendidikan</label>
										<div class="controls"><select name="jenjang" id="jenjang" class='input-xlarge'>
											<?php echo ShowOption(array( 'Array' => $array_jenjang, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
										</select></div>
									</div>
									<div class="control-group">
										<label for="tipe_pekerjaan" class="control-label">Tipe Pekerjaan</label>
										<div class="controls">
											<select name="tipe_pekerjaan" id="tipe_pekerjaan" class='input-large'>
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
										<label for="pengalaman" class="control-label">Pengalaman</label>
										<div class="controls">
											<select name="pengalaman" id="pengalaman" class='input-large'>
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
										<div class="controls">
											<label class='checkbox'>
												<input type="checkbox" name="penuh_waktu/kontrak"> Penuh waktu/kontrak
											</label>
											<label class='checkbox'>
												<input type="checkbox" name="paruh_waktu/temporer"> Paruh waktu/temporer
											</label>
											<label class='checkbox'>
												<input type="checkbox" name="magang"> Magang
											</label>
										</div>
									</div>
									<div class="control-group">
										<label for="gaji_yang_ditawarkan" class="control-label">Gaji yang ditawarkan</label>
										<div class="controls">
											<input type="text" name="gaji_yang_ditawarkan" id="gaji_yang_ditawarkan" class="input-xlarge" data-rule-required="true" />
										</div>
									</div>
									<div class="control-group">
										<label for="date_publish" class="control-label">Date Publish</label>
										<div class="controls">
											<input type="text" name="date_publish" id="date_publish" class="input-xlarge" data-rule-required="true" />
										</div>
									</div>
									<div class="control-group">
										<label for="closed_date" class="control-label">Closed Date</label>
										<div class="controls">
											<input type="text" name="closed_date" id="closed_date" class="input-xlarge datepick" />
										</div>
									</div>
									
									<div class="box box-color box-bordered teal">
										<div class="box-title">
											<h3><i class="icon-file"></i> Set Email Penerima</h3>
										</div>
										<div class="box-content">
											<div class="control-group">
												<label for="email_apply" class="control-label">Email Apply</label>
												<div class="controls">
													<input type="text" name="email_apply" id="email_apply" class="input-xlarge">
												</div>
											</div>
											<div class="control-group">
												<label for="email_quick_applay" class="control-label">Email Quick Applay</label>
												<div class="controls">
													<input type="text" name="email_quick_applay" id="email_quick_applay" class="input-xlarge">
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