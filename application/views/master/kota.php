<?php
	$array_propinsi = $this->Propinsi_model->get_array(array( 'negara_id' => NEGARA_INDONESIA_ID, 'limit' => 50 ));
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Kota' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Kota', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-kota" class="table table-striped table-bordered">
					<thead><tr>
						<th>Propinsi</th>
						<th>Kota</th>
						<th style="width: 75px;">&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
		</div>
		
		<div id="modal-kota" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Form Kota</h3>
			</div>
			<form class='form-horizontal form-validate' id="form-kota">
				<input type="hidden" name="id" value="0" />
				<input type="hidden" name="action" value="update" />
				<input type="submit" class="btn-hidden" hidefocus="true" />
				
				<div class="modal-body">
					<div class="control-group">
						<label for="input-propinsi_id" class="control-label">Propinsi</label>
						<div class="controls"><select name="propinsi_id" id="input-propinsi_id" class="input-xlarge">
							<?php echo ShowOption(array( 'Array' => $array_propinsi, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
						</select></div>
					</div>
					<div class="control-group">
						<label for="input-nama" class="control-label">Nama</label>
						<div class="controls"><input type="text" name="nama" id="input-nama" class="input-xlarge" data-rule-required="true" maxlength="20" /></div>
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
		
		var param = {
			id: 'cnt-kota',
			source: web.host + 'master/kota/grid',
			column: [ { }, { }, { bSortable: false, sClass: "center" } ],
			init: function() {
				$('#cnt-kota_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn btn-small btn-add">Tambah</button></div>');
				$('#cnt-kota_length .btn-add').click(function() {
					$('#modal-kota form')[0].reset()
					$('#modal-kota [name="id"]').val(0);
					$('#modal-kota').modal();
				});
			},
			callback: function() {
				$('#cnt-kota .edit').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					$('#modal-kota [name="id"]').val(record.id);
					$('#modal-kota [name="propinsi_id"]').val(record.propinsi_id);
					$('#modal-kota [name="nama"]').val(record.nama);
					$('#modal-kota').modal();
				});
				
				$('#cnt-kota .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
                    Func.confirm_delete({
                        data: { action: 'delete', id: record.id },
                        url: web.host + 'master/kota/action', callback: function() { dt.reload(); }
                    });
				});
			}
		}
		dt = Func.init_datatable(param);
		
		/*	Modal */
		$('#modal-kota .modal-footer .modal-close').click(function() { $('#modal-kota').modal('hide'); });
		$('#modal-kota .modal-footer .modal-submit').click(function() { $('#modal-kota').find('form').submit(); });
		$('#modal-kota form').submit(function() {
			if (! $('#modal-kota form').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('modal-kota form');
			param.action = 'update';
			Func.ajax({ url: web.host + 'master/kota/action', param: param, callback: function(result) {
				Func.show_notice({ text: result.message });
				if (result.status == 1) {
					dt.reload();
					$('#modal-kota').modal('hide');
				}
			} });
			
			return false;
		});
	});
</script>
</body>
</html>