<?php
	$editor = $this->Editor_model->get_session();
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Event' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Event', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="hide">
				<div class="cnt-editor"><?php echo json_encode($editor); ?></div>
				<iframe name="event_photo" src="<?php echo base_url('panel/upload?callback=event_image'); ?>"></iframe>
			</div>
			
			<div class="row-fluid" id="grid-event"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-event" class="table table-striped table-bordered">
					<thead><tr>
						<th>Nama</th>
						<th>Lokasi</th>
						<th>Waktu</th>
						<th>Publish Date</th>
						<th style="width: 75px;">&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
			
			<form class='form-horizontal form-validate hide' id="form-event" style="position: relative;">
				<input type="hidden" name="id" value="0" />
				<input type="hidden" name="editor_id" value="0" />
				<input type="hidden" name="photo" value="" />
				
				<div class="control-group">
					<label for="input-nama" class="control-label">Judul</label>
					<div class="controls"><input type="text" name="nama" id="input-nama" class="input-xxlarge" data-rule-required="true" maxlength="50" /></div>
				</div>
				<div class="control-group">
					<label for="input-alias" class="control-label">Alias</label>
					<div class="controls"><input type="text" name="alias" id="input-alias" class="input-xxlarge" readonly="readonly" /></div>
				</div>
				<div class="control-group">
					<label for="input-photo_desc" class="control-label">Judul Gambar</label>
					<div class="controls"><input type="text" name="photo_desc" id="input-photo_desc" class="input-xxlarge" maxlength="50" /></div>
				</div>
				<div class="control-group">
					<label for="input-lokasi" class="control-label">Lokasi</label>
					<div class="controls"><input type="text" name="lokasi" id="input-lokasi" class="input-xxlarge" maxlength="50" /></div>
				</div>
				<div class="control-group">
					<label for="input-google_map" class="control-label">Google Map</label>
					<div class="controls"><input type="text" name="google_map" id="input-google_map" class="input-xxlarge" maxlength="50" /></div>
				</div>
				<div class="control-group">
					<label for="input-event_content" class="control-label">Description</label>
					<div class="controls"><textarea name="content" id="input-event_content" class="tinymce" style="width: 800px; height: 300px;"></textarea></div>
				</div>
				<div class="control-group">
					<label for="input-waktu" class="control-label">Waktu</label>
					<div class="controls"><input type="text" name="waktu" id="input-waktu" class="input-medium datepick" /></div>
				</div>
				<div class="grids">
					<div class="row-fluid">
						<div class="span1 form-me-label">Publish Date</div>
						<div class="span2 form-me-input" style="width: 160px;">
							<input type="text" name="publish_datepick" id="input-publish_datepick" class="input-medium datepick" data-rule-required="true" />
						</div>
						<div class="span2 form-me-input">
							<div class="bootstrap-timepicker"><input type="text" name="publish_timepick" id="timepicker" class="input-small timepick" data-rule-required="true" /></div>
						</div>
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<button type="button" class="btn form-close">Cancel</button>
				</div>
				
				<div style="position: absolute; top: 0px; right: 20px;">
					<div style="width: 200px; text-align: center;">
						<img class="event-photo" src="<?php echo base_url('static/img/no-images.jpg'); ?>" style="width: 188px; height: 116px;">
						<div style="padding: 10px 0 0 0;"><button type="button" class="btn btn-success event-browse">Browse Image</button></div>
					</div>
				</div>
			</form>
		</div>
	</div></div></div></div></div>
</div>
<script>
	event_image = function(p) {
		$('[name="photo"]').val(p.file_name);
		$('.event-photo').attr('src', p.file_link);
	}
	
	$(document).ready(function() {
		var dt = null;
		var editor = Func.get_editor();
		var page = {
			show_grid: function() {
				$('#form-event').hide();
				$('#grid-event').show();
			},
			show_editor: function() {
				$('#grid-event').hide();
				$('#form-event').show();
			}
		}
		
		var param = {
			id: 'cnt-event',
			source: web.host + 'editor/event/grid',
			column: [ { }, { }, { }, { }, { bSortable: false, sClass: "center" } ],
			init: function() {
				$('#cnt-event_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn btn-small btn-add">Tambah</button></div>');
				$('#cnt-event_length .btn-add').click(function() {
					$('#form-event')[0].reset();
					$('#form-event [name="id"]').val(0);
					$('#form-event [name="editor_id"]').val(editor.id);
					$('#form-event [name="photo"]').val('');
					
					page.show_editor();
				});
			},
			callback: function() {
				$('#cnt-event .edit').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var temp = ' + raw_record);
					Func.ajax({ url: web.host + 'editor/event/action', param: { action: 'get_by_id', id: temp.id }, callback: function(record) {
						$('#form-event [name="id"]').val(record.id);
						$('#form-event [name="editor_id"]').val(record.editor_id);
						$('#form-event [name="nama"]').val(record.nama);
						$('#form-event [name="alias"]').val(record.alias);
						$('#form-event [name="content"]').val(record.content);
						$('#form-event [name="photo"]').val(record.photo);
						$('#form-event [name="lokasi"]').val(record.lokasi);
						$('#form-event [name="photo_desc"]').val(record.photo_desc);
						$('#form-event [name="waktu"]').val(Func.SwapDate(record.waktu));
						$('#form-event [name="google_map"]').val(record.google_map);
						
						var publish_date = Func.get_date_time(record.publish_date, 1);
						$('#form-event [name="publish_datepick"]').val(publish_date.date);
						$('#form-event [name="publish_timepick"]').val(publish_date.time);
						
						if (record.photo_link != null) {
							$('.event-photo').attr('src', record.photo_link);
						} else {
							$('.event-photo').attr('src', NO_IMAGE);
						}
					} });
					page.show_editor();
				});
				
				$('#cnt-event .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
                    Func.confirm_delete({
                        data: { action: 'delete', id: record.id },
                        url: web.host + 'editor/event/action', callback: function() { dt.reload(); }
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
		$('.event-browse').click(function() { window.event_photo.browse() });
		
		/*	Modal */
		$('#form-event .form-close').click(function() {
			page.show_grid();
			$("html, body").animate({ scrollTop: 0 }, "slow");
		});
		$('#form-event').submit(function() {
			if (! $('#form-event').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('form-event');
			param.action = 'update';
			param.waktu = Func.SwapDate(param.waktu);
			param.publish_date = Func.SwapDate(param.publish_datepick) + ' ' + param.publish_timepick;
			
			Func.ajax({ url: web.host + 'editor/event/action', param: param, callback: function(result) {
				Func.show_notice({ text: result.message });
				if (result.status == 1) {
					dt.reload();
					page.show_grid();
					$("html, body").animate({ scrollTop: 0 }, "slow");
				}
			} });
			
			return false;
		});
	});
</script>
</body>
</html>