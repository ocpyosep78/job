<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Widget' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Widget', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-widget" class="table table-striped table-bordered">
					<thead><tr>
						<th>Nama</th>
						<th style="width: 75px;">&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
		</div>
		
		<div id="modal-widget" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="myModalLabel">Form Widget</h3>
			</div>
			<form class='form-horizontal form-validate' id="form-widget">
				<input type="hidden" name="id" value="0" />
				<input type="hidden" name="is_html" value="0" />
				
				<div class="modal-body">
					<div class="control-group">
						<label for="input-nama" class="control-label">Nama</label>
						<div class="controls">
							<input type="text" name="nama" id="input-nama" class="input-xlarge" data-rule-required="true" maxlength="20" />
						</div>
					</div>
					<div class="control-group">
						<label for="input-alias" class="control-label">Alias</label>
						<div class="controls">
							<input type="text" name="alias" id="input-alias" class="input-xlarge" data-rule-required="true" readonly="readonly" />
						</div>
					</div>
					<div class="control-group">
						<label for="input-content1" class="control-label">Content</label>
						<div class="controls cnt-raw">
							<textarea name="content_raw" id="input-content1" class="span9" style="height: 350px;"></textarea>
						</div>
						<div class="controls cnt-html">
							<textarea name="content_html" id="input-content2" class="span9 tinymce" style="height: 350px;"></textarea>
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
			id: 'cnt-widget',
			source: web.host + 'editor/widget/grid',
			column: [ { }, { bSortable: false, sClass: "center" } ],
			init: function() {
				$('#cnt-widget_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn btn-small btn-add">Tambah</button></div>');
				$('#cnt-widget_length .btn-add').click(function() {
					$('#modal-widget .cnt-raw').hide();
					$('#modal-widget .cnt-html').show();
					
					$('#modal-widget form')[0].reset();
					$('#modal-widget [name="id"]').val(0);
					$('#modal-widget [name="is_html"]').val(1);
					$('#modal-widget').modal();
				});
			},
			callback: function() {
				$('#cnt-widget .edit').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					$('#modal-widget [name="id"]').val(record.id);
					$('#modal-widget [name="nama"]').val(record.nama);
					$('#modal-widget [name="alias"]').val(record.alias);
					$('#modal-widget [name="is_html"]').val(record.is_html);
					
					if (record.is_html == 1) {
						$('#modal-widget .cnt-raw').hide();
						$('#modal-widget .cnt-html').show();
						$('#modal-widget [name="content_html"]').val(record.content_html);
					} else {
						$('#modal-widget .cnt-raw').show();
						$('#modal-widget .cnt-html').hide();
						$('#modal-widget [name="content_raw"]').val(record.content);
					}
					
					$('#modal-widget').modal();
				});
				
				$('#cnt-widget .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
                    Func.confirm_delete({
                        data: { action: 'delete', id: record.id },
                        url: web.host + 'editor/widget/action', callback: function() { dt.reload(); }
                    });
				});
			}
		}
		dt = Func.init_datatable(param);
		
		/*	Modal */
		$('[name="nama"]').keyup(function() {
			var alias = Func.GetName($(this).val());
			$('[name="alias"]').val(alias);
		});
		$('#modal-widget .modal-footer .modal-close').click(function() { $('#modal-widget').modal('hide'); });
		$('#modal-widget .modal-footer .modal-submit').click(function() { $('#modal-widget').find('form').submit(); });
		$('#modal-widget form').submit(function() {
			if (! $('#modal-widget form').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('modal-widget form');
			param.action = 'update';
			
			// content
			if (param.is_html == 1) {
				param.content = $('#modal-widget [name="content_html"]').val();
			} else {
				param.content = $('#modal-widget [name="content_raw"]').val();
			}
			
			Func.ajax({ url: web.host + 'editor/widget/action', param: param, callback: function(result) {
				if (result.status == 1) {
					dt.reload();
					$('#modal-widget').modal('hide');
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