<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Slide', 'class' => 'icon-reorder' ) ); ?>
							
		<div class="box-content">
			<div id="daily-event">
				<ul class="slides">
					<li>
						<div class="cnt-photo">
							<div class="cnt-left"><a href="#" class='prev'><img src="<?php echo base_url('static/theme/flat/img/slide_prev.png'); ?>" /></a></div>
							<div class="cnt-right"><a href="#" class='next'><img src="<?php echo base_url('static/theme/flat/img/slide_next.png'); ?>" /></a></div>
							<div class="cnt-middle"><img src='http://localhost:8666/job/trunk/static/upload/today-event.png' /></div>
							<div class="clear"></div>
						</div>
						
						<div class="box">
							<div class="box-title">&nbsp;</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Rendering engine</th>
											<th>Browser</th>
											<th class='hidden-350'>Platform(s)</th>
											<th class='hidden-1024'>Engine version</th>
											<th class='hidden-480'>CSS grade</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Trident</td>
											<td>
												Internet
												Explorer 4.0
											</td>
											<td class='hidden-350'>Win 95+</td>
											<td class='hidden-1024'>4</td>
											<td class='hidden-480'>X</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</li>
					<li>
						<div class="cnt-photo">
							<div class="cnt-left"><a href="#" class='prev'><img src="<?php echo base_url('static/theme/flat/img/slide_prev.png'); ?>" /></a></div>
							<div class="cnt-right"><a href="#" class='next'><img src="<?php echo base_url('static/theme/flat/img/slide_next.png'); ?>" /></a></div>
							<div class="cnt-middle"><img src='http://localhost:8666/job/trunk/static/upload/today-event.png' /></div>
							<div class="clear"></div>
						</div>
						
						<div class="box">
							<div class="box-title">&nbsp;</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Rendering engine</th>
											<th>Browser</th>
											<th class='hidden-350'>Platform(s)</th>
											<th class='hidden-1024'>Engine version</th>
											<th class='hidden-480'>CSS grade</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Trident</td>
											<td>
												Internet
												Explorer 4.0
											</td>
											<td class='hidden-350'>Win 95+</td>
											<td class='hidden-1024'>4</td>
											<td class='hidden-480'>X</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</li>
					<li>
						<div class="cnt-photo">
							<div class="cnt-left"><a href="#" class='prev'><img src="<?php echo base_url('static/theme/flat/img/slide_prev.png'); ?>" /></a></div>
							<div class="cnt-right"><a href="#" class='next'><img src="<?php echo base_url('static/theme/flat/img/slide_next.png'); ?>" /></a></div>
							<div class="cnt-middle"><img src='http://localhost:8666/job/trunk/static/upload/today-event.png' /></div>
							<div class="clear"></div>
						</div>
						
						<div class="box">
							<div class="box-title">&nbsp;</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Rendering engine</th>
											<th>Browser</th>
											<th class='hidden-350'>Platform(s)</th>
											<th class='hidden-1024'>Engine version</th>
											<th class='hidden-480'>CSS grade</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Trident</td>
											<td>
												Internet
												Explorer 4.0
											</td>
											<td class='hidden-350'>Win 95+</td>
											<td class='hidden-1024'>4</td>
											<td class='hidden-480'>X</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div></div></div></div></div>
</div>
<script>
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
</script>
</body>
</html>