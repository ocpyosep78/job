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
							<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Setting', 'class' => 'icon-edit' ) ); ?>
							
							<div class="box-content">
								<form action="#" method="POST" class='form-horizontal'>
									<div class="control-group">
										<label class="control-label">Show my profile to public</label>
										<div class="controls">
											<label class='radio'>
												<input type="radio" name="show_my_profile_to_public"> Yes
											</label>
											<label class='radio'>
												<input type="radio" name="show_my_profile_to_public"> No
											</label>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Berhenti berlangganan Subscribe jobs</label>
										<div class="controls">
											<label class='radio'>
												<input type="radio" name="berhenti_berlangganan_subscribe_jobs"> Yes
											</label>
											<label class='radio'>
												<input type="radio" name="berhenti_berlangganan_subscribe_jobs"> No
											</label>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Sekarang saya telah bekerja</label>
										<div class="controls">
											<label class='radio'>
												<input type="radio" name="sekarang_saya_telah_bekerja"> Yes
											</label>
											<label class='radio'>
												<input type="radio" name="sekarang_saya_telah_bekerja"> No
											</label>
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