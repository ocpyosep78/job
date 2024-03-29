<?php
	$seeker = $this->Seeker_model->get_session();
	
	$news_seeker = $this->News_model->get_seeker();
	$seeker_resume = $this->Seeker_model->get_resume(array( 'id' => $seeker['id'] ));
	$seeker_summary = $this->Seeker_Summary_model->get_by_id(array( 'seeker_id' => $seeker['id'] ));
	$array_jenjang = $this->Jenjang_model->get_array();
	$array_bahasa = array( array( 'id' => 'Good', 'nama' => 'Good' ), array( 'id' => 'Moderate', 'nama' => 'Moderate' ), array( 'id' => 'Poor', 'nama' => 'Poor' ) );
?>

<?php $this->load->view( 'panel/common/meta', array('title' => 'Biodata '.$seeker['full_name']) ); ?>
<body data-layout="fixed">
<?php $this->load->view( 'panel/common/navigation' ); ?>

<style>
.table-bordered { border: 1px solid #DDDDDD; }
.box.box-bordered .table { border: 1px solid #DDDDDD; }
.box.box-bordered .table.table-bordered { border: 1px solid #DDDDDD; }
</style>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Resume', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="hide">
				<div class="cnt-seeker"><?php echo json_encode($seeker); ?></div>
				<div class="cnt-seeker_summary"><?php echo json_encode($seeker_summary); ?></div>
				<iframe name="iframe_seeker_resume" src="<?php echo base_url('panel/upload?callback=seeker_resume&filetype=document'); ?>"></iframe>
				<iframe name="iframe_seeker_photo" src="<?php echo base_url('panel/upload?callback=seeker_photo'); ?>"></iframe>
			</div>
			
			<div id="modal-ahli" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>Form Keahlian / Ketrampilan</h3>
				</div>
				<form class='form-horizontal form-validate' id="form-ahli">
					<input type="hidden" name="id" value="0" />
					<input type="hidden" name="seeker_id" value="0" />
					<input type="submit" class="btn-hidden" hidefocus="true" />
					
					<div class="modal-body">
						<div class="control-group">
							<label for="input-content" class="control-label">Nama Keahlian</label>
							<div class="controls"><input type="text" name="content" id="input-content" class="input-xlarge" data-rule-required="true" /></div>
						</div>
					</div>
				</form>
				<div class="modal-footer">
					<button class="btn modal-close" data-dismiss="modal" aria-hidden="true">Close</button>
					<button class="btn modal-submit btn-primary">Save changes</button>
				</div>
			</div>
			
			<div id="modal-education" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>Form Pendidikan</h3>
				</div>
				<form class='form-horizontal form-validate' id="form-education">
					<input type="hidden" name="id" value="0" />
					<input type="hidden" name="seeker_id" value="0" />
					<input type="submit" class="btn-hidden" hidefocus="true" />
					
					<div class="modal-body">
						<div class="control-group">
							<label for="input-jenjang_id" class="control-label">Jenjang</label>
							<div class="controls"><select name="jenjang_id" id="input-jenjang_id" class='input-xlarge'>
								<?php echo ShowOption(array( 'Array' => $array_jenjang, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
							</select></div>
						</div>
						<div class="control-group">
							<label for="input-nama_sekolah" class="control-label">Nama Sekolah</label>
							<div class="controls"><input type="text" name="nama_sekolah" id="input-nama_sekolah" class="input-xlarge" data-rule-required="true" /></div>
						</div>
						<div class="control-group">
							<label for="input-score" class="control-label">Nilai</label>
							<div class="controls"><input type="text" name="score" id="input-score" class="input-xlarge" /></div>
						</div>
						<div class="control-group">
							<label for="input-jurusan" class="control-label">Jurusan</label>
							<div class="controls"><input type="text" name="jurusan" id="input-jurusan" class="input-xlarge" /></div>
						</div>
						<div class="control-group">
							<label for="input-bidang_studi" class="control-label">Bidang Studi</label>
							<div class="controls"><input type="text" name="bidang_studi" id="input-bidang_studi" class="input-xlarge" /></div>
						</div>
						<div class="control-group">
							<label for="input-tgl_lulus" class="control-label">Tanggal Lulus</label>
							<div class="controls"><input type="text" name="tgl_lulus" id="input-tgl_lulus" class="input-medium datepick" /></div>
						</div>
					</div>
				</form>
				<div class="modal-footer">
					<button class="btn modal-close" data-dismiss="modal" aria-hidden="true">Close</button>
					<button class="btn modal-submit btn-primary">Save changes</button>
				</div>
			</div>
			
			<div id="modal-exp" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>Form Pengalaman</h3>
				</div>
				<form class='form-horizontal form-validate' id="form-exp">
					<input type="hidden" name="id" value="0" />
					<input type="hidden" name="seeker_id" value="0" />
					<input type="submit" class="btn-hidden" hidefocus="true" />
					
					<div class="modal-body">
						<div class="control-group">
							<label for="input-nama" class="control-label" style="width: 175px;">Tingkat Pengalaman</label>
							<div class="controls" style="margin-left: 175px;">
								<label class="radio"><input type="radio" name="exp_level" value="1" /> Saya baru lulus dan sedang mencari pekerjaan pertama saya</label>
								<label class="radio"><input type="radio" name="exp_level" value="2" /> Saya adalah seorang mahasiswa yang mencari pekerjaan magang atau paruh waktu</label>
								<label class="radio"><input type="radio" name="exp_level" value="3" /> Riwayat pengalaman kerja saya</label>
							</div>
						</div>
						<div class="control-group">
							<label for="input-content_3" class="control-label">Tugas Kerja</label>
							<div class="controls" style="margin-left: 175px;"><textarea name="content" id="input-content_3" class="tinymce"></textarea></div>
						</div>
					</div>
				</form>
				<div class="modal-footer">
					<button class="btn modal-close" data-dismiss="modal" aria-hidden="true">Close</button>
					<button class="btn modal-submit btn-primary">Save changes</button>
				</div>
			</div>
			
			<div id="modal-language" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>Form Bahasa</h3>
				</div>
				<form class='form-horizontal form-validate' id="form-language">
					<input type="hidden" name="id" value="0" />
					<input type="hidden" name="seeker_id" value="0" />
					<input type="submit" class="btn-hidden" hidefocus="true" />
					
					<div class="modal-body">
						<div class="control-group">
							<label for="input-nama" class="control-label">Nama</label>
							<div class="controls"><input type="text" name="nama" id="input-nama" class="input-xlarge" data-rule-required="true" /></div>
						</div>
						<div class="control-group">
							<label for="input-lisan" class="control-label">Lisan</label>
							<div class="controls"><select name="lisan" id="input-lisan" class='input-xlarge'>
								<?php echo ShowOption(array( 'Array' => $array_bahasa, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
							</select></div>
						</div>
						<div class="control-group">
							<label for="input-lisan" class="control-label">Tulis</label>
							<div class="controls"><select name="tulis" id="input-tulis" class='input-xlarge'>
								<?php echo ShowOption(array( 'Array' => $array_bahasa, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
							</select></div>
						</div>
					</div>
				</form>
				<div class="modal-footer">
					<button class="btn modal-close" data-dismiss="modal" aria-hidden="true">Close</button>
					<button class="btn modal-submit btn-primary">Save changes</button>
				</div>
			</div>
			
			<div id="modal-addon" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>Form Info Tambahan</h3>
				</div>
				<form class='form-horizontal' id="form-addon">
					<input type="hidden" name="seeker_id" value="0" />
					<input type="submit" class="btn-hidden" hidefocus="true" />
					
					<div class="modal-body">
						<div class="control-group">
							<label for="input-nama" class="control-label" style="width: 175px;">Memiliki kendaraan roda 2</label>
							<div class="controls" style="margin-left: 175px;">
								<label class="radio"><input type="radio" name="kendaraan" value="1" checked="checked"> Ya</label>
								<label class="radio"><input type="radio" name="kendaraan" value="0"> Tidak</label>
							</div>
						</div>
						<div class="control-group" style="width: 175px;">
							<label for="input-content_2" class="control-label">Informasi Tambahan</label>
							<div class="controls" style="margin-left: 175px;"><textarea name="content" id="input-content_2" class="tinymce" style="height: 300px"></textarea></div>
						</div>
					</div>
				</form>
				<div class="modal-footer">
					<button class="btn modal-close" data-dismiss="modal" aria-hidden="true">Close</button>
					<button class="btn modal-submit btn-primary">Save changes</button>
				</div>
			</div>
			
			<div id="modal-reference" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>Form Referensi</h3>
				</div>
				<form class='form-horizontal form-validate' id="form-reference">
					<input type="hidden" name="id" value="0" />
					<input type="hidden" name="seeker_id" value="0" />
					<input type="submit" class="btn-hidden" hidefocus="true" />
					
					<div class="modal-body">
						<div class="control-group">
							<label for="input-nama" class="control-label">Nama</label>
							<div class="controls"><input type="text" name="nama" id="input-nama" class="input-xlarge" data-rule-required="true" /></div>
						</div>
						<div class="control-group">
							<label for="input-content_1" class="control-label">Content</label>
							<div class="controls"><textarea name="content" id="input-content_1" class="span9"></textarea></div>
						</div>
					</div>
				</form>
				<div class="modal-footer">
					<button class="btn modal-close" data-dismiss="modal" aria-hidden="true">Close</button>
					<button class="btn modal-submit btn-primary">Save changes</button>
				</div>
			</div>
			
			<div id="modal-summary" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>Form Rangkuman Profile</h3>
				</div>
				<form class='form-horizontal form-validate' id="form-summary">
					<input type="hidden" name="id" value="0" />
					<input type="hidden" name="seeker_id" value="0" />
					<input type="submit" class="btn-hidden" hidefocus="true" />
					<div class="modal-body">
						<div class="control-group">
							<label for="input-score" class="control-label">Nilai / IPK Terakhir</label>
							<div class="controls"><input type="text" name="score" id="input-score" class="input-xlarge" data-rule-required="true" maxlength="5" /></div>
						</div>
						<div class="control-group">
							<label for="input-jenjang_id" class="control-label">Pendidikan Terakhir</label>
							<div class="controls"><select name="jenjang_id" id="input-jenjang_id" class='input-xlarge'>
								<?php echo ShowOption(array( 'Array' => $array_jenjang, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
							</select></div>
						</div>
						<div class="control-group">
							<label for="input-school" class="control-label">Tempat Pendidikan</label>
							<div class="controls"><input type="text" name="school" id="input-school" class="input-xlarge" data-rule-required="true" maxlength="60" /></div>
						</div>
						<div class="control-group">
							<label for="input-experience" class="control-label">Tempat Kerja</label>
							<div class="controls"><input type="text" name="experience" id="input-experience" class="input-xlarge" data-rule-required="true" maxlength="60" /></div>
						</div>
					</div>
				</form>
				<div class="modal-footer">
					<button class="btn modal-close" data-dismiss="modal" aria-hidden="true">Close</button>
					<button class="btn modal-submit btn-primary">Save changes</button>
				</div>
			</div>
			
			<div class="row-fluid">
				<?php if (!empty($news_seeker)) { ?>
				<div class="alert alert-success">
					<strong>News</strong> : <?php echo $news_seeker; ?>
				</div>
				<?php } ?>
				
				<div class="alert alert-info">
					<div style="padding: 0 0 10px 0;">Status resume : <strong><?php echo $seeker_resume['message']; ?></strong></div>
					<?php if ($seeker_resume['is_pass']) { ?>
						<div>Link Resume Online Anda : <a href="<?php echo $seeker['seeker_no_link']; ?>"><?php echo $seeker['seeker_no_link']; ?></a></div>
					<?php } ?>
				</div>
			</div>
			
			<div class="box box-color box-bordered teal">
				<div class="box-title"><h3><i class="icon-file"></i>Unggah Resume</h3></div>
				<div class="box-content">
					<form class='form-horizontal' id="form-resume">
						<input type="hidden" name="file_resume" />
						<input type="hidden" name="file_resume_link" />
						
						<div class="control-group">
							<label for="textfield" class="control-label wo-resume">Tidak ada resume</label>
							<label for="textfield" class="control-label wi-resume hide">
								<a href="#" target="_blank"><img src="<?php echo base_url('static/img/document.png'); ?>" /></a>
							</label>
							
							<div class="controls">
								<div class="actions default">
									<button type="button" class="btn btn-success btn-upload">Upload Resume</button> Hanya file dengan format doc, docx atau pdf yang dapat diupload.
								</div>
								<div class="actions confirm hide">
									<button type="button" class="btn btn-save btn-primary">Save</button>
									<button type="button" class="btn btn-cancel">Batal</button>
								</div>
								
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
							<label for="input-full_name" class="control-label">Nama</label>
							<div class="controls"><input type="text" name="full_name" id="input-full_name" class="input-xlarge" readonly="readonly" /></div>
						</div>
						<div class="control-group">
							<label for="email" class="control-label">Email</label>
							<div class="controls"><input type="email" name="email" class="input-xlarge" readonly="readonly" /></div>
						</div>
						<div class="control-group">
							<label for="phone" class="control-label">Nomor Telepon</label>
							<div class="controls"><input type="text" name="phone" id="phone" class="input-xlarge" readonly="readonly" /></div>
						</div>
						<div class="control-group">
							<label for="hp" class="control-label">Nomor Ponsel</label>
							<div class="controls"><input type="text" name="hp" id="hp" class="input-xlarge" readonly="readonly" /></div>
						</div>
						<div class="control-group">
							<label for="address" class="control-label">Alamat</label>
							<div class="controls"><textarea name="address" id="address" readonly="readonly" class="span9"></textarea></div>
						</div>
					</form>
					
					<div style="position: absolute; top: 10px; right: 10px;"><form id="form-photo">
						<input type="hidden" name="photo" />
						<input type="hidden" name="photo_backup" />
						
						<div style="width: 125px; text-align: center;">
							<img class="seeker_photo" src="<?php echo base_url('static/theme/flat/img/demo/user-avatar.jpg'); ?>" style="width: 125px; height: 160px;" />
							<div style="padding: 10px 0 0 0;">
								<div class="actions default"><button type="button" class="btn btn-success btn-upload">Upload Photo</button></div>
								<div class="actions confirm hide">
									<button type="button" class="btn btn-primary btn-save">Save</button>
									<button type="button" class="btn btn-cancel">Batal</button>
								</div>
							</div>
						</div>
					</form></div>
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
							<label for="input-kelamin_nama" class="control-label">Jenis Kelamin</label>
							<div class="controls"><input type="text" name="kelamin_nama" id="input-kelamin_nama" class="input-xxlarge" readonly="readonly" /></div>
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
						<a class="btn cursor btn-mini btn-modal-education" rel="tooltip" data-original-title="Tambah Pendidikan"><i class="icon-edit"></i></a>
					</div>
				</div>
				<div class="box-content">
					<table id="cnt-grid-education" class="table table-striped table-bordered">
						<thead><tr>
							<th>ID</th>
							<th>Jenjang</th>
							<th>Nama Sekolah</th>
							<th style="width: 75px;">&nbsp;</th>
						</tr></thead>
						<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
					</table>
				</div>
			</div>
			
			<div class="box box-color box-bordered teal">
				<div class="box-title">
					<h3><i class="icon-file"></i>Keahlian / Ketrampilan</h3>
					<div class="actions">
						<a class="btn cursor btn-mini btn-modal-ahli" rel="tooltip" data-original-title="Tambah Keahlian / Ketrampilan"><i class="icon-edit"></i></a>
					</div>
				</div>
				<div class="box-content">
					<table id="cnt-grid-ahli" class="table table-striped table-bordered">
						<thead><tr>
							<th>ID</th>
							<th>Nama Surat</th>
							<th style="width: 75px;">&nbsp;</th>
						</tr></thead>
						<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
					</table>
				</div>
			</div>
			
			<div class="box box-color box-bordered teal">
				<div class="box-title">
					<h3><i class="icon-file"></i>Bahasa</h3>
					<div class="actions">
						<a class="btn cursor btn-mini btn-modal-language" rel="tooltip" data-original-title="Tambah Bahasa"><i class="icon-edit"></i></a>
					</div>
				</div>
				<div class="box-content">
					<table id="cnt-grid-language" class="table table-striped table-bordered">
						<thead><tr>
							<th>ID</th>
							<th>Nama</th>
							<th>Lisan</th>
							<th>Tulis</th>
							<th style="width: 75px;">&nbsp;</th>
						</tr></thead>
						<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
					</table>
				</div>
			</div>
			
			<div class="box box-color box-bordered teal">
				<div class="box-title">
					<h3><i class="icon-file"></i>Pengalaman Kerja</h3>
					<div class="actions">
						<a class="btn cursor btn-mini btn-modal-exp" rel="tooltip" data-original-title="Tambah Pengalaman Kerja"><i class="icon-edit"></i></a>
					</div>
				</div>
				<div class="box-content" id="cnt-exp">&nbsp;</div>
			</div>
			
			<div class="box box-color box-bordered teal">
				<div class="box-title">
					<h3><i class="icon-file"></i>Info Tambahan</h3>
					<div class="actions">
						<a class="btn cursor btn-mini btn-modal-addon" rel="tooltip" data-original-title="Edit Info Tambahan"><i class="icon-edit"></i></a>
					</div>
				</div>
				<div class="box-content" id="cnt-addon">&nbsp;</div>
			</div>
			
			<div class="box box-color box-bordered teal">
				<div class="box-title">
					<h3><i class="icon-file"></i>Referensi</h3>
					<div class="actions">
						<a class="btn cursor btn-mini btn-modal-reference" rel="tooltip" data-original-title="Tambah Referensi"><i class="icon-edit"></i></a>
					</div>
				</div>
				<div class="box-content">
					<table id="cnt-grid-reference" class="table table-striped table-bordered">
						<thead><tr>
							<th>ID</th>
							<th>Nama</th>
							<th style="width: 75px;">&nbsp;</th>
						</tr></thead>
						<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
					</table>
				</div>
			</div>
			
			<div class="box box-color box-bordered teal">
				<div class="box-title">
					<h3><i class="icon-file"></i>Rangkuman Profile</h3>
					<div class="actions">
						<a class="btn cursor btn-mini btn-modal-summary" rel="tooltip" data-original-title="Edit Rangkuman Profile"><i class="icon-edit"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class='form-horizontal form-textlong' id="form-summary">
						<div class="control-group">
							<label for="textfield" class="control-label">IPK / Nilai Terakhir</label>
							<div class="controls"><input type="text" name="score" class="input-xxlarge" readonly="readonly" /></div>
						</div>
						<div class="control-group">
							<label for="textfield" class="control-label">Pendidikan Terakhir</label>
							<div class="controls"><input type="text" name="jenjang_nama" class="input-xxlarge" readonly="readonly" /></div>
						</div>
						<div class="control-group">
							<label for="textfield" class="control-label">Tempat Pendidikan Terakhir</label>
							<div class="controls"><input type="text" name="school" class="input-xxlarge" readonly="readonly" /></div>
						</div>
						<div class="control-group">
							<label for="textfield" class="control-label">Pengalaman dan Tempat Kerja Terakhir</label>
							<div class="controls"><input type="text" name="experience" class="input-xxlarge" readonly="readonly" /></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div></div></div></div></div>
</div>
<script>
$( document ).ready(function() {
	seeker_photo = function(p) {
		var photo_backup = $('#form-photo .seeker_photo').attr('src');
		$('#form-photo [name="photo_backup"]').val(photo_backup);
		
		$('#form-photo [name="photo"]').val(p.file_name);
		$('#form-photo .seeker_photo').attr('src', p.file_link);
		$('#form-photo .default').hide();
		$('#form-photo .confirm').show();
	}
	seeker_resume = function(p) {
		if (p.message.length > 0) {
			Func.show_notice({ text: p.message });
		} else {
			$('#form-resume [name="file_resume"]').val(p.file_name);
			$('#form-resume [name="file_resume_link"]').val(p.file_link);
			$('#form-resume .default').hide();
			$('#form-resume .confirm').show();
		}
	}
	
	var seeker = Func.get_seeker();
	var page = {
		init: function() {
			$('[name="id"]').val(seeker.id);
			$('[name="full_name"]').val(seeker.full_name);
			$('[name="email"]').val(seeker.email);
			$('[name="phone"]').val(seeker.phone);
			$('[name="hp"]').val(seeker.hp);
			$('[name="address"]').val(seeker.address);
			$('[name="tgl_lahir"]').val(Func.SwapDate(seeker.tgl_lahir));
			$('[name="kelamin_nama"]').val(seeker.kelamin_nama);
			$('[name="kebangsaan"]').val(seeker.kebangsaan);
			$('#form-photo .seeker_photo').attr('src', seeker.photo_link);
			$('#form-resume .wi-resume a').attr('href', seeker.file_resume_link);
			
			if (seeker.file_resume_link.length > 0) {
				$('#form-resume .wo-resume').hide();
				$('#form-resume .wi-resume').show();
			}
			
			var raw_summary = $('.cnt-seeker_summary').text();
			eval('var summary = ' + raw_summary);
			$('#form-summary [name="jenjang_nama"]').val(summary.jenjang_nama);
			$('#form-summary [name="score"]').val(summary.score);
			$('#form-summary [name="school"]').val(summary.school);
			$('#form-summary [name="experience"]').val(summary.experience);
			
			// form resume
			$('#form-resume .btn-upload').click(function() { window.iframe_seeker_resume.browse() });
			$('#form-resume .btn-save').click(function() {
				var param = Site.Form.GetValue('form-resume');
				param.id = seeker.id;
				param.action = 'update';
				param.update_session = 1;
				Func.ajax({ url: web.host + 'seeker/resume/action', param: param, callback: function(result) {
					Func.show_notice({ text: result.message });
					if (result.status == 1) {
						$('#form-resume .default').show();
						$('#form-resume .confirm').hide();
						
						$('#form-resume .wo-resume').hide();
						$('#form-resume .wi-resume').show();
						$('#form-resume .wi-resume a').attr('href', $('#form-resume [name="file_resume_link"]').val());
					}
				} });
			});
			$('#form-resume .btn-cancel').click(function() {
				$('#form-resume .default').show();
				$('#form-resume .confirm').hide();
			});
			
			// form photo
			$('#form-photo .btn-upload').click(function() { window.iframe_seeker_photo.browse() });
			$('#form-photo .btn-save').click(function() {
				var param = Site.Form.GetValue('form-photo');
				param.id = seeker.id;
				param.action = 'update';
				param.update_session = 1;
				Func.ajax({ url: web.host + 'seeker/resume/action', param: param, callback: function(result) {
					Func.show_notice({ text: result.message });
					if (result.status == 1) {
						$('#form-photo .default').show();
						$('#form-photo .confirm').hide();
					}
				} });
			});
			$('#form-photo .btn-cancel').click(function() {
				var photo_backup = $('#form-photo [name="photo_backup"]').val();
				if (photo_backup.length > 0) {
					$('#form-photo .seeker_photo').attr('src', photo_backup);
				}
				
				$('#form-photo .default').show();
				$('#form-photo .confirm').hide();
			});
			
			// feature
			page.ahli();
			page.education();
			page.exp();
			page.language();
			page.addon();
			page.reference();
			page.summary();
		},
		ahli: function() {
			var ahli_dt = null;
			var ahli_param = {
				id: 'cnt-grid-ahli', aaSorting: [[0, 'desc']],
				source: web.host + 'seeker/resume/grid',
				column: [ { "bSearchable": false, "bVisible": false }, { }, { bSortable: false, sClass: "center" } ],
				fnServerParams: function ( aoData ) {
					aoData.push( { "name": "grid_name", "value": "seeker_expert" }, { "name": "seeker_id", "value": seeker.id } );
				},
				callback: function() {
					$('#cnt-grid-ahli .edit').click(function() {
						var raw_record = $(this).siblings('.hide').text();
						eval('var record = ' + raw_record);
						
						$('#modal-ahli [name="id"]').val(record.id);
						$('#modal-ahli [name="seeker_id"]').val(seeker.id);
						$('#modal-ahli [name="content"]').val(record.content);
						$('#modal-ahli').modal();
					});
					
					$('#cnt-grid-ahli .delete').click(function() {
						var raw_record = $(this).siblings('.hide').text();
						eval('var record = ' + raw_record);
						
						Func.confirm_delete({
							data: { action: 'delete_seeker_expert', id: record.id },
							url: web.host + 'seeker/resume/action', callback: function() { ahli_dt.reload(); }
						});
					});
				}
			}
			ahli_dt = Func.init_datatable(ahli_param);
			$('.btn-modal-ahli').click(function() {
				$('#modal-ahli form')[0].reset()
				$('#modal-ahli [name="id"]').val(0);
				$('#modal-ahli [name="seeker_id"]').val(seeker.id);
				$('#modal-ahli').modal();
			});
			$('#modal-ahli .modal-footer .modal-close').click(function() { $('#modal-ahli').modal('hide'); });
			$('#modal-ahli .modal-footer .modal-submit').click(function() { $('#modal-ahli').find('form').submit(); });
			$('#modal-ahli form').submit(function() {
				if (! $('#modal-ahli form').valid()) {
					return false;
				}
				
				var param = Site.Form.GetValue('modal-ahli form');
				param.action = 'update_seeker_expert';
				Func.ajax({ url: web.host + 'seeker/resume/action', param: param, callback: function(result) {
					Func.show_notice({ text: result.message });
					if (result.status == 1) {
						ahli_dt.reload();
						$('#modal-ahli').modal('hide');
					}
				} });
				
				return false;
			});
		},
		education: function() {
			var dt = null;
			var param = {
				id: 'cnt-grid-education', aaSorting: [[0, 'desc']],
				source: web.host + 'seeker/resume/grid',
				column: [ { "bSearchable": false, "bVisible": false }, { }, { }, { bSortable: false, sClass: "center" } ],
				fnServerParams: function ( aoData ) {
					aoData.push( { "name": "grid_name", "value": "seeker_education" }, { "name": "seeker_id", "value": seeker.id } );
				},
				callback: function() {
					$('#cnt-grid-education .edit').click(function() {
						var raw_record = $(this).siblings('.hide').text();
						eval('var record = ' + raw_record);
						
						$('#modal-education [name="id"]').val(record.id);
						$('#modal-education [name="seeker_id"]').val(seeker.id);
						$('#modal-education [name="jenjang_id"]').val(record.jenjang_id);
						$('#modal-education [name="score"]').val(record.score);
						$('#modal-education [name="bidang_studi"]').val(record.bidang_studi);
						$('#modal-education [name="jurusan"]').val(record.jurusan);
						$('#modal-education [name="nama_sekolah"]').val(record.nama_sekolah);
						$('#modal-education [name="tgl_lulus"]').val(Func.SwapDate(record.tgl_lulus));
						$('#modal-education').modal();
					});
					
					$('#cnt-grid-education .delete').click(function() {
						var raw_record = $(this).siblings('.hide').text();
						eval('var record = ' + raw_record);
						
						Func.confirm_delete({
							data: { action: 'delete_seeker_education', id: record.id },
							url: web.host + 'seeker/resume/action', callback: function() { dt.reload(); }
						});
					});
				}
			}
			dt = Func.init_datatable(param);
			$('.btn-modal-education').click(function() {
				$('#modal-education form')[0].reset()
				$('#modal-education [name="id"]').val(0);
				$('#modal-education [name="seeker_id"]').val(seeker.id);
				$('#modal-education [name="jenjang_id"]').val(seeker.jenjang_id);
				$('#modal-education').modal();
			});
			$('#modal-education .modal-footer .modal-close').click(function() { $('#modal-education').modal('hide'); });
			$('#modal-education .modal-footer .modal-submit').click(function() { $('#modal-education').find('form').submit(); });
			$('#modal-education form').submit(function() {
				if (! $('#modal-education form').valid()) {
					return false;
				}
				
				var param = Site.Form.GetValue('modal-education form');
				param.tgl_lulus = Func.SwapDate(param.tgl_lulus);
				param.action = 'update_seeker_education';
				Func.ajax({ url: web.host + 'seeker/resume/action', param: param, callback: function(result) {
					Func.show_notice({ text: result.message });
					if (result.status == 1) {
						dt.reload();
						$('#modal-education').modal('hide');
					}
				} });
				
				return false;
			});
		},
		exp: function() {
			// set content
			Func.ajax({ url: web.host + 'seeker/resume/action', param: { action: 'get_seeker_exp', seeker_id: seeker.id }, callback: function(record) {
				$('#cnt-exp').html(record.content);
			} });
			
			// modal
			$('.btn-modal-exp').click(function() {
				Func.ajax({ url: web.host + 'seeker/resume/action', param: { action: 'get_seeker_exp', seeker_id: seeker.id }, callback: function(record) {
					// set valid data
					if (Func.InArray(record.exp_level, [1, 2])) {
						record.content = '';
					}
					
					$('#modal-exp [name="id"]').val(record.id);
					$('#modal-exp [name="seeker_id"]').val(seeker.id);
					$('#modal-exp [name="content"]').val(record.content);
					$('#modal-exp [name="exp_level"][value="' + record.exp_level + '"]').attr('checked', 'checked');
					$('#modal-exp').modal();
				} });
			});
			$('#modal-exp .modal-footer .modal-close').click(function() { $('#modal-exp').modal('hide'); });
			$('#modal-exp .modal-footer .modal-submit').click(function() { $('#modal-exp').find('form').submit(); });
			$('#modal-exp form').submit(function() {
				if (! $('#modal-exp form').valid()) {
					return false;
				}
				
				var param = Site.Form.GetValue('modal-exp form');
				param.action = 'update_seeker_exp';
				param.exp_level = $('#modal-exp input[name=exp_level]:checked').val();
				if (Func.InArray(param.exp_level, [1, 2])) {
					param.content = $('#modal-exp input[name=exp_level]:checked').parent('label').text().trim();
				}
				
				Func.ajax({ url: web.host + 'seeker/resume/action', param: param, callback: function(result) {
					Func.show_notice({ text: result.message });
					if (result.status == 1) {
						$('#cnt-exp').html(param.content);
						$('#modal-exp').modal('hide');
					}
				} });
				
				return false;
			});
		},
		language: function() {
			var dt = null;
			var param = {
				id: 'cnt-grid-language', aaSorting: [[0, 'desc']],
				source: web.host + 'seeker/resume/grid',
				column: [ { "bSearchable": false, "bVisible": false }, { }, { }, { }, { bSortable: false, sClass: "center" } ],
				fnServerParams: function ( aoData ) {
					aoData.push( { "name": "grid_name", "value": "seeker_language" }, { "name": "seeker_id", "value": seeker.id } );
				},
				callback: function() {
					$('#cnt-grid-language .edit').click(function() {
						var raw_record = $(this).siblings('.hide').text();
						eval('var record = ' + raw_record);
						
						$('#modal-language [name="id"]').val(record.id);
						$('#modal-language [name="seeker_id"]').val(seeker.id);
						$('#modal-language [name="nama"]').val(record.nama);
						$('#modal-language [name="lisan"]').val(record.lisan);
						$('#modal-language [name="tulis"]').val(record.tulis);
						$('#modal-language').modal();
					});
					
					$('#cnt-grid-language .delete').click(function() {
						var raw_record = $(this).siblings('.hide').text();
						eval('var record = ' + raw_record);
						
						Func.confirm_delete({
							data: { action: 'delete_seeker_language', id: record.id },
							url: web.host + 'seeker/resume/action', callback: function() { dt.reload(); }
						});
					});
				}
			}
			dt = Func.init_datatable(param);
			$('.btn-modal-language').click(function() {
				$('#modal-language form')[0].reset()
				$('#modal-language [name="id"]').val(0);
				$('#modal-language [name="seeker_id"]').val(seeker.id);
				$('#modal-language').modal();
			});
			$('#modal-language .modal-footer .modal-close').click(function() { $('#modal-language').modal('hide'); });
			$('#modal-language .modal-footer .modal-submit').click(function() { $('#modal-language').find('form').submit(); });
			$('#modal-language form').submit(function() {
				if (! $('#modal-language form').valid()) {
					return false;
				}
				
				var param = Site.Form.GetValue('modal-language form');
				param.action = 'update_seeker_language';
				Func.ajax({ url: web.host + 'seeker/resume/action', param: param, callback: function(result) {
					Func.show_notice({ text: result.message });
					if (result.status == 1) {
						dt.reload();
						$('#modal-language').modal('hide');
					}
				} });
				
				return false;
			});
		},
		addon: function() {
			// set content
			Func.ajax({ url: web.host + 'seeker/resume/action', param: { action: 'get_seeker_addon', seeker_id: seeker.id }, callback: function(result) {
				$('#cnt-addon').html(result.content);
			} });
			
			// modal
			$('.btn-modal-addon').click(function() {
				Func.ajax({ url: web.host + 'seeker/resume/action', param: { action: 'get_seeker_addon', seeker_id: seeker.id }, callback: function(result) {
					$('#modal-addon [name="seeker_id"]').val(seeker.id);
					$('#modal-addon [name="kendaraan"][value=' + result.kendaraan + ']').attr('checked', 'checked');
					$('#modal-addon [name="content"]').val(result.content);
					$('#modal-addon').modal();
				} });
			});
			$('#modal-addon .modal-footer .modal-close').click(function() { $('#modal-addon').modal('hide'); });
			$('#modal-addon .modal-footer .modal-submit').click(function() { $('#modal-addon').find('form').submit(); });
			$('#modal-addon form').submit(function() {
				if (! $('#modal-addon form').valid()) {
					return false;
				}
				
				var param = Site.Form.GetValue('modal-addon form');
				param.action = 'update_seeker_addon';
				param.kendaraan = $('#modal-addon input[name=kendaraan]:checked').val();
				Func.ajax({ url: web.host + 'seeker/resume/action', param: param, callback: function(result) {
					Func.show_notice({ text: result.message });
					if (result.status == 1) {
						$('#cnt-addon').html(param.content);
						$('#modal-addon').modal('hide');
					}
				} });
				
				return false;
			});
		},
		reference: function() {
			var dt = null;
			var param = {
				id: 'cnt-grid-reference', aaSorting: [[0, 'desc']],
				source: web.host + 'seeker/resume/grid',
				column: [ { "bSearchable": false, "bVisible": false }, { }, { bSortable: false, sClass: "center" } ],
				fnServerParams: function ( aoData ) {
					aoData.push( { "name": "grid_name", "value": "seeker_reference" }, { "name": "seeker_id", "value": seeker.id } );
				},
				callback: function() {
					$('#cnt-grid-reference .edit').click(function() {
						var raw_record = $(this).siblings('.hide').text();
						eval('var record = ' + raw_record);
						
						$('#modal-reference [name="id"]').val(record.id);
						$('#modal-reference [name="seeker_id"]').val(seeker.id);
						$('#modal-reference [name="nama"]').val(record.nama);
						$('#modal-reference [name="content"]').val(record.content);
						$('#modal-reference').modal();
					});
					
					$('#cnt-grid-reference .delete').click(function() {
						var raw_record = $(this).siblings('.hide').text();
						eval('var record = ' + raw_record);
						
						Func.confirm_delete({
							data: { action: 'delete_seeker_reference', id: record.id },
							url: web.host + 'seeker/resume/action', callback: function() { dt.reload(); }
						});
					});
				}
			}
			dt = Func.init_datatable(param);
			
			$('.btn-modal-reference').click(function() {
				$('#modal-reference form')[0].reset()
				$('#modal-reference [name="id"]').val(0);
				$('#modal-reference [name="seeker_id"]').val(seeker.id);
				$('#modal-reference').modal();
			});
			$('#modal-reference .modal-footer .modal-close').click(function() { $('#modal-reference').modal('hide'); });
			$('#modal-reference .modal-footer .modal-submit').click(function() { $('#modal-reference').find('form').submit(); });
			$('#modal-reference form').submit(function() {
				if (! $('#modal-reference form').valid()) {
					return false;
				}
				
				var param = Site.Form.GetValue('modal-reference form');
				param.action = 'update_seeker_reference';
				Func.ajax({ url: web.host + 'seeker/resume/action', param: param, callback: function(result) {
					Func.show_notice({ text: result.message });
					if (result.status == 1) {
						dt.reload();
						$('#modal-reference').modal('hide');
					}
				} });
				
				return false;
			});
		},
		summary: function() {
			$('.btn-modal-summary').click(function() {
				Func.ajax({ url: web.host + 'seeker/resume/action', param: { action: 'get_seeker_summary', seeker_id: seeker.id }, callback: function(result) {
					$('#modal-summary [name="id"]').val(result.id);
					$('#modal-summary [name="seeker_id"]').val(seeker.id);
					$('#modal-summary [name="jenjang_id"]').val(result.jenjang_id);
					$('#modal-summary [name="score"]').val(result.score);
					$('#modal-summary [name="school"]').val(result.school);
					$('#modal-summary [name="experience"]').val(result.experience);
					$('#modal-summary').modal();
				} });
			});
			$('#modal-summary .modal-footer .modal-close').click(function() { $('#modal-summary').modal('hide'); });
			$('#modal-summary .modal-footer .modal-submit').click(function() { $('#modal-summary').find('form').submit(); });
			$('#modal-summary form').submit(function() {
				if (! $('#modal-summary form').valid()) {
					return false;
				}
				
				var param = Site.Form.GetValue('modal-summary form');
				param.action = 'update_seeker_summary';
				Func.ajax({ url: web.host + 'seeker/resume/action', param: param, callback: function(result) {
					Func.show_notice({ text: result.message });
					if (result.status == 1) {
						$('#form-summary [name="jenjang_nama"]').val(result.jenjang_nama);
						$('#form-summary [name="score"]').val(result.score);
						$('#form-summary [name="school"]').val(result.school);
						$('#form-summary [name="experience"]').val(result.experience);
						$('#modal-summary').modal('hide');
					}
				} });
				
				return false;
			});
		}
	}
	
	page.init();
});
</script>
</body>
</html>