<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Report' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Report', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">			
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-report" class="table table-striped table-bordered">
					<thead><tr>
						<th>ID</th>
						<th>Perusahaan</th>
						<th>Email Pelapor</th>
						<th>Berita</th>
						<th>&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
		</div>
	</div></div></div></div></div>
</div>
<script>
	$(document).ready(function() {
		var dt = null;
		
		var param = {
			id: 'cnt-report', aaSorting: [[0, 'desc']],
			source: web.host + 'editor/report/grid',
			column: [ { "bSearchable": false, "bVisible": false }, { }, { }, { }, { bSortable: false, sClass: "center", sWidth: "10%" } ],
			callback: function() {
				$('#cnt-report .view').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					window.open(record.vacancy_link);
				});
				
				$('#cnt-report .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
                    Func.confirm_delete({
                        data: { action: 'delete', id: record.id },
                        url: web.host + 'editor/report/action', callback: function() { dt.reload(); }
                    });
				});
			}
		}
		dt = Func.init_datatable(param);
	});
</script>
</body>
</html>