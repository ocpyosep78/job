<?php $this->load->view( 'panel/common/meta' ); ?>
<body data-layout="fixed">
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main">
		<div class="container-fluid">
			<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Kirim Lamaran', 'class' => 'icon-edit' ) ); ?>
							
							<div class="box-content">
								<form action="#" method="POST" class='form-horizontal'>
									<div class="control-group">
										<label for="to" class="control-label">To</label>
										<div class="controls">
											<input type="text" name="to" id="to" class="input-xxlarge">
										</div>
									</div>
									<div class="control-group">
										<label for="title/subject" class="control-label">Title / Subject</label>
										<div class="controls">
											<input type="text" name="title/subject" id="title/subject" class="input-xxlarge">
										</div>
									</div>
									<div class="control-group">
										<label for="nama_perusahaan" class="control-label">Nama Perusahaan</label>
										<div class="controls">
											<input type="text" name="nama_perusahaan" id="nama_perusahaan" class="input-xxlarge">
										</div>
									</div>
									<div class="control-group">
										<label for="nama_perusahaan" class="control-label">Cover Letter</label>
										<div class="controls">
											<textarea name="content" id="input-content1" class="tinymce span9" style="height: 350px; width: 700px;"></textarea>
										</div>
									</div>
									<div class="control-group" style="margin-bottom: 0px;">
										<div class="controls">
											<label for="nama_perusahaan" class="control-label" style="width: 700px;">Yang kan di kirim : (attachment)</label>
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<label class='checkbox'>
												<input type="checkbox" name="resume"> Resume
											</label>
											<label class='checkbox'>
												<input type="checkbox" name="foto_saya"> Foto Saya
											</label>
											<label class='checkbox'>
												<input type="checkbox" name="pilih_surat_lamaran">
													<select name="select" id="select" class='input-large'>
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
											</label>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Submit</button>
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