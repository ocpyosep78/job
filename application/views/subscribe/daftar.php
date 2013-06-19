<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Subscribe' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Subscribe', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-subscribe" class="table table-striped table-bordered">
					<thead><tr>
						<th>Nama</th>
						<th>Jenis</th>
						<th>Berlangganan</th>
						<th style="width: 75px;">&nbsp;</th>
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
			id: 'cnt-subscribe',
			source: web.host + 'subscribe/daftar/grid',
			column: [ { }, { }, { }, { bSortable: false, sClass: "center" } ],
			callback: function() {
				$('#cnt-subscribe .remove, #cnt-subscribe .confirm').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					var param = { action: 'update', id: record.id, status: (record.status == 1) ? 0 : 1 }
					Func.ajax({ url: web.host + 'subscribe/daftar/action', param: param, callback: function(result) {
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