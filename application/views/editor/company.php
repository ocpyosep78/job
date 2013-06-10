<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Perusahaan' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Perusahaan', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-company" class="table table-striped table-bordered">
					<thead><tr>
						<th>Nama</th>
						<th>Telepon</th>
						<th>Email</th>
						<th>Website</th>
						<th style="width: 75px;">&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
		</div>
		
		<div id="modal-company" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Form Perusahaan</h3>
			</div>
			<form class='form-horizontal form-validate' id="form-company">
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
						<label for="input-phone" class="control-label">Telepon</label>
						<div class="controls"><input type="text" name="phone" id="input-phone" class="input-xlarge" /></div>
					</div>
					<div class="control-group">
						<label for="input-faximile" class="control-label">Faximile</label>
						<div class="controls"><input type="text" name="faximile" id="input-faximile" class="input-xlarge" /></div>
					</div>
					<div class="control-group">
						<label for="input-website" class="control-label">Website</label>
						<div class="controls"><input type="text" name="website" id="input-website" class="input-xlarge" /></div>
					</div>
					<div class="control-group">
						<label for="input-address" class="control-label">Alamat</label>
						<div class="controls"><textarea name="address" id="input-address" class="span9"></textarea></div>
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
			id: 'cnt-company',
			source: web.host + 'editor/company/grid',
			column: [ { }, { }, { }, { }, { bSortable: false, sClass: "center" } ],
			init: function() {
				$('#cnt-company_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn btn-small btn-add">Tambah</button></div>');
				$('#cnt-company_length .btn-add').click(function() {
					$('#modal-company form')[0].reset()
					$('#modal-company [name="id"]').val(0);
					$('#modal-company').modal();
				});
			},
			callback: function() {
				$('#cnt-company .edit').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					$('#modal-company [name="id"]').val(record.id);
					$('#modal-company [name="nama"]').val(record.nama);
					$('#modal-company [name="email"]').val(record.email);
					$('#modal-company [name="phone"]').val(record.phone);
					$('#modal-company [name="faximile"]').val(record.faximile);
					$('#modal-company [name="website"]').val(record.website);
					$('#modal-company [name="address"]').val(record.address);
					$('#modal-company [name="passwd"]').val('');
					$('#modal-company').modal();
				});
				
				$('#cnt-company .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
                    Func.confirm_delete({
                        data: { action: 'delete', id: record.id },
                        url: web.host + 'editor/company/action', callback: function() { dt.reload(); }
                    });
				});
			}
		}
		dt = Func.init_datatable(param);
		
		/*	Modal */
		$('#modal-company .modal-footer .modal-close').click(function() { $('#modal-company').modal('hide'); });
		$('#modal-company .modal-footer .modal-submit').click(function() { $('#modal-company').find('form').submit(); });
		$('#modal-company form').submit(function() {
			if (! $('#modal-company form').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('modal-company form');
			param.action = 'update';
			Func.ajax({ url: web.host + 'editor/company/action', param: param, callback: function(result) {
				if (result.status == 1) {
					dt.reload();
					$('#modal-company').modal('hide');
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