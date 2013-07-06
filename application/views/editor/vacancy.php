<?php
	$array_vacancy_status = array( 'approve' => VACANCY_STATUS_APPROVE, 'cancel' => VACANCY_STATUS_CANCEL );
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Lowongan' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Lowongan', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="hide">
				<div class="cnt-vacancy-status"><?php echo json_encode($array_vacancy_status); ?></div>
			</div>
			
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-widget" class="table table-striped table-bordered">
					<thead><tr>
						<th>ID</th>
						<th>Nama</th>
						<th>Perusahaan</th>
						<th>Status</th>
						<th>Publish Date</th>
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
		
		// vacancy status
		var raw_vacancy_status = $('.cnt-vacancy-status').text();
		eval('var vacancy_status = ' + raw_vacancy_status);
		
		var param = {
			id: 'cnt-widget', aaSorting: [[0, 'desc']],
			source: web.host + 'editor/vacancy/grid',
			column: [ { "bSearchable": false, "bVisible": false }, { }, { }, { }, { }, { bSortable: false, sClass: "center", sWidth: "10%" } ],
			callback: function() {
				$('#cnt-widget .view').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					window.open(record.vacancy_link);
				});
				
				$('#cnt-widget .confirm').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					var param = { action: 'update', id: record.id, vacancy_status_id: vacancy_status.approve };
					Func.ajax({ url: web.host + 'editor/vacancy/action', param: param, callback: function(result) {
						Func.show_notice({ text: result.message });
						if (result.status == 1) {
							dt.reload();
						}
					} });
				});
				
				$('#cnt-widget .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					var param = { action: 'update', id: record.id, vacancy_status_id: vacancy_status.cancel };
					Func.ajax({ url: web.host + 'editor/vacancy/action', param: param, callback: function(result) {
						Func.show_notice({ text: result.message });
						if (result.status == 1) {
							dt.reload();
						}
					} });
				});
			}
		}
		dt = Func.init_datatable(param);
	});
</script>
</body>
</html>