<?php
	if (!empty($seeker_no)) {
		$seeker = $this->Seeker_model->get_by_id(array( 'seeker_no' => $seeker_no ));
		$seeker['is_readonly'] = true;
	} else {
		$seeker = $this->Seeker_model->get_session();
		$seeker['is_readonly'] = false;
	}
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
				<iframe name="iframe_seeker_photo" src="<?php echo base_url('panel/upload?callback=seeker_photo'); ?>"></iframe>
			</div>
			
			<div id="modal-ahli" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="myModalLabel">Form Keahlian / Ketrampilan</h3>
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
					<button class="btn modal-submit btn-primary" data-dismiss="modal">Save changes</button>
				</div>
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
			
			<div class="box box-color box-bordered teal" id="cnt-detail">
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
							<div class="controls"><textarea name="address" id="address" readonly="readonly" class="span12"></textarea></div>
						</div>
					</form>
					
					<div style="position: absolute; top: 10px; right: 10px;">
						<div style="width: 125px; text-align: center;">
							<img src="<?php echo base_url('static/theme/flat/img/demo/user-avatar.jpg'); ?>" style="width: 125px; height: 160px;" />
							<div style="padding: 10px 0 0 0;">
								<div class="default"><button class="btn btn-success">Upload Photo</button></div>
								<div class="confirm hide">
									<button class="btn btn-success">Save</button>
									<button class="btn btn-success">Batal</button>
								</div>
							</div>
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
						<a class="btn cursor btn-mini"><i class="icon-edit btn-modal-ahli"></i></a>
					</div>
				</div>
				<div class="box-content">
					<table id="cnt-grid-ahli" class="table table-striped table-bordered">
						<thead><tr>
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
		
		<div id="modal-lamaran" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Form Surat Lamaran</h3>
			</div>
			<form class='form-horizontal form-validate' id="form-lamaran">
				<input type="hidden" name="id" value="0" />
				<input type="hidden" name="seeker_id" value="0" />
				<div class="modal-body">
					<div class="control-group">
						<label for="input-nama" class="control-label">Judul Surat</label>
						<div class="controls">
							<input type="text" name="nama" id="input-nama" class="input-xlarge" data-rule-required="true" maxlength="20" />
						</div>
					</div>
					<div class="control-group">
						<label for="input-content1" class="control-label">Isi Surat</label>
						<div class="controls">
							<textarea name="content" id="input-content1" class="tinymce span9" style="height: 350px;"></textarea>
						</div>
					</div>
				</div>
			</form>
			<div class="modal-footer">
				<button class="btn modal-close" data-dismiss="modal" aria-hidden="true">Close</button>
				<button class="btn modal-submit btn-primary" data-dismiss="modal">Save changes</button>
			</div>
		</div>
	</div></div></div></div></div>
</div>
<script>
	$(document).ready(function() {
		var seeker = Func.get_seeker();
		$('[name="id"]').val(seeker.id);
		$('[name="full_name"]').val(seeker.full_name);
		$('[name="email"]').val(seeker.email);
		$('[name="phone"]').val(seeker.phone);
		$('[name="hp"]').val(seeker.hp);
		$('[name="address"]').val(seeker.address);
		$('[name="tgl_lahir"]').val(Func.SwapDate(seeker.tgl_lahir));
		$('[name="kelamin_nama"]').val(seeker.kelamin_nama);
		$('[name="kebangsaan"]').val(seeker.kebangsaan);
		
		// set readonly for company
		if (seeker.is_readonly) {
			$('.actions').remove();
		}
		
		// form
		seeker_photo = function(p) {
			console.log(p)
			$('[name="logo"]').val(p.file_name);
		}
		$('#cnt-detail .default .btn').click(function() { window.iframe_seeker_photo.browse() });
		
		/*	Keahlian */
		var ahli_dt = null;
		var ahli_param = {
			id: 'cnt-grid-ahli',
			source: web.host + 'seeker/resume/grid',
			column: [ { }, { bSortable: false, sClass: "center" } ],
			fnServerParams: function ( aoData ) {
				aoData.push( { "name": "grid_name", "value": "seeker_expert" } );
			},
			callback: function() {
				$('#cnt-grid-ahli .edit').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					$('#modal-ahli [name="id"]').val(record.id);
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
	});
</script>
</body>
</html>