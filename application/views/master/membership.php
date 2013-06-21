<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Membership' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Membership', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-membership" class="table table-striped table-bordered">
					<thead><tr>
						<th>Waktu</th>
						<th>Post</th>
						<th>Harga</th>
						<th style="width: 75px;">&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
		</div>
		
		<div id="modal-membership" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Form Membership</h3>
			</div>
			<form class='form-horizontal form-validate' id="form-membership">
				<input type="hidden" name="id" value="0" />
				<input type="hidden" name="action" value="update" />
				<input type="submit" class="btn-hidden" hidefocus="true" />
				
				<div class="modal-body">
					<div class="control-group">
						<label for="input-date_count" class="control-label">Waktu</label>
						<div class="controls"><input type="text" name="date_count" id="input-date_count" class="input-xlarge" data-rule-required="true" maxlength="20" /></div>
					</div>
					<div class="control-group">
						<label for="input-post_count" class="control-label">Post</label>
						<div class="controls"><input type="text" name="post_count" id="input-post_count" class="input-xlarge" data-rule-required="true" maxlength="20" /></div>
					</div>
					<div class="control-group">
						<label for="input-price" class="control-label">Harga</label>
						<div class="controls"><input type="text" name="price" id="input-price" class="input-xlarge" data-rule-required="true" maxlength="20" /></div>
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
			id: 'cnt-membership',
			source: web.host + 'master/membership/grid',
			column: [ { }, { }, { }, { bSortable: false, sClass: "center" } ],
			init: function() {
				$('#cnt-membership_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn btn-small btn-add">Tambah</button></div>');
				$('#cnt-membership_length .btn-add').click(function() {
					$('#modal-membership form')[0].reset()
					$('#modal-membership [name="id"]').val(0);
					$('#modal-membership').modal();
				});
			},
			callback: function() {
				$('#cnt-membership .edit').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					$('#modal-membership [name="id"]').val(record.id);
					$('#modal-membership [name="date_count"]').val(record.date_count);
					$('#modal-membership [name="post_count"]').val(record.post_count);
					$('#modal-membership [name="price"]').val(record.price);
					$('#modal-membership').modal();
				});
				
				$('#cnt-membership .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
                    Func.confirm_delete({
                        data: { action: 'delete', id: record.id },
                        url: web.host + 'master/membership/action', callback: function() { dt.reload(); }
                    });
				});
			}
		}
		dt = Func.init_datatable(param);
		
		/*	Modal */
		$('#modal-membership .modal-footer .modal-close').click(function() { $('#modal-membership').modal('hide'); });
		$('#modal-membership .modal-footer .modal-submit').click(function() { $('#modal-membership').find('form').submit(); });
		$('#modal-membership form').submit(function() {
			if (! $('#modal-membership form').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('modal-membership form');
			param.action = 'update';
			Func.ajax({ url: web.host + 'master/membership/action', param: param, callback: function(result) {
				Func.show_notice({ text: result.message });
				if (result.status == 1) {
					dt.reload();
					$('#modal-membership').modal('hide');
				}
			} });
			
			return false;
		});
	});
</script>
</body>
</html>