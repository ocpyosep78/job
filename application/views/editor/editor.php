<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Editor' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Editor', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-editor" class="table table-striped table-bordered">
					<thead><tr>
						<th>ID</th>
						<th>Nama</th>
						<th>Email</th>
						<th>&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
		</div>
		
		<div id="modal-editor" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Form Editor</h3>
			</div>
			<form class='form-horizontal form-validate' id="form-editor">
				<input type="hidden" name="id" value="0" />
				<input type="submit" class="btn-hidden" hidefocus="true" />
				
				<div class="modal-body">
					<div class="control-group">
						<label for="input-nama" class="control-label">Nama</label>
						<div class="controls"><input type="text" name="nama" id="input-nama" class="input-xlarge" data-rule-required="true" maxlength="20" /></div>
					</div>
					<div class="control-group">
						<label for="input-email" class="control-label">Email</label>
						<div class="controls"><input type="text" name="email" id="input-email" class="input-xlarge" data-rule-required="true" data-rule-email="true" /></div>
					</div>
					<div class="control-group">
						<label for="input-passwd" class="control-label">Password</label>
						<div class="controls">
							<input type="password" name="passwd" id="input-passwd" class="input-xlarge" />
							<span class="help-block">Biarkan kosong jika tidak diperbaharui.</span>
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
		
		var param = {
			id: 'cnt-editor', aaSorting: [[0, 'desc']],
			source: web.host + 'editor/editor/grid',
			column: [ { "bSearchable": false, "bVisible": false }, { }, { }, { bSortable: false, sClass: "center", sWidth: "10%" } ],
			init: function() {
				$('#cnt-editor_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn btn-small btn-add">Tambah</button></div>');
				$('#cnt-editor_length .btn-add').click(function() {
					$('#modal-editor form')[0].reset()
					$('#modal-editor [name="id"]').val(0);
					$('#modal-editor').modal();
				});
			},
			callback: function() {
				$('#cnt-editor .edit').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					$('#modal-editor [name="id"]').val(record.id);
					$('#modal-editor [name="nama"]').val(record.nama);
					$('#modal-editor [name="email"]').val(record.email);
					$('#modal-editor').modal();
				});
				
				$('#cnt-editor .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
                    Func.confirm_delete({
                        data: { action: 'delete', id: record.id },
                        url: web.host + 'editor/editor/action', callback: function() { dt.reload(); }
                    });
				});
			}
		}
		dt = Func.init_datatable(param);
		
		/*	Modal */
		$('#modal-editor .modal-footer .modal-close').click(function() { $('#modal-editor').modal('hide'); });
		$('#modal-editor .modal-footer .modal-submit').click(function() { $('#modal-editor').find('form').submit(); });
		$('#modal-editor form').submit(function() {
			if (! $('#modal-editor form').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('modal-editor form');
			param.action = 'update';
			Func.ajax({ url: web.host + 'editor/editor/action', param: param, callback: function(result) {
				if (result.status == 1) {
					dt.reload();
					$('#modal-editor').modal('hide');
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