<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Jenis Subscribe' ) ); ?>
<body data-layout="fixed">
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Jenis Subscribe', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-jenis" class="table table-striped table-bordered">
					<thead><tr>
						<th>Nama Surat</th>
						<th style="width: 75px;">&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
		</div>
		
		<div id="modal-jenis" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Form Surat jenis</h3>
			</div>
			<form class='form-horizontal form-validate' id="form-jenis">
				<input type="hidden" name="id" value="0" />
				<div class="modal-body">
					<div class="control-group">
						<label for="input-nama" class="control-label">Judul Surat</label>
						<div class="controls">
							<input type="text" name="nama" id="input-nama" class="input-xlarge" data-rule-required="true" maxlength="20" />
						</div>
					</div>
					<div class="control-group">
						<label for="input-content1" class="control-label">Isi Surat</label>
						<div class="controls">
							<textarea name="content" id="input-content1" class="tinymce span9" style="height: 350px;"></textarea>
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
			id: 'cnt-jenis',
			source: web.host + 'subscribe/jenis_subscribe/grid',
			column: [ { }, { bSortable: false, sClass: "center" } ],
			callback: function() {
				$('#cnt-jenis .mail').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					$('#modal-jenis form')[0].reset();
					$('#modal-jenis [name="id"]').val(record.id);
					$('#modal-jenis').modal();
				});
			}
		}
		dt = Func.init_datatable(param);
		
		/*	Modal */
		$('#modal-jenis .modal-footer .modal-close').click(function() { $('#modal-jenis').modal('hide'); });
		$('#modal-jenis .modal-footer .modal-submit').click(function() { $('#modal-jenis').find('form').submit(); });
		$('#modal-jenis form').submit(function() {
			if (! $('#modal-jenis form').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('modal-jenis form');
			param.action = 'sent_mail';
			Func.ajax({ url: web.host + 'subscribe/jenis_subscribe/action', param: param, callback: function(result) {
				Func.show_notice({ text: result.message });
				if (result.status == 1) {
					dt.reload();
					$('#modal-jenis').modal('hide');
				}
			} });
			
			return false;
		});
	});
</script>
</body>
</html>