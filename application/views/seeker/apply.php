<?php $this->load->view( 'panel/common/meta', array( 'title' => 'My Jobs Applied' ) ); ?>
<body data-layout="fixed">
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'My Jobs Applied', 'class' => 'icon-reorder' ) ); ?>
						
		<div class="box-content"><div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
			<table id="cnt-apply" class="table table-striped table-bordered">
				<thead><tr>
					<th>Position</th>
					<th>Company</th>
					<th>Location</th>
					<th>Time</th>
					<th>Status</th>
					<th style="width: 75px;">&nbsp;</th>
				</tr></thead>
				<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
			</table>
		</div></div></div></div></div>
	</div></div></div></div></div>
</div>
<script>
	$(document).ready(function() {
		var dt = null;
		
		var param = {
			id: 'cnt-apply',
			source: web.host + 'seeker/apply/grid',
			column: [ { }, { }, { }, { }, { }, { bSortable: false, sClass: "center" } ],
			callback: function() {
				$('#cnt-apply .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
                    Func.confirm_delete({
                        data: { action: 'update', id: record.id, is_delete: 1 },
                        url: web.host + 'seeker/apply/action', callback: function() { dt.reload(); }
                    });
				});
			}
		}
		dt = Func.init_datatable(param);
		
		return;
		$('#cnt-apply').dataTable( {
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
				{ },
				{ },
				{ bSortable: false, sClass: "center" }
			],
			"fnDrawCallback": function (oSettings) {
				$('#cnt-apply .edit').click(function() { console.log('click'); });
				$('#cnt-apply .delete').click(function() { console.log('delete'); });
				console.log( 'DataTables has redrawn the table' );
			}
		} );
		$('#cnt-apply_wrapper input').attr("placeholder", "Search here...");
		$("#cnt-apply_wrapper select").wrap("<div class='input-mini'></div>").chosen({ disable_search_threshold: 9999999 });
	});
</script>
</body>
</html>