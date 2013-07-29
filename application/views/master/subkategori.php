<?php
	$array_kategori = $this->Kategori_model->get_array(array( 'limit' => 50 ));
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Subkategori' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Subkategori', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-subkategori" class="table table-striped table-bordered">
					<thead><tr>
						<th>Kategori</th>
						<th>Nama</th>
						<th>Alias</th>
						<th style="width: 75px;">&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
		</div>
		
		<div id="modal-subkategori" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Form Subkategori</h3>
			</div>
			<form class='form-horizontal form-validate' id="form-subkategori">
				<input type="hidden" name="id" value="0" />
				<input type="hidden" name="action" value="update" />
				<input type="submit" class="btn-hidden" hidefocus="true" />
				
				<div class="modal-body">
					<div class="control-group">
						<label for="input-kategori_id" class="control-label">Kategori</label>
						<div class="controls"><select name="kategori_id" id="input-propinsi_id" class="input-xlarge">
							<?php echo ShowOption(array( 'Array' => $array_kategori, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
						</select></div>
					</div>
					<div class="control-group">
						<label for="input-nama" class="control-label">Nama</label>
						<div class="controls"><input type="text" name="nama" id="input-nama" class="input-xlarge" data-rule-required="true" maxlength="40" /></div>
					</div>
					<div class="control-group">
						<label for="input-alias" class="control-label">Alias</label>
						<div class="controls"><input type="text" name="alias" id="input-alias" class="input-xlarge" readonly="readonly" /></div>
					</div>
					<div class="control-group">
						<label for="input-tag" class="control-label">Tag</label>
						<div class="controls"><input type="text" name="tag" id="input-tag" class="input-xlarge tagsinput" /></div>
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
			id: 'cnt-subkategori',
			source: web.host + 'master/subkategori/grid',
			column: [ { }, { }, { }, { bSortable: false, sClass: "center" } ],
			init: function() {
				$('#cnt-subkategori_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn btn-small btn-add">Tambah</button></div>');
				$('#cnt-subkategori_length .btn-add').click(function() {
					$('#modal-subkategori form')[0].reset()
					$('#modal-subkategori [name="id"]').val(0);
					$('#modal-subkategori [name="tag"]').importTags('');
					$('#modal-subkategori').modal();
				});
			},
			callback: function() {
				$('#cnt-subkategori .edit').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					Func.ajax({ url: web.host + 'master/subkategori/action', param: { action: 'get_by_id', id: record.id }, callback: function(result) {
						$('#modal-subkategori [name="id"]').val(result.id);
						$('#modal-subkategori [name="nama"]').val(result.nama);
						$('#modal-subkategori [name="alias"]').val(result.alias);
						$('#modal-subkategori [name="kategori_id"]').val(result.kategori_id);
						$('#modal-subkategori [name="tag"]').importTags(result.tag);
						
						$('#modal-subkategori').modal();
					} });
				});
				
				$('#cnt-subkategori .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
                    Func.confirm_delete({
                        data: { action: 'delete', id: record.id },
                        url: web.host + 'master/subkategori/action', callback: function() { dt.reload(); }
                    });
				});
			}
		}
		dt = Func.init_datatable(param);
		
		// form
		$('[name="nama"]').keyup(function() {
			var alias = Func.GetName($(this).val());
			$('[name="alias"]').val(alias);
		});
		
		/*	Modal */
		$('#modal-subkategori .modal-footer .modal-close').click(function() { $('#modal-subkategori').modal('hide'); });
		$('#modal-subkategori .modal-footer .modal-submit').click(function() { $('#modal-subkategori').find('form').submit(); });
		$('#modal-subkategori form').submit(function() {
			if (! $('#modal-subkategori form').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('modal-subkategori form');
			param.action = 'update';
			Func.ajax({ url: web.host + 'master/subkategori/action', param: param, callback: function(result) {
				Func.show_notice({ text: result.message });
				if (result.status == 1) {
					dt.reload();
					$('#modal-subkategori').modal('hide');
				}
			} });
			
			return false;
		});
	});
</script>
</body>
</html>