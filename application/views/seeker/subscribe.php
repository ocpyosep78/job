<?php
	$seeker = $this->Seeker_model->get_session();
	$array_kategori = $this->Kategori_model->get_array(array( 'limit' => 100 ));
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Subscribe' ) ); ?>
<body data-layout="fixed">
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Subscribe', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="hide">
				<div class="cnt-seeker"><?php echo json_encode($seeker); ?></div>
			</div>
			
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-subscribe" class="table table-striped table-bordered">
					<thead><tr>
						<th>Ketegori</th>
						<th>Sub Ketegori</th>
						<th>&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
		</div>
		
		<div id="modal-subscribe" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Form Subscribe</h3>
			</div>
			<form class='form-horizontal form-validate' id="form-subscribe">
				<input type="hidden" name="id" value="0" />
				<input type="hidden" name="seeker_id" value="0" />
				<input type="hidden" name="action" value="update" />
				
				<div class="modal-body">
					<div class="control-group">
						<label for="input-kategori_id" class="control-label">Kategori</label>
						<div class="controls"><select name="kategori_id" id="input-propinsi_id" class="input-xxlarge">
							<?php echo ShowOption(array( 'Array' => $array_kategori, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
						</select></div>
					</div>
					<div class="control-group">
						<label for="input-subkategori_id" class="control-label">Sub Kategori</label>
						<div class="controls"><select name="subkategori_id" id="input-subkategori_id" class="input-xxlarge" data-rule-required="true">
							<option value="">-</option>
						</select></div>
					</div>
				</div>
			</form>
			<div class="modal-footer">
				<button class="btn modal-close" data-dismiss="modal" aria-hidden="true">Close</button>
				<button class="btn modal-submit btn-primary">Save changes</button>
			</div>
		</div>
	</div></div></div></div></div> 
</div>
<script>
	$(document).ready(function() {
		var dt = null;
		var seeker = Func.get_seeker();
		
		var param = {
			id: 'cnt-subscribe',
			source: web.host + 'seeker/subscribe/grid',
			column: [ { }, { }, { bSortable: false, sClass: "center", sWidth: "10%" } ],
			fnServerParams: function ( aoData ) {
				aoData.push( { "name": "seeker_id", "value": seeker.id } );
			},
			init: function() {
				$('#cnt-subscribe_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn btn-small btn-add">Tambah</button></div>');
				$('#cnt-subscribe_length .btn-add').click(function() {
					$('#modal-subscribe form')[0].reset();
					$('#modal-subscribe [name="id"]').val(0);
					$('#modal-subscribe').modal();
				});
			},
			callback: function() {
				$('#cnt-subscribe .edit').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					$('#modal-subscribe [name="id"]').val(record.id);
					$('#modal-subscribe [name="kategori_id"]').val(record.kategori_id);
					
					combo.subkategori({ kategori_id: record.kategori_id, target: $('[name="subkategori_id"]'), callback: function() { $('[name="subkategori_id"]').val(record.subkategori_id); } });
					
					$('#modal-subscribe').modal();
				});
				
				$('#cnt-subscribe .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
                    Func.confirm_delete({
                        data: { action: 'delete', id: record.id },
                        url: web.host + 'seeker/subscribe/action', callback: function() { dt.reload(); }
                    });
				});
			}
		}
		dt = Func.init_datatable(param);
		
		// form
		$('[name="kategori_id"]').change(function() {
			combo.subkategori({ kategori_id: $('[name="kategori_id"]').val(), target: $('[name="subkategori_id"]') })
		});
		
		/*	Modal */
		$('#modal-subscribe .modal-footer .modal-close').click(function() { $('#modal-subscribe').modal('hide'); });
		$('#modal-subscribe .modal-footer .modal-submit').click(function() { $('#modal-subscribe').find('form').submit(); });
		$('#modal-subscribe form').submit(function() {
			if (! $('#modal-subscribe form').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('modal-subscribe form');
			param.seeker_id = seeker.id;
			Func.ajax({ url: web.host + 'seeker/subscribe/action', param: param, callback: function(result) {
				Func.show_notice({ text: result.message });
				if (result.status == 1) {
					dt.reload();
					$('#modal-subscribe').modal('hide');
				}
			} });
			
			return false;
		});
	});
</script> 
</body>
</html>