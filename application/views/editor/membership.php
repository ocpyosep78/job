<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Membership' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Membership', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-widget" class="table table-striped table-bordered">
					<thead><tr>
						<th>Tanggal</th>
						<th>Perusahaan</th>
						<th>Post</th>
						<th>Waktu</th>
						<th>Harga</th>
						<th>Status</th>
						<th style="width: 110px;">&nbsp;</th>
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
			id: 'cnt-widget',
			source: web.host + 'editor/membership/grid',
			column: [ { }, { }, { }, { }, { }, { }, { bSortable: false, sClass: "center" } ],
			callback: function() {
				$('#cnt-widget .confirm').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					var param = { action: 'update', id: record.id, status: 'confirm' };
					Func.ajax({ url: web.host + 'editor/membership/action', param: param, callback: function(result) {
						Func.show_notice({ text: result.message });
						if (result.status == 1) {
							dt.reload();
						}
					} });
				});
				
				$('#cnt-widget .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					var param = { action: 'update', id: record.id, status: 'cancel' };
					Func.ajax({ url: web.host + 'editor/membership/action', param: param, callback: function(result) {
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