<?php
	$seeker = $this->Seeker_model->get_session();
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Surat Lamaran' ) ); ?>
<body data-layout="fixed">
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Surat Lamaran', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="hide">
				<div class="cnt-seeker"><?php echo json_encode($seeker); ?></div>
			</div>
			
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-lamaran" class="table table-striped table-bordered">
					<thead><tr>
						<th>Nama Surat</th>
						<th style="width: 75px;">&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
		</div>
		
		<div id="modal-lamaran" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Form Surat Lamaran</h3>
			</div>
			<form class='form-horizontal form-validate' id="form-lamaran">
				<input type="hidden" name="id" value="0" />
				<input type="hidden" name="seeker_id" value="0" />
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
							<textarea name="content" id="input-content1" class="tinymce span9" style="height: 350px;"></textarea>
						</div>
					</div>
				</div>
			</form>
			<div class="modal-footer">
				<button class="btn modal-close" data-dismiss="modal" aria-hidden="true">Close</button>
				<button class="btn modal-submit btn-primary" data-dismiss="modal">Save changes</button>
			</div>
		</div>
	</div></div></div></div></div>
</div>
<script>
	$(document).ready(function() {
		var dt = null;
		var seeker = Func.get_seeker();
		
		var param = {
			id: 'cnt-lamaran',
			source: web.host + 'seeker/lamaran/grid',
			column: [ { }, { bSortable: false, sClass: "center" } ],
			init: function() {
				$('#cnt-lamaran_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn btn-small btn-add">Tambah</button></div>');
				$('#cnt-lamaran_length .btn-add').click(function() {
					$('#modal-lamaran form')[0].reset()
					$('#modal-lamaran [name="id"]').val(0);
					$('#modal-lamaran [name="seeker_id"]').val(seeker.id);
					$('#modal-lamaran').modal();
				});
			},
			callback: function() {
				$('#cnt-lamaran .edit').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					$('#modal-lamaran [name="id"]').val(record.id);
					$('#modal-lamaran [name="seeker_id"]').val(record.seeker_id);
					$('#modal-lamaran [name="nama"]').val(record.nama);
					$('#modal-lamaran [name="content"]').val(record.content_html);
					$('#modal-lamaran').modal();
				});
				
				$('#cnt-lamaran .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
                    Func.confirm_delete({
                        data: { action: 'delete', id: record.id },
                        url: web.host + 'seeker/lamaran/action', callback: function() { dt.reload(); }
                    });
				});
			}
		}
		dt = Func.init_datatable(param);
		
		/*	Modal */
		$('#modal-lamaran .modal-footer .modal-close').click(function() { $('#modal-lamaran').modal('hide'); });
		$('#modal-lamaran .modal-footer .modal-submit').click(function() { $('#modal-lamaran').find('form').submit(); });
		$('#modal-lamaran form').submit(function() {
			if (! $('#modal-lamaran form').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('modal-lamaran form');
			param.action = 'update';
			Func.ajax({ url: web.host + 'seeker/lamaran/action', param: param, callback: function(result) {
				if (result.status == 1) {
					dt.reload();
					$('#modal-lamaran').modal('hide');
					Func.show_notice({ text: result.message });
				} else {
					Func.show_notice({ text: result.message });
				}
			} });
			
			return false;
		});
	});
</script>
</body>
</html>