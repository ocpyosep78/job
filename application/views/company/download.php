<?php
	preg_match('/download\/index\/([\d]+)/i', $_SERVER['REQUEST_URI'], $match);
	$vacancy_id = (empty($match[1])) ? 0 : $match[1];
	
	$company = $this->Company_model->get_session();
	$array_vacancy = $this->Vacancy_model->get_array(array( 'company_id' => $company['id'] ));
	$array_apply_status = array( 'APPLY_STATUS_INTERVIEW' => APPLY_STATUS_INTERVIEW, 'APPLY_STATUS_REJECT' => APPLY_STATUS_REJECT, 'APPLY_STATUS_VIEW' => APPLY_STATUS_VIEW );
	
	$array_apply = array();
	if (!empty($vacancy_id)) {
		$param_apply = array(
			'vacancy_id' => $vacancy_id, 'is_delete' => 0, 'limit' => 1000,
			'filter' => '[{"type":"numeric","comparison":"not","value":"' . APPLY_STATUS_REJECT . '","field":"Apply.apply_status_id"}]'
		);
		$array_apply = $this->Apply_model->get_array_seeker($param_apply);
	}
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Download' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<style>
.dataTables_wrapper .clear { clear: none; }
</style>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Download', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="hide">
				<div class="cnt-apply"><?php echo json_encode($array_apply_status); ?></div>
			</div>
			
			<div>
				<div style="float: left; width: 140px; padding: 3px 0 0 0;">Sort by jobs Position :</div>
				<div style="float: left; width: 200px;">
					<select class="select-position">
						<?php echo ShowOption(array( 'Array' => $array_vacancy, 'ArrayID' => 'id', 'ArrayTitle' => 'nama', 'Selected' => @$vacancy_id )); ?>
					</select>
				</div>
				<?php if (count($array_apply) > 0) { ?>
				<div style="float: right; width: 350px; text-align: right;">
					<a href="<?php echo base_url('company/vacancy_exam/index/'.$vacancy_id); ?>" class="btn btn-small btn-slide">Kirim Exan</a>
					<a href="<?php echo base_url('company/slide/index/'.$vacancy_id); ?>" class="btn btn-small btn-slide">View Photo In Slide</a>
				</div>
				<?php } ?>
				<div class="clear"></div>
			</div>
			
			<div id="modal-interview" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>Form </h3>
				</div>
				<form class='form-horizontal form-validate' id="form-interview">
					<input type="hidden" name="id" value="0" />
					<input type="hidden" name="apply_status_id" value="0" />
					
					<div class="modal-body">
						<div class="control-group">
							<label for="input-nama" class="control-label">Judul</label>
							<div class="controls"><input type="text" name="nama" id="input-nama" class="input-xlarge" data-rule-required="true" maxlength="20" /></div>
						</div>
						<div class="control-group">
							<label for="input-content1" class="control-label">Isi Pesan</label>
							<div class="controls"><textarea name="content" id="input-content1" class="tinymce span9" style="height: 150px;"></textarea></div>
						</div>
					</div>
				</form>
				<div class="modal-footer">
					<button class="btn modal-close" aria-hidden="true">Close</button>
					<button class="btn modal-submit btn-primary">Save changes</button>
				</div>
			</div>
			
			<?php if (count($array_apply) > 0) { ?>
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table class="grid-apply table table-hover table-nomargin dataTable dataTable-tools table-bordered">
					<thead><tr>
						<th>No Pelamar</th>
						<th>Nama</th>
						<th>Usia</th>
						<th>Nilai</th>
						<th>Jenjang</th>
						<th>Nama Sekolah</th>
						<th>Kota</th>
						<th>Status</th>
						<th>Pengalaman</th>
						<th>Status Lamaran</th>
						<th>&nbsp;</th>
					</tr></thead>
					<tbody>
						<?php foreach ($array_apply as $seeker) { ?>
							<tr>
								<td><?php echo $seeker['seeker_no']; ?></td>
								<td><?php echo $seeker['full_name']; ?></td>
								<td><?php echo $seeker['usia']; ?></td>
								<td><?php echo $seeker['score']; ?></td>
								<td><?php echo $seeker['jenjang_nama']; ?></td>
								<td><?php echo $seeker['school']; ?></td>
								<td><?php echo $seeker['kota_nama']; ?></td>
								<td><?php echo $seeker['marital_nama']; ?></td>
								<td><?php echo $seeker['experience']; ?></td>
								<td><?php echo $seeker['apply_status_nama']; ?></td>
								<td style="min-width: 90px; text-align: center;">
									<a href="<?php echo $seeker['seeker_link']; ?>" target="_blank" class="update_view">
										<img src="<?php echo base_url('static/img/button_view.png'); ?>" class="button-cursor">
									</a>
									
									<?php if (in_array($seeker['apply_status_id'], array(APPLY_STATUS_EMPTY, APPLY_STATUS_OPEN, APPLY_STATUS_VIEW))) { ?>
										<img src="<?php echo base_url('static/img/button_interview.png'); ?>" class="button-cursor interview">
										<img src="<?php echo base_url('static/img/button_remove.png'); ?>" class="button-cursor delete">
									<?php } ?>
									
									<span class="hide"><?php echo json_encode($seeker); ?></span>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div></div></div></div>
			<?php } ?>
			
			<?php if (count($array_apply) == 0 && !empty($vacancy_id)) { ?>
			<div class="row-fluid margin-top">
				<div class="alert alert-info">Belum ada pelamar.</div>
			</div>
			<?php } ?>
		</div>
	</div></div></div></div></div>
</div>
<script>
	$(document).ready(function() {
		// apply status
		var raw_apply = $('.cnt-apply').text();
		eval('var apply = ' + raw_apply);
		
		// page variable
		var row = null;
		
		$('.select-position').chosen({ disable_search_threshold: 9999999 }).change(function() {
			var link_redirect = web.host + 'company/download/index/' + $(this).val();
			window.location = link_redirect;
		});
		
		// grid
		$('.grid-apply .update_view').click(function() {
			row = $(this).parents('tr');
			var raw_record = row.find('span.hide').text();
			eval('var record = ' + raw_record);
			
			var param = { action: 'update_status', id: record.id }
			Func.ajax({ url: web.host + 'company/download/action', param: param, callback: function(result) { } });
		});
		$('.grid-apply .interview').click(function() {
			row = $(this).parents('tr');
			var raw_record = row.find('span.hide').text();
			eval('var record = ' + raw_record);
			
			$('[name="id"]').val(record.id);
			$('[name="nama"]').val('Berita Interview');
			$('[name="apply_status_id"]').val(apply.APPLY_STATUS_INTERVIEW);
			$('#modal-interview').modal();
		});
		$('.grid-apply .delete').click(function() {
			row = $(this).parents('tr');
			var raw_record = row.find('span.hide').text();
			eval('var record = ' + raw_record);
			
			$('[name="id"]').val(record.id);
			$('[name="nama"]').val('Berita Penolakan');
			$('[name="apply_status_id"]').val(apply.APPLY_STATUS_REJECT);
			$('#modal-interview').modal();
		});
		
		// form
		$('#modal-interview .modal-footer .modal-close').click(function() { $('#modal-interview').modal('hide'); });
		$('#modal-interview .modal-footer .modal-submit').click(function() { $('#modal-interview').find('form').submit(); });
		$('#modal-interview form').submit(function() {
			if (! $('#form-interview').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('form-interview');
			param.action = 'update_mail';
			
			if (param.apply_status_id == apply.APPLY_STATUS_INTERVIEW) {
				// interview
				row.find('.interview').remove();
				row.find('.delete').remove();
			} else if (param.apply_status_id == apply.APPLY_STATUS_REJECT) {
				// rejected
				row.remove();
			}
			
			Func.ajax({ url: web.host + 'company/download/action', param: param, callback: function(result) {
				Func.show_notice({ text: result.message });
				if (result.status == 1) {
					window.location = window.location.href;
				}
			} });
			
			return false;
		});
	});
</script>
</body>
</html>