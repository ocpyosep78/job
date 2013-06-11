<?php
	preg_match('/slide\/index\/([\d]+)/i', $_SERVER['REQUEST_URI'], $match);
	$vacancy_id = (empty($match[1])) ? 0 : $match[1];
	
	$param_apply = array(
		'vacancy_id' => $vacancy_id, 'is_delete' => 0, 'limit' => 1000,
		'filter' => '[{"type":"numeric","comparison":"not","value":"' . APPLY_STATUS_REJECT . '","field":"Apply.apply_status_id"}]'
	);
	$array_apply = $this->Apply_model->get_array_seeker($param_apply);
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'View Slide') ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Slide', 'class' => 'icon-reorder' ) ); ?>
							
		<div class="box-content"><div id="daily-event"><ul class="slides">
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
										<a href="<?php echo base_url('company/download/view/pelamar'); ?>">
											<img src="<?php echo base_url('static/img/button_view.png'); ?>" class="button-cursor interview">
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
		</ul></div></div>
	</div></div></div></div></div>
</div>
<script>
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
</script>
</body>
</html>