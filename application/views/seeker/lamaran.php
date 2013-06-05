<?php $this->load->view( 'panel/common/meta' ); ?>
<body data-layout="fixed">
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Surat Lamaran', 'class' => 'icon-reorder' ) ); ?>
						
		<div class="box-content"><div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
			<table id="cnt-lamaran" class="table table-striped table-bordered">
				<thead><tr>
					<th>Nama Bank</th>
					<th>No Rekening</th>
					<th>Nama Pemilik</th>
					<th style="width: 75px;">&nbsp;</th>
				</tr></thead>
				<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
			</table>
		</div></div></div></div></div>
		
		<div id="modal-lamaran" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Form Surat Lamaran</h3>
			</div>
			<form class='form-horizontal form-validate' id="form-resume">
				<div class="modal-body">
					<div class="control-group">
						<label for="input-nama" class="control-label">Judul Surat</label>
						<div class="controls">
							<input type="text" name="nama" id="input-nama" class="input-xlarge" data-rule-required="true" maxlength="20" />
						</div>
					</div>
					<div class="control-group">
						<label for="input-content1" class="control-label">Isi Surat</label>
						<div class="controls">
							<textarea name="content" id="input-content1" class="tinymce span9" style="height: 400px;"></textarea>
						</div>
					</div>
				</div>
			</form>
			<div class="modal-footer">
				<button class="btn close" data-dismiss="modal" aria-hidden="true">Close</button>
				<button class="btn submit btn-primary" data-dismiss="modal">Save changes</button>
			</div>
		</div>
	</div></div></div></div></div>
</div>
<script>
	$(document).ready(function() {
		$('#cnt-lamaran').dataTable( {
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
				$('#cnt-lamaran .edit').click(function() { console.log('click'); });
				$('#cnt-lamaran .delete').click(function() { console.log('delete'); });
				console.log( 'DataTables has redrawn the table' );
			}
		} );
		
		$('#cnt-lamaran_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn btn-small btn-add">Tambah</button></div>');
		$('#cnt-lamaran_wrapper input').attr("placeholder", "Search here...");
		$("#cnt-lamaran_wrapper select").wrap("<div class='input-mini'></div>").chosen({ disable_search_threshold: 9999999 });
		
		/* Modal */
		$('#cnt-lamaran_length .btn-add').click(function() { $('#modal-lamaran').modal(); });
		$('#modal-lamaran .modal-footer .close').click(function() { $('#modal-lamaran').modal('hide'); });
		$('#modal-lamaran .modal-footer .submit').click(function() { $('#modal-lamaran').find('form').submit(); });
		
		$('#form-resume').submit(function() {
			
		});
	});
</script>
</body>
</html>