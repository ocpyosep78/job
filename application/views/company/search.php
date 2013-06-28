<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Find Resume' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Find Resume', 'class' => 'icon-reorder' ) ); ?>
		
		<div id="modal-mail" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Form Message</h3>
			</div>
			<form class='form-horizontal form-validate' id="form-mail">
				<input type="submit" class="btn-hidden" hidefocus="true" />
				
				<div class="modal-body">
					<div class="control-group">
						<label for="input-to" class="control-label">To</label>
						<div class="controls"><input type="text" name="to" id="input-to" class="input-xxlarge" data-rule-required="true" maxlength="50" readonly="readonly" /></div>
					</div>
					<div class="control-group">
						<label for="input-subject" class="control-label">Subject</label>
						<div class="controls"><input type="text" name="subject" id="input-subject" class="input-xxlarge" data-rule-required="true" maxlength="50" /></div>
					</div>
					<div class="control-group">
						<label for="input-content" class="control-label">Content</label>
						<div class="controls"><textarea name="content" id="input-content" class="tinymce" style="height: 300px;"></textarea></div>
					</div>
				</div>
			</form>
			<div class="modal-footer">
				<button class="btn modal-close" data-dismiss="modal" aria-hidden="true">Close</button>
				<button class="btn modal-submit btn-primary" data-dismiss="modal">Save changes</button>
			</div>
		</div>
		
		<div class="box-content"><div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
			<table id="cnt-search" class="table table-striped table-bordered">
				<thead><tr>
					<th>No Pelamar</th>
					<th>Nama</th>
					<th>Usia</th>
					<th>Nilai</th>
					<th>Jenjang</th>
					<th>Nama Sekolah</th>
					<th>Kota</th>
					<th>Status</th>
					<th>Pengalaman</th>
					<th style="width: 100px;">&nbsp;</th>
				</tr></thead>
				<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
			</table>
		</div></div></div></div></div>
	</div></div></div></div></div>
</div>
<script>
	$(document).ready(function() {
		var dt = null;
		var param = {
			id: 'cnt-search', source: web.host + 'company/search/grid',
			column: [ { }, { }, { }, { }, { }, { }, { }, { }, { }, { bSortable: false, sClass: "center" } ],
			callback: function() {
				$('#cnt-search .download').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					window.open(record.file_resume_link);
				});
				$('#cnt-search .view').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					window.open(record.seeker_link);
				});
				$('#cnt-search .mail').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					$('#modal-mail [name="to"]').val(record.email);
					$('#modal-mail [name="subject"]').val('');
					$('#modal-mail [name="content"]').val('');
					$('#modal-mail').modal();
				});
			}
		}
		dt = Func.init_datatable(param);
		
		/*	Modal */
		$('#modal-mail .modal-footer .modal-close').click(function() { $('#modal-mail').modal('hide'); });
		$('#modal-mail .modal-footer .modal-submit').click(function() { $('#modal-mail').find('form').submit(); });
		$('#modal-mail form').submit(function() {
			if (! $('#modal-mail form').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('modal-mail form');
			param.action = 'sent_mail';
			Func.ajax({ url: web.host + 'company/search/action', param: param, callback: function(result) {
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