<?php
	$page = array( 'NEGARA_INDONESIA_ID' => NEGARA_INDONESIA_ID );
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Propinsi' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Propinsi', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="hide">
			<div class="cnt-page"><?php echo json_encode($page); ?></div>
		</div>
		
		<div class="box-content">
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-propinsi" class="table table-striped table-bordered">
					<thead><tr>
						<th>Nama</th>
						<th style="width: 75px;">&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
		</div>
		
		<div id="modal-propinsi" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Form Propinsi</h3>
			</div>
			<form class='form-horizontal form-validate' id="form-propinsi">
				<input type="hidden" name="id" value="0" />
				<input type="hidden" name="negara_id" value="0" />
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
	var raw_page = $('.cnt-page').text();
	eval('var page = ' + raw_page);
	
	$(document).ready(function() {
		var dt = null;
		
		var param = {
			id: 'cnt-propinsi',
			source: web.host + 'master/propinsi/grid',
			column: [ { }, { bSortable: false, sClass: "center" } ],
			init: function() {
				$('#cnt-propinsi_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn btn-small btn-add">Tambah</button></div>');
				$('#cnt-propinsi_length .btn-add').click(function() {
					$('#modal-propinsi form')[0].reset()
					$('#modal-propinsi [name="id"]').val(0);
					$('#modal-propinsi [name="negara_id"]').val(page.NEGARA_INDONESIA_ID);
					$('#modal-propinsi').modal();
				});
			},
			callback: function() {
				$('#cnt-propinsi .edit').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					$('#modal-propinsi [name="id"]').val(record.id);
					$('#modal-propinsi [name="negara_id"]').val(record.negara_id);
					$('#modal-propinsi [name="nama"]').val(record.nama);
					$('#modal-propinsi').modal();
				});
				
				$('#cnt-propinsi .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
                    Func.confirm_delete({
                        data: { action: 'delete', id: record.id },
                        url: web.host + 'master/propinsi/action', callback: function() { dt.reload(); }
                    });
				});
			}
		}
		dt = Func.init_datatable(param);
		
		/*	Modal */
		$('#modal-propinsi .modal-footer .modal-close').click(function() { $('#modal-propinsi').modal('hide'); });
		$('#modal-propinsi .modal-footer .modal-submit').click(function() { $('#modal-propinsi').find('form').submit(); });
		$('#modal-propinsi form').submit(function() {
			if (! $('#modal-propinsi form').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('modal-propinsi form');
			param.action = 'update';
			Func.ajax({ url: web.host + 'master/propinsi/action', param: param, callback: function(result) {
				Func.show_notice({ text: result.message });
				if (result.status == 1) {
					dt.reload();
					$('#modal-propinsi').modal('hide');
				}
			} });
			
			return false;
		});
	});
</script>
</body>
</html>