<?php
	$editor = $this->Editor_model->get_session();
	$array_article_status = $this->Article_Status_model->get_array();
	$array_kategori = $this->Kategori_model->get_array(array( 'limit' => 100 ));
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Article' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Article', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="hide">
				<div class="cnt-editor"><?php echo json_encode($editor); ?></div>
				<iframe name="article_photo" src="<?php echo base_url('panel/upload?callback=article_image'); ?>"></iframe>
			</div>
			
			<div class="row-fluid" id="grid-article"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-article" class="table table-striped table-bordered">
					<thead><tr>
						<th>Nama</th>
						<th>Sub Kategori</th>
						<th>Status</th>
						<th>Publish Date</th>
						<th style="width: 75px;">&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
			
			<form class='form-horizontal form-validate hide' id="form-article" style="position: relative;">
				<input type="hidden" name="id" value="0" />
				<input type="hidden" name="editor_id" value="0" />
				<input type="hidden" name="photo" value="" />
				
				<div class="control-group">
					<label for="input-nama" class="control-label">Judul</label>
					<div class="controls"><input type="text" name="nama" id="input-nama" class="input-xxlarge" data-rule-required="true" maxlength="50" /></div>
				</div>
				<div class="control-group">
					<label for="input-alias" class="control-label">Alias</label>
					<div class="controls"><input type="text" name="alias" id="input-alias" class="input-xxlarge" data-rule-required="true" maxlength="50" readonly="readonly" /></div>
				</div>
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
				<div class="control-group">
					<label for="input-article_url" class="control-label">Artikel URL</label>
					<div class="controls"><input type="text" name="article_url" id="input-article_url" class="input-xxlarge" /></div>
				</div>
				<div class="control-group">
					<label for="input-article_desc_1" class="control-label">Description 1</label>
					<div class="controls"><textarea name="article_desc_1" id="input-article_desc_1" class="tinymce" style="width: 800px; height: 300px;"></textarea></div>
				</div>
				<div class="control-group">
					<label for="input-article_desc_2" class="control-label">Description 2</label>
					<div class="controls"><textarea name="article_desc_2" id="input-article_desc_2" class="tinymce" style="width: 800px; height: 300px;"></textarea></div>
				</div>
				<div class="control-group">
					<label for="input-article_desc_3" class="control-label">Description 3</label>
					<div class="controls"><textarea name="article_desc_3" id="input-article_desc_3" class="tinymce" style="width: 800px; height: 300px;"></textarea></div>
				</div>
				<div class="control-group">
					<label for="input-image_piracy" class="control-label">Image Piracy</label>
					<div class="controls"><input type="text" name="image_piracy" id="input-image_piracy" class="input-xxlarge" /></div>
				</div>
				<div class="control-group">
					<label for="input-article_status_id" class="control-label">Status</label>
					<div class="controls"><select name="article_status_id" id="input-article_status_id" class="input-xxlarge">
						<?php echo ShowOption(array( 'Array' => $array_article_status, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
					</select></div>
				</div>
				<div class="control-group">
					<label for="input-publish_date" class="control-label">Publish Date</label>
					<div class="controls"><input type="text" name="publish_date" id="input-publish_date" class="input-xxlarge" /></div>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-primary save">Save changes</button>
					<button type="button" class="btn">Cancel</button>
				</div>
				
				<div style="position: absolute; top: 0px; right: 20px;">
					<div style="width: 200px; text-align: center;">
						<img class="article-photo" src="http://localhost/job/trunk/static/theme/flat/img/demo/user-avatar.jpg" style="width: 188px; height: 116px;">
						<div style="padding: 10px 0 0 0;"><button type="button" class="btn btn-success article-browse">Upload Image</button></div>
					</div>
				</div>
			</form>
		</div>
	</div></div></div></div></div>
</div>
<script>
	$(document).ready(function() {
		var dt = null;
		var editor = Func.get_editor();
		var page = {
			show_grid: function() {
				$('#form-article').hide();
				$('#grid-article').show();
			},
			show_editor: function() {
				$('#grid-article').hide();
				$('#form-article').show();
			}
		}
		article_image = function(p) {
			$('[name="photo"]').val(p.file_name);
			$('.article-photo').attr('src', p.file_link);
		}
		
		var param = {
			id: 'cnt-article',
			source: web.host + 'editor/article/grid',
			column: [ { }, { }, { }, { }, { bSortable: false, sClass: "center" } ],
			init: function() {
				$('#cnt-article_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn btn-small btn-add">Tambah</button></div>');
				$('#cnt-article_length .btn-add').click(function() {
					$('#form-article')[0].reset();
					$('#form-article [name="id"]').val(0);
					$('#form-article [name="editor_id"]').val(editor.id);
					$('#form-article [name="photo"]').val('');
					$('#form-article [name="kategori_id"]').val('');
					$('#form-article [name="subkategori_id"]').val('');
					$('#form-article [name="article_status_id"]').val('');
					
					page.show_editor();
				});
			},
			callback: function() {
				$('#cnt-article .edit').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var temp = ' + raw_record);
					Func.ajax({ url: web.host + 'editor/article/action', param: { action: 'get_by_id', id: temp.id }, callback: function(record) {
						$('#form-article [name="id"]').val(record.id);
						$('#form-article [name="editor_id"]').val(record.editor_id);
						$('#form-article [name="kategori_id"]').val(record.kategori_id);
						$('#form-article [name="article_status_id"]').val(record.article_status_id);
						$('#form-article [name="nama"]').val(record.nama);
						$('#form-article [name="alias"]').val(record.alias);
						$('#form-article [name="photo"]').val(record.photo);
						$('#form-article [name="article_url"]').val(record.article_url);
						$('#form-article [name="article_desc_1"]').val(record.article_desc_1);
						$('#form-article [name="article_desc_2"]').val(record.article_desc_2);
						$('#form-article [name="article_desc_3"]').val(record.article_desc_3);
						$('#form-article [name="image_piracy"]').val(record.image_piracy);
						$('#form-article [name="publish_date"]').val(record.publish_date);
						
						// set subkategori
						combo.subkategori({ kategori_id: record.kategori_id, target: $('[name="subkategori_id"]'), callback: function() { $('[name="subkategori_id"]').val(record.subkategori_id); } });
					} });
					page.show_editor();
				});
				
				$('#cnt-article .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
                    Func.confirm_delete({
                        data: { action: 'delete', id: record.id },
                        url: web.host + 'editor/article/action', callback: function() { dt.reload(); }
                    });
				});
			}
		}
		dt = Func.init_datatable(param);
		
		// form
		$('[name="nama"]').keyup(function() {
			var alias = Func.GetName($(this).val());
			$('[name="alias"]').val(alias);
		});
		$('[name="kategori_id"]').change(function() {
			combo.subkategori({ kategori_id: $('[name="kategori_id"]').val(), target: $('[name="subkategori_id"]') })
		});
		$('.article-browse').click(function() { window.article_photo.browse() });
		
		/*	Modal */
		$('#form-article .form-close').click(function() { page.show_grid() });
		$('#form-article .form-submit').click(function() { $('#form-article').submit(); });
		$('#form-article').submit(function() {
			if (! $('#form-article').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('form-article');
			param.action = 'update';
			Func.ajax({ url: web.host + 'editor/article/action', param: param, callback: function(result) {
				Func.show_notice({ text: result.message });
				if (result.status == 1) {
					dt.reload();
					page.show_grid();
				}
			} });
			
			return false;
		});
	});
</script>
</body>
</html>