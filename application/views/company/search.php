<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Find Resume' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Find Resume', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content"><div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
			<table id="cnt-search" class="table table-striped table-bordered">
				<thead><tr>
					<th>No Pelamar</th>
					<th>Nama</th>
					<th>IPK Terakhir</th>
					<th>Telepon</th>
					<th>Email</th>
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
			id: 'cnt-search', source: web.host + 'company/search/grid',
			column: [ { }, { }, { }, { }, { } ]
		}
		dt = Func.init_datatable(param);
	});
</script>
</body>
</html>