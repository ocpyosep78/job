<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Event', 'class' => 'icon-reorder' ) ); ?>
						
						<div class="box-content">
							<div class="row-fluid">
								<div class="span12">
									<div class="box">
										<div class="box-content nopadding">
											<table id="example" class="table table-striped table-bordered">
												<thead><tr>
													<th>Nama Bank</th>
													<th>No Rekening</th>
													<th>Nama Pemilik</th>
													<th style="width: 75px;">&nbsp;</th>
												</tr></thead>
												<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div></div>
	<script>
		$(document).ready(function() {
			$('#example').dataTable( {
				"bProcessing": true, "bServerSide": true,
				"sServerMethod": "POST",
				"sPaginationType": "full_numbers",
				"oLanguage":{
					"sSearch": "<span>Search:</span> ",
					"sInfo": "Showing <span>_START_</span> to <span>_END_</span> of <span>_TOTAL_</span> entries",
					"sLengthMenu": "_MENU_ <span>entries per page</span>"
				},
				"sAjaxSource": web.host + 'seeker/apply/grid',
				"aoColumns" : [   
					{ },
					{ },
					{ },
					{ bSortable: false, sClass: "center" }
				],
				"fnDrawCallback": function (oSettings) {
					$('#example .edit').click(function() { console.log('click'); });
					$('#example .delete').click(function() { console.log('delete'); });
					console.log( 'DataTables has redrawn the table' );
				}
			} );
			
			$('#example_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn btn-small">Tambah</button></div>');
			$('#example_wrapper input').attr("placeholder", "Search here...");
			$("#example_wrapper select").wrap("<div class='input-mini'></div>").chosen({ disable_search_threshold: 9999999 });
        });
    </script>
</body>
</html>