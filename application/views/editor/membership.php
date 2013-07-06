<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Membership' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Membership', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-widget" class="table table-striped table-bordered">
					<thead><tr>
						<th>ID</th>
						<th>Tanggal</th>
						<th>Perusahaan</th>
						<th>Post</th>
						<th>Waktu</th>
						<th>Harga</th>
						<th>Status</th>
						<th>&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
		</div>
		
		<div id="modal-mail" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Form Message</h3>
			</div>
			<form class='form-horizontal form-validate' id="form-mail">
				<input type="hidden" name="action" value="sent_mail" />
				<input type="hidden" name="to" value="" />
				<input type="submit" class="btn-hidden" hidefocus="true" />
				
				<div class="modal-body">
					<div class="control-group">
						<label for="input-title" class="control-label">Judul</label>
						<div class="controls"><input type="text" name="title" id="input-title" class="input-xxlarge" data-rule-required="true" maxlength="50" /></div>
					</div>
					<div class="control-group">
						<label for="input-message" class="control-label">Pesan</label>
						<div class="controls"><textarea name="message" id="input-message" class="span9 tinymce"></textarea></div>
					</div>
				</div>
			</form>
			<div class="modal-footer">
				<button class="btn modal-close" aria-hidden="true">Close</button>
				<button class="btn modal-submit btn-primary">Sent</button>
			</div>
		</div>
	</div></div></div></div></div>
</div>
<script>
	$(document).ready(function() {
		var dt = null;
		
		var param = {
			id: 'cnt-widget', aaSorting: [[0, 'desc']],
			source: web.host + 'editor/membership/grid',
			column: [ { "bSearchable": false, "bVisible": false }, { }, { }, { }, { }, { }, { }, { bSortable: false, sClass: "center", sWidth: "12%" } ],
			callback: function() {
				$('#cnt-widget .mail').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					$('#modal-mail [name="to"]').val(record.company_email);
					$('#modal-mail [name="title"]').val('');
					$('#modal-mail [name="message"]').val('');
					$('#modal-mail').modal();
				});
				
				$('#cnt-widget .confirm').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					bootbox.confirm("Confirm Membership, apa anda yakin ?", function(result) {
						if (! result) {
							return;
						}
						
						var param = { action: 'update', id: record.id, status: 'confirm' };
						Func.ajax({ url: web.host + 'editor/membership/action', param: param, callback: function(result) {
							Func.show_notice({ text: result.message });
							if (result.status == 1) {
								dt.reload();
							}
						} });
					});
				});
				
				$('#cnt-widget .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					bootbox.confirm("Cancel Membership, apa anda yakin ?", function(result) {
						if (! result) {
							return;
						}
						
						var param = { action: 'update', id: record.id, status: 'cancel' };
						Func.ajax({ url: web.host + 'editor/membership/action', param: param, callback: function(result) {
							Func.show_notice({ text: result.message });
							if (result.status == 1) {
								dt.reload();
							}
						} });
					});
				});
			}
		}
		dt = Func.init_datatable(param);
		
		// form message
		$('#modal-mail .modal-footer .modal-close').click(function() { $('#modal-mail').modal('hide'); });
		$('#modal-mail .modal-footer .modal-submit').click(function() { $('#modal-mail').find('form').submit(); });
		$('#modal-mail form').submit(function() {
			if (! $('#modal-mail form').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('modal-mail form');
			Func.ajax({ url: web.host + 'editor/seeker/action', param: param, callback: function(result) {
				Func.show_notice({ text: result.message });
				if (result.status == 1) {
					$('#modal-mail').modal('hide');
				}
			} });
			
			return false;
		});
	});
</script>
</body>
</html>