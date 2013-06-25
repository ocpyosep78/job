<?php $this->load->view( 'panel/common/meta', array( 'title' => 'News' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'News', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-news" class="table table-striped table-bordered">
					<thead><tr>
						<th>Nama</th>
						<th>Content</th>
						<th style="width: 75px;">&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
		</div>
		
		<div id="modal-editor" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Form News</h3>
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
	</div></div></div></div></div>
</div>
<script>
	$(document).ready(function() {
		var dt = null;
		
		var param = {
			id: 'cnt-news',
			source: web.host + 'editor/news/grid',
			column: [ { }, { }, { bSortable: false, sClass: "center" } ],
			callback: function() {
				$('#cnt-news .edit').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					$('#modal-editor [name="id"]').val(record.id);
					$('#modal-editor [name="nama"]').val(record.nama);
					$('#modal-editor [name="content"]').val(record.content_html);
					$('#modal-editor').modal();
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
			Func.ajax({ url: web.host + 'editor/news/action', param: param, callback: function(result) {
				Func.show_notice({ text: result.message });
				
				if (result.status == 1) {
					dt.reload();
					$('#modal-editor').modal('hide');
				}
			} });
			
			return false;
		});
	});
</script>
</body>
</html>