<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Kategori' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Kategori', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-kategori" class="table table-striped table-bordered">
					<thead><tr>
						<th>Nama</th>
						<th>Alias</th>
						<th style="width: 75px;">&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
		</div>
		
		<div id="modal-kategori" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Form Kategori</h3>
			</div>
			<form class='form-horizontal form-validate' id="form-kategori">
				<input type="hidden" name="id" value="0" />
				<input type="hidden" name="action" value="update" />
				<input type="submit" class="btn-hidden" hidefocus="true" />
				
				<div class="modal-body">
					<div class="control-group">
						<label for="input-nama" class="control-label">Nama</label>
						<div class="controls"><input type="text" name="nama" id="input-nama" class="input-xlarge" data-rule-required="true" maxlength="20" /></div>
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
			id: 'cnt-kategori',
			source: web.host + 'master/kategori/grid',
			column: [ { }, { }, { bSortable: false, sClass: "center" } ],
			init: function() {
				$('#cnt-kategori_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn btn-small btn-add">Tambah</button></div>');
				$('#cnt-kategori_length .btn-add').click(function() {
					$('#modal-kategori form')[0].reset()
					$('#modal-kategori [name="id"]').val(0);
					$('#modal-kategori').modal();
				});
			},
			callback: function() {
				$('#cnt-kategori .edit').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					Func.ajax({ url: web.host + 'master/kategori/action', param: { action: 'get_by_id', id: record.id }, callback: function(result) {
						$('#modal-kategori [name="id"]').val(result.id);
						$('#modal-kategori [name="nama"]').val(result.nama);
						$('#modal-kategori [name="alias"]').val(result.alias);
						$('#modal-kategori [name="tag"]').importTags(result.tag);
						
						$('#modal-kategori').modal();
					} });
				});
				
				$('#cnt-kategori .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
                    Func.confirm_delete({
                        data: { action: 'delete', id: record.id },
                        url: web.host + 'master/kategori/action', callback: function() { dt.reload(); }
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
		$('#modal-kategori .modal-footer .modal-close').click(function() { $('#modal-kategori').modal('hide'); });
		$('#modal-kategori .modal-footer .modal-submit').click(function() { $('#modal-kategori').find('form').submit(); });
		$('#modal-kategori form').submit(function() {
			if (! $('#modal-kategori form').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('modal-kategori form');
			param.action = 'update';
			Func.ajax({ url: web.host + 'master/kategori/action', param: param, callback: function(result) {
				Func.show_notice({ text: result.message });
				if (result.status == 1) {
					dt.reload();
					$('#modal-kategori').modal('hide');
				}
			} });
			
			return false;
		});
	});
</script>
</body>
</html>