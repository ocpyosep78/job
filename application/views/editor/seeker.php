<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Pelamar' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Pelamar', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-seeker" class="table table-striped table-bordered">
					<thead><tr>
						<th>No</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th style="width: 75px;">&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
		</div>
		
		<div id="modal-seeker" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Form Pelamar</h3>
			</div>
			<form class='form-horizontal form-validate' id="form-seeker">
				<input type="hidden" name="id" value="0" />
				<input type="submit" class="btn-hidden" hidefocus="true" />
				
				<div class="modal-body">
					<div class="control-group">
						<label for="input-seeker_no" class="control-label">No</label>
						<div class="controls"><input type="text" name="seeker_no" id="input-seeker_no" class="input-xlarge" maxlength="50" /></div>
					</div>
					<div class="control-group">
						<label for="input-first_name" class="control-label">First Name</label>
						<div class="controls"><input type="text" name="first_name" id="input-first_name" class="input-xlarge" data-rule-required="true" maxlength="50" /></div>
					</div>
					<div class="control-group">
						<label for="input-last_name" class="control-label">Last Name</label>
						<div class="controls"><input type="text" name="last_name" id="input-last_name" class="input-xlarge" maxlength="50" /></div>
					</div>
					<div class="control-group">
						<label for="input-email" class="control-label">Email</label>
						<div class="controls"><input type="text" name="email" id="input-email" class="input-xlarge" data-rule-required="true" data-rule-email="true" /></div>
					</div>
					<div class="control-group">
						<label for="input-tempat_lahir" class="control-label">Tempat Lahir</label>
						<div class="controls"><input type="text" name="tempat_lahir" id="input-tempat_lahir" class="input-xlarge" /></div>
					</div>
					<div class="control-group">
						<label for="input-tgl_lahir" class="control-label">Tanggal Lahir</label>
						<div class="controls"><input type="text" name="tgl_lahir" id="input-tgl_lahir" class="input-xlarge datepick" /></div>
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
			id: 'cnt-seeker',
			source: web.host + 'editor/seeker/grid',
			column: [ { }, { }, { }, { }, { bSortable: false, sClass: "center" } ],
			init: function() {
				$('#cnt-seeker_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn btn-small btn-add">Tambah</button></div>');
				$('#cnt-seeker_length .btn-add').click(function() {
					$('#modal-seeker form')[0].reset()
					$('#modal-seeker [name="id"]').val(0);
					$('#modal-seeker').modal();
				});
			},
			callback: function() {
				$('#cnt-seeker .edit').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					$('#modal-seeker [name="id"]').val(record.id);
					$('#modal-seeker [name="seeker_no"]').val(record.seeker_no);
					$('#modal-seeker [name="first_name"]').val(record.first_name);
					$('#modal-seeker [name="last_name"]').val(record.last_name);
					$('#modal-seeker [name="email"]').val(record.email);
					$('#modal-seeker [name="tempat_lahir"]').val(record.tempat_lahir);
					$('#modal-seeker [name="tgl_lahir"]').val(Func.SwapDate(record.tgl_lahir));
					$('#modal-seeker [name="address"]').val(record.address);
					$('#modal-seeker [name="passwd"]').val('');
					$('#modal-seeker').modal();
				});
				
				$('#cnt-seeker .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
                    Func.confirm_delete({
                        data: { action: 'delete', id: record.id },
                        url: web.host + 'editor/seeker/action', callback: function() { dt.reload(); }
                    });
				});
			}
		}
		dt = Func.init_datatable(param);
		
		/*	Modal */
		$('#modal-seeker .modal-footer .modal-close').click(function() { $('#modal-seeker').modal('hide'); });
		$('#modal-seeker .modal-footer .modal-submit').click(function() { $('#modal-seeker').find('form').submit(); });
		$('#modal-seeker form').submit(function() {
			if (! $('#modal-seeker form').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('modal-seeker form');
			param.action = 'update';
			param.tgl_lahir = Func.SwapDate(param.tgl_lahir);
			
			Func.ajax({ url: web.host + 'editor/seeker/action', param: param, callback: function(result) {
				if (result.status == 1) {
					dt.reload();
					$('#modal-seeker').modal('hide');
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