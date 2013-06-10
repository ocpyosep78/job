<?php
	$seeker = $this->Seeker_model->get_session();
?>

<?php $this->load->view( 'panel/common/meta', array('title' => 'Biodata '.$seeker['full_name']) ); ?>
<body data-layout="fixed">
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Resume', 'class' => 'icon-reorder' ) ); ?>
						
		<div class="box-content">
			<div class="hide">
				<div class="cnt-seeker"><?php echo json_encode($seeker); ?></div>
			</div>
			
			<div class="row-fluid margin-top">
				<div class="alert alert-info">Status resume: <strong>Siap melamat lowongan</strong></div>
			</div>
			
			<div class="box box-color box-bordered teal">
				<div class="box-title"><h3><i class="icon-file"></i>Unggah Resume</h3></div>
				<div class="box-content">
					<form action="#" method="POST" class='form-horizontal'>
						<div class="control-group">
							<label for="textfield" class="control-label">Tidak ada resume</label>
							<div class="controls">
								<button class="btn btn-success">Upload Resume</button>
								<span class="help-block error" style="margin: 15px 0 0 0;">
									Catatan : Versi terakhir resume yang Anda unggah dapat di akses oleh semua parusahaan yang Anda lamar<br />
									[<a>info lebih lanjut</a>]
								</span>
							</div>
						</div>
					</form>
				</div>
			</div>
			
			<div class="box box-color box-bordered teal">
				<div class="box-title">
					<h3><i class="icon-file"></i>Detail Kontak Informasi</h3>
					<div class="actions">
						<a href="<?php echo base_url('seeker/resume/edit'); ?>" class="btn btn-mini" rel="tooltip" data-original-title="Edit Resume"><i class="icon-edit"></i></a>
					</div>
				</div>
				<div class="box-content" style="position: relative;">
					<form action="#" method="POST" class='form-horizontal'>
						<div class="control-group">
							<label for="first_name" class="control-label">Nama</label>
							<div class="controls"><input type="text" name="first_name" id="first_name" class="input-xxlarge" readonly="readonly" /></div>
						</div>
						<div class="control-group">
							<label for="email" class="control-label">Email</label>
							<div class="controls"><input type="email" name="email" class="input-xxlarge" readonly="readonly" /></div>
						</div>
						<div class="control-group">
							<label for="phone" class="control-label">Nomor Telepon</label>
							<div class="controls"><input type="text" name="phone" id="phone" class="input-xxlarge" readonly="readonly" /></div>
						</div>
						<div class="control-group">
							<label for="hp" class="control-label">Nomor Ponsel</label>
							<div class="controls"><input type="text" name="hp" id="hp" class="input-xxlarge" readonly="readonly" /></div>
						</div>
						<div class="control-group">
							<label for="address" class="control-label">Alamat</label>
							<div class="controls"><textarea name="address" id="address" readonly="readonly" class="span12"></textarea></div>
						</div>
					</form>
					
					<div style="position: absolute; top: 10px; right: 10px;">
						<div style="width: 125px; text-align: center;">
							<img src="<?php echo base_url('static/theme/flat/img/demo/user-avatar.jpg'); ?>" style="width: 125px; height: 160px;" />
							<div style="padding: 10px 0 0 0;"><button class="btn btn-success">Upload Photo</button></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="box box-color box-bordered teal">
				<div class="box-title">
					<h3><i class="icon-file"></i>Keterangan Pribadi</h3>
					<div class="actions">
						<a href="<?php echo base_url('seeker/resume/edit'); ?>" class="btn btn-mini" rel="tooltip" data-original-title="Edit Resume"><i class="icon-edit"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form action="#" method="POST" class='form-horizontal'>
						<div class="control-group">
							<label for="tgl_lahir" class="control-label">Tanggal Lahir</label>
							<div class="controls"><input type="text" name="tgl_lahir" id="tgl_lahir" class="input-xxlarge" readonly="readonly" /></div>
						</div>
						<div class="control-group">
							<label for="kelamin_id" class="control-label">Jenis Kelamin</label>
							<div class="controls"><input type="text" name="kelamin_id" id="kelamin_id" class="input-xxlarge" readonly="readonly" /></div>
						</div>
						<div class="control-group">
							<label for="kebangsaan" class="control-label">Kebangsaan</label>
							<div class="controls"><input type="text" name="kebangsaan" id="kebangsaan" class="input-xxlarge" readonly="readonly" /></div>
						</div>
						<!--
						<div class="control-group">
							<label for="textfield" class="control-label">Ijin tinggal tetap</label>
							<div class="controls"><input type="text" name="nama" class="input-xxlarge" readonly="readonly" /></div>
						</div>
						-->
					</form>
				</div>
			</div>
			
			<div class="box box-color box-bordered teal">
				<div class="box-title">
					<h3><i class="icon-file"></i>Pendidikan</h3>
					<div class="actions">
						<a class="btn cursor btn-mini" rel="tooltip" data-original-title="Tambah Pendidikan"><i class="icon-edit"></i></a>
					</div>
				</div>
				<div class="box-content">
					Isinya nanti table
				</div>
			</div>
			
			<div class="box box-color box-bordered teal">
				<div class="box-title">
					<h3><i class="icon-file"></i>Keahlian / Ketrampilan</h3>
					<div class="actions">
						<a class="btn cursor btn-mini"><i class="icon-edit"></i></a>
					</div>
				</div>
				<div class="box-content">
					Isinya nanti table
				</div>
			</div>
			
			<div class="box box-color box-bordered teal">
				<div class="box-title">
					<h3><i class="icon-file"></i>Bahasa</h3>
					<div class="actions">
						<a class="btn cursor btn-mini"><i class="icon-edit"></i></a>
					</div>
				</div>
				<div class="box-content">
					Isinya nanti table
				</div>
			</div>
			
			<div class="box box-color box-bordered teal">
				<div class="box-title">
					<h3><i class="icon-file"></i>Pengalaman Kerja</h3>
					<div class="actions">
						<a class="btn cursor btn-mini"><i class="icon-edit"></i></a>
					</div>
				</div>
				<div class="box-content">
					Isinya nanti table
				</div>
			</div>
			
			<div class="box box-color box-bordered teal">
				<div class="box-title">
					<h3><i class="icon-file"></i>Info Tambahan</h3>
					<div class="actions">
						<a class="btn cursor btn-mini"><i class="icon-edit"></i></a>
					</div>
				</div>
				<div class="box-content">
					?????????????????
				</div>
			</div>
			
			<div class="box box-color box-bordered teal">
				<div class="box-title">
					<h3><i class="icon-file"></i>Referensi</h3>
					<div class="actions">
						<a class="btn cursor btn-mini"><i class="icon-edit"></i></a>
					</div>
				</div>
				<div class="box-content">
					?????????????????
				</div>
			</div>
			
			<div class="box box-color box-bordered teal">
				<div class="box-title">
					<h3><i class="icon-file"></i>Rangkuman Profile</h3>
					<div class="actions">
						<a class="btn cursor btn-mini"><i class="icon-edit"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form action="#" method="POST" class='form-horizontal form-textlong'>
						<div class="control-group">
							<label for="textfield" class="control-label">IPK / Nilai Terakhir</label>
							<div class="controls"><input type="text" name="nama" class="input-xxlarge" readonly="readonly" /></div>
						</div>
						<div class="control-group">
							<label for="textfield" class="control-label">Pendidikan Terakhir</label>
							<div class="controls"><input type="text" name="nama" class="input-xxlarge" readonly="readonly" /></div>
						</div>
						<div class="control-group">
							<label for="textfield" class="control-label">Tempat Pendidikan Terakhir</label>
							<div class="controls"><input type="text" name="nama" class="input-xxlarge" readonly="readonly" /></div>
						</div>
						<div class="control-group">
							<label for="textfield" class="control-label">Pengalaman dan Tempat Kerja Terakhir</label>
							<div class="controls"><input type="text" name="nama" class="input-xxlarge" readonly="readonly" /></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div></div></div></div></div>
</div>

<script>
	var seeker = Func.get_seeker();
	$('[name="id"]').val(seeker.id);
	$('[name="first_name"]').val(seeker.first_name);
	//$('[name="last_name"]').val(seeker.last_name);
	//$('[name="email"]').val(seeker.email);
	$('[name="phone"]').val(seeker.phone);
	$('[name="hp"]').val(seeker.hp);
	$('[name="address"]').val(seeker.address);
	$('[name="tgl_lahir"]').val(Func.SwapDate(seeker.tgl_lahir));
	$('[name="kelamin_id"]').val(seeker.kelamin_id);
	$('[name="kebangsaan"]').val(seeker.kebangsaan);
</script>
</body>
</html>