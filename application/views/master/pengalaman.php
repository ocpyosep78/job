<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Pengalaman' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Pengalaman', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-pengalaman" class="table table-striped table-bordered">
					<thead><tr>
						<th>Nama</th>
						<th style="width: 75px;">&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
		</div>
		
		<div id="modal-pengalaman" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Form Pengalaman</h3>
			</div>
			<form class='form-horizontal form-validate' id="form-pengalaman">
				<input type="hidden" name="id" value="0" />
				<input type="hidden" name="action" value="update" />
				<input type="submit" class="btn-hidden" hidefocus="true" />
				
				<div class="modal-body">
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
			id: 'cnt-pengalaman',
			source: web.host + 'master/pengalaman/grid',
			column: [ { }, { bSortable: false, sClass: "center" } ],
			init: function() {
				$('#cnt-pengalaman_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn btn-small btn-add">Tambah</button></div>');
				$('#cnt-pengalaman_length .btn-add').click(function() {
					$('#modal-pengalaman form')[0].reset()
					$('#modal-pengalaman [name="id"]').val(0);
					$('#modal-pengalaman').modal();
				});
			},
			callback: function() {
				$('#cnt-pengalaman .edit').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					$('#modal-pengalaman [name="id"]').val(record.id);
					$('#modal-pengalaman [name="nama"]').val(record.nama);
					$('#modal-pengalaman').modal();
				});
				
				$('#cnt-pengalaman .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
                    Func.confirm_delete({
                        data: { action: 'delete', id: record.id },
                        url: web.host + 'master/pengalaman/action', callback: function() { dt.reload(); }
                    });
				});
			}
		}
		dt = Func.init_datatable(param);
		
		/*	Modal */
		$('#modal-pengalaman .modal-footer .modal-close').click(function() { $('#modal-pengalaman').modal('hide'); });
		$('#modal-pengalaman .modal-footer .modal-submit').click(function() { $('#modal-pengalaman').find('form').submit(); });
		$('#modal-pengalaman form').submit(function() {
			if (! $('#modal-pengalaman form').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('modal-pengalaman form');
			param.action = 'update';
			Func.ajax({ url: web.host + 'master/pengalaman/action', param: param, callback: function(result) {
				Func.show_notice({ text: result.message });
				if (result.status == 1) {
					dt.reload();
					$('#modal-pengalaman').modal('hide');
				}
			} });
			
			return false;
		});
	});
</script>
</body>
</html>