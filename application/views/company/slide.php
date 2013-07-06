<?php
	preg_match('/slide\/index\/([\d]+)/i', $_SERVER['REQUEST_URI'], $match);
	$vacancy_id = (empty($match[1])) ? 0 : $match[1];
	$array_apply_status = array( 'APPLY_STATUS_INTERVIEW' => APPLY_STATUS_INTERVIEW, 'APPLY_STATUS_REJECT' => APPLY_STATUS_REJECT );
	
	$param_apply = array(
		'vacancy_id' => $vacancy_id, 'is_delete' => 0, 'limit' => 1000,
		'filter' => '[{"type":"numeric","comparison":"not","value":"' . APPLY_STATUS_REJECT . '","field":"Apply.apply_status_id"}]'
	);
	$array_apply = $this->Apply_model->get_array_seeker($param_apply);
	
	// update status apply
	foreach ($array_apply as $key => $apply) {
		if ($apply['apply_status_id'] == APPLY_STATUS_OPEN) {
			$this->Apply_model->update_status_view(array( 'id' => $apply['id'] ));
		}
	}
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'View Slide') ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Slide', 'class' => 'icon-reorder' ) ); ?>
							
		<div class="box-content">
			<div class="hide">
				<div class="cnt-apply"><?php echo json_encode($array_apply_status); ?></div>
			</div>
			
			<div id="daily-event"><ul class="slides">
				<?php foreach ($array_apply as $seeker) { ?>
					<li>
						<div class="cnt-photo">
							<div class="cnt-left"><a href="#" class="prev"><img src="<?php echo base_url('static/theme/flat/img/slide_prev.png'); ?>" /></a></div>
							<div class="cnt-right"><a href="#" class="next"><img src="<?php echo base_url('static/theme/flat/img/slide_next.png'); ?>" /></a></div>
							<div class="cnt-middle"><img src="<?php echo $seeker['photo_link']; ?>" /></div>
							<div class="clear"></div>
						</div>
						
						<div class="box">
							<div class="box-title">&nbsp;</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered">
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
										<th>&nbsp;</th>
									</tr></thead>
									<tbody><tr>
										<td><?php echo $seeker['seeker_no']; ?></td>
										<td><?php echo $seeker['full_name']; ?></td>
										<td><?php echo $seeker['usia']; ?></td>
										<td><?php echo $seeker['score']; ?></td>
										<td><?php echo $seeker['jenjang_nama']; ?></td>
										<td><?php echo $seeker['school']; ?></td>
										<td><?php echo $seeker['kota_nama']; ?></td>
										<td><?php echo $seeker['marital_nama']; ?></td>
										<td><?php echo $seeker['experience']; ?></td>
										<td style="min-width: 90px; text-align: center;">
											<a href="<?php echo $seeker['seeker_link']; ?>">
												<img src="<?php echo base_url('static/img/button_view.png'); ?>" class="button-cursor">
											</a>
											
											<?php if (in_array($seeker['apply_status_id'], array(APPLY_STATUS_EMPTY, APPLY_STATUS_OPEN))) { ?>
												<img src="<?php echo base_url('static/img/button_interview.png'); ?>" class="button-cursor interview">
												<img src="<?php echo base_url('static/img/button_remove.png'); ?>" class="button-cursor delete">
											<?php } ?>
											
											<span class="hide"><?php echo json_encode($seeker); ?></span>
										</td>
									</tr></tbody>
								</table>
							</div>
						</div>
					</li>
				<?php } ?>
			</ul></div>
			
			<div id="modal-message" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="myModalLabel">Form </h3>
				</div>
				<form class='form-horizontal form-validate' id="form-apply">
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
					<button class="btn modal-close" data-dismiss="modal" aria-hidden="true">Close</button>
					<button class="btn modal-submit btn-primary" data-dismiss="modal">Save changes</button>
				</div>
			</div>
		</div>
	</div></div></div></div></div>
</div>
<script>
	// apply status
	var raw_apply = $('.cnt-apply').text();
	eval('var apply = ' + raw_apply);
	
	if ($('.next').length == 1) {
		$('.next, .prev').hide();
	} else {
		// init slide
		$('#daily-event').flexslider({
			'controlNav': false,
			'directionNav' : false,
			"touch": true,
			"animation": "slide",
			"animationLoop": true,
			"slideshow" : false
		});
		$('.next').click(function() {
			$('#daily-event').flexslider("next");
			return false;
		});
		$('.prev').click(function() {
			$('#daily-event').flexslider("prev");
			return false;
		});
	}
	
	// grid
	$('#daily-event .interview').click(function() {
		row = $(this).parents('tr');
		var raw_record = row.find('span.hide').text();
		eval('var record = ' + raw_record);
		
		$('[name="id"]').val(record.id);
		$('[name="nama"]').val('Berita Interview');
		$('[name="apply_status_id"]').val(apply.APPLY_STATUS_INTERVIEW);
		$('#modal-message').modal();
	});
	$('#daily-event .delete').click(function() {
		row = $(this).parents('tr');
		var raw_record = row.find('span.hide').text();
		eval('var record = ' + raw_record);
		
		$('[name="id"]').val(record.id);
		$('[name="nama"]').val('Berita Penolakan');
		$('[name="apply_status_id"]').val(apply.APPLY_STATUS_REJECT);
		$('#modal-message').modal();
	});
	
	// form
	$('#form-apply').submit(function() {
		if (! $('#form-apply').valid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('form-apply');
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
				$('#modal-message').modal('hide');
			}
		} });
		
		return false;
	});
</script>
</body>
</html>