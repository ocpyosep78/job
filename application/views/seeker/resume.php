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
						<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Resume', 'class' => 'icon-reorder' ) ); ?>
						
						<div class="box-content">
							Content
							
							<!-- Information -->
							<div class="row-fluid margin-top">
								<div class="alert alert-info">Due to the widgets is the sidebar resize feature disabled on this site!</div>
							</div>
							<div class="row-fluid">
								<div class="alert alert-info"><strong>You can sort the sidebar widgets by dragging their title.</strong></div>
							</div>
							
							<!-- Button -->
							<div>
								<li><i class="glyphicon-pencil"></i> pencil</li>
								<li><i class="glyphicon-edit"></i> edit</li>
								<li><i class="icon-trash"></i> icon-trash</li>
							</div>
							
							<!-- Table with Export Feature -->
							<div class="row-fluid">
								<div class="span12">
									<div class="box">
										<div class="box-content nopadding">
											<table class="table table-hover table-nomargin dataTable dataTable-tools table-bordered">
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
													<tr>
														<td>Presto</td>
														<td>Nokia N800</td>
														<td class='hidden-350'>N800</td>
														<td class='hidden-1024'>-</td>
														<td class='hidden-480'>A</td>
													</tr>
													<tr>
														<td>Misc</td>
														<td>NetFront 3.4</td>
														<td class='hidden-350'>Embedded devices</td>
														<td class='hidden-1024'>-</td>
														<td class='hidden-480'>A</td>
													</tr>
													<tr>
														<td>Misc</td>
														<td>Dillo 0.8</td>
														<td class='hidden-350'>Embedded devices</td>
														<td class='hidden-1024'>-</td>
														<td class='hidden-480'>X</td>
													</tr>
													<tr>
														<td>Misc</td>
														<td>Links</td>
														<td class='hidden-350'>Text only</td>
														<td class='hidden-1024'>-</td>
														<td class='hidden-480'>X</td>
													</tr>
													<tr>
														<td>Misc</td>
														<td>Lynx</td>
														<td class='hidden-350'>Text only</td>
														<td class='hidden-1024'>-</td>
														<td class='hidden-480'>X</td>
													</tr>
													<tr>
														<td>Misc</td>
														<td>IE Mobile</td>
														<td class='hidden-350'>Windows Mobile 6</td>
														<td class='hidden-1024'>-</td>
														<td class='hidden-480'>C</td>
													</tr>
													<tr>
														<td>Misc</td>
														<td>PSP browser</td>
														<td class='hidden-350'>PSP</td>
														<td class='hidden-1024'>-</td>
														<td class='hidden-480'>C</td>
													</tr>
													<tr>
														<td>Other browsers</td>
														<td>All others</td>
														<td class='hidden-350'>-</td>
														<td class='hidden-1024'>-</td>
														<td class='hidden-480'>U</td>
													</tr>
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
													<tr>
														<td>Presto</td>
														<td>Nokia N800</td>
														<td class='hidden-350'>N800</td>
														<td class='hidden-1024'>-</td>
														<td class='hidden-480'>A</td>
													</tr>
													<tr>
														<td>Misc</td>
														<td>NetFront 3.4</td>
														<td class='hidden-350'>Embedded devices</td>
														<td class='hidden-1024'>-</td>
														<td class='hidden-480'>A</td>
													</tr>
													<tr>
														<td>Misc</td>
														<td>Dillo 0.8</td>
														<td class='hidden-350'>Embedded devices</td>
														<td class='hidden-1024'>-</td>
														<td class='hidden-480'>X</td>
													</tr>
													<tr>
														<td>Misc</td>
														<td>Links</td>
														<td class='hidden-350'>Text only</td>
														<td class='hidden-1024'>-</td>
														<td class='hidden-480'>X</td>
													</tr>
													<tr>
														<td>Misc</td>
														<td>Lynx</td>
														<td class='hidden-350'>Text only</td>
														<td class='hidden-1024'>-</td>
														<td class='hidden-480'>X</td>
													</tr>
													<tr>
														<td>Misc</td>
														<td>IE Mobile</td>
														<td class='hidden-350'>Windows Mobile 6</td>
														<td class='hidden-1024'>-</td>
														<td class='hidden-480'>C</td>
													</tr>
													<tr>
														<td>Misc</td>
														<td>PSP browser</td>
														<td class='hidden-350'>PSP</td>
														<td class='hidden-1024'>-</td>
														<td class='hidden-480'>C</td>
													</tr>
													<tr>
														<td>Other browsers</td>
														<td>All others</td>
														<td class='hidden-350'>-</td>
														<td class='hidden-1024'>-</td>
														<td class='hidden-480'>U</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							
							
							<div class="box box-color box-bordered teal">
								<div class="box-title">
									<h3>
										<i class="icon-file"></i>
										Widget #6
									</h3>
								</div>
								<div class="box-content">
									Lorem ipsum Anim cillum commodo cillum tempor irure consectetur occaecat proident mollit eiusmod Duis.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div></div>
</body>
</html>