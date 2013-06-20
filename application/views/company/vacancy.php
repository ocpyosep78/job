<?php
	$company = $this->Company_model->get_session();
	
	$array_jenjang = $this->Jenjang_model->get_array();
	$array_position = $this->Position_model->get_array(array( 'limit' => 250 ));
	$array_pengalaman = $this->Pengalaman_model->get_array();
	$array_vacancy_status = $this->Vacancy_Status_model->get_array(array( 'is_company' => 1 ));
	$array_jenis_pekerjaan = $this->Jenis_Pekerjaan_model->get_array();
	$array_kategori = $this->Kategori_model->get_array(array( 'limit' => 100 ));
	$array_propinsi = $this->Propinsi_model->get_array(array('negara_id' => NEGARA_INDONESIA_ID));
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Vacancy' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Vacancy', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="hide">
				<div class="cnt-company"><?php echo json_encode($company); ?></div>
			</div>
			
			<div class="row-fluid" id="grid-vacancy"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table id="cnt-vacancy" class="table table-striped table-bordered">
					<thead><tr>
						<th>Nama</th>
						<th>Posisi</th>
						<th>Status</th>
						<th>Publish Date</th>
						<th style="width: 75px;">&nbsp;</th>
					</tr></thead>
					<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
				</table>
			</div></div></div></div>
			
			<form class='form-horizontal form-validate hide' id="form-vacancy" style="position: relative;">
				<input type="hidden" name="id" value="0" />
				<input type="hidden" name="company_id" value="0" />
				
				<div class="control-group">
					<label class="control-label">Penulis</label>
					<div class="controls"><label class="control-label" id="cnt-company-name" style="width: 400px;">-</label></div>
				</div>
				<div class="control-group">
					<label for="input-nama" class="control-label">Judul</label>
					<div class="controls"><input type="text" name="nama" id="input-nama" class="input-xxlarge" data-rule-required="true" /></div>
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
					<label for="input-vacancy_status_id" class="control-label">Status</label>
					<div class="controls"><select name="vacancy_status_id" id="input-vacancy_status_id" class="input-xxlarge" data-rule-required="true">
						<?php echo ShowOption(array( 'Array' => $array_vacancy_status, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
					</select></div>
				</div>
				<div class="control-group">
					<label for="input-position" class="control-label">Position</label>
					<div class="controls"><select name="position" class="select2-me input-block-level" style="width: 530px;" multiple="multiple">
						<?php echo ShowOption(array( 'Array' => $array_position, 'ArrayID' => 'nama', 'ArrayTitle' => 'nama', 'WithEmptySelect' => 0 )); ?>
					</select></div>
				</div>
				<div class="control-group">
					<label for="input-article_url" class="control-label">URL Artikel</label>
					<div class="controls"><input type="text" name="article_url" id="input-article_url" class="input-xxlarge" /></div>
				</div>
				<div class="control-group">
					<label for="input-article_link" class="control-label">Link Artikel</label>
					<div class="controls"><input type="text" name="article_link" id="input-article_link" class="input-xxlarge" /></div>
				</div>
				<div class="control-group">
					<label for="input-content_short" class="control-label">Short Desc</label>
					<div class="controls"><textarea name="content_short" id="input-content_short" class="span9 tinymce" style="height: 300px;"></textarea></div>
				</div>
				<div class="control-group">
					<label for="input-content1" class="control-label">Detail</label>
					<div class="controls"><textarea name="content" id="input-content1" class="tinymce" style="height: 300px;"></textarea></div>
				</div>
				<div class="control-group">
					<label for="input-opsi_1" class="control-label">Opsi 1</label>
					<div class="controls"><input type="text" name="opsi_1" id="input-opsi_1" class="input-xxlarge" /></div>
				</div>
				<div class="control-group">
					<label for="input-opsi_2" class="control-label">Opsi 2</label>
					<div class="controls"><input type="text" name="opsi_2" id="input-opsi_2" class="input-xxlarge" /></div>
				</div>
				<div class="control-group">
					<label for="input-propinsi_id" class="control-label">Lokasi Kerja</label>
					<div class="controls"><select name="propinsi_id" id="input-propinsi_id" class="input-xxlarge">
						<?php echo ShowOption(array( 'Array' => $array_propinsi, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
					</select></div>
				</div>
				<div class="control-group">
					<label for="input-kota_id" class="control-label">Kota</label>
					<div class="controls"><select name="kota_id" id="input-kota_id" class="input-xxlarge" data-rule-required="true">
						<option value="">-</option>
					</select></div>
				</div>
				<div class="control-group">
					<label for="input-jenjang_id" class="control-label">Pendidikan</label>
					<div class="controls"><select name="jenjang_id" id="input-jenjang_id" class="input-xxlarge">
						<?php echo ShowOption(array( 'Array' => $array_jenjang, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
					</select></div>
				</div>
				<div class="control-group">
					<label for="input-jenis_pekerjaan_id" class="control-label">Tipe Pekerjaan</label>
					<div class="controls"><select name="jenis_pekerjaan_id" id="input-jenis_pekerjaan_id" class="input-xxlarge">
						<?php echo ShowOption(array( 'Array' => $array_jenis_pekerjaan, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
					</select></div>
				</div>
				<div class="control-group">
					<label for="input-pengalaman_id" class="control-label">Pengalaman</label>
					<div class="controls"><select name="pengalaman_id" id="input-pengalaman_id" class="input-xxlarge">
						<?php echo ShowOption(array( 'Array' => $array_pengalaman, 'ArrayID' => 'id', 'ArrayTitle' => 'nama' )); ?>
					</select></div>
				</div>
				<div class="control-group">
					<label for="input-gaji" class="control-label">Gaji yang ditawarkan</label>
					<div class="controls"><input type="text" name="gaji" id="input-gaji" class="input-xlarge" /></div>
				</div>
				<div class="control-group">
					<label for="input-publish_date" class="control-label">Publish Date</label>
					<div class="controls"><input type="text" name="publish_date" id="input-publish_date" class="input-medium datepick" data-rule-required="true" /></div>
				</div>
				<div class="control-group">
					<label for="input-close_date" class="control-label">Closed Date</label>
					<div class="controls"><input type="text" name="close_date" id="input-close_date" class="input-medium datepick" data-rule-required="true" /></div>
				</div>
				
				<div class="box box-color box-bordered teal">
					<div class="box-title"><h3><i class="icon-file"></i> Set Email Penerima</h3></div>
					<div class="box-content">
						<div class="control-group">
							<label for="input-email_apply" class="control-label">Email Apply</label>
							<div class="controls"><input type="text" name="email_apply" id="input-email_apply" class="input-xlarge" data-rule-required="true" data-rule-email="true" /></div>
						</div>
						<div class="control-group">
							<label for="input-email_quick" class="control-label">Email Quick Applay</label>
							<div class="controls"><input type="text" name="email_quick" id="input-email_quick" class="input-xlarge" data-rule-email="true" /></div>
						</div>
					</div>
				</div>
				
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<button type="button" class="btn form-close">Cancel</button>
				</div>
			</form>
		</div>
	</div></div></div></div></div>
</div>
<script>
	$(document).ready(function() {
		var dt = null;
		var company = Func.get_company();
		var page = {
			show_grid: function() {
				$('#form-vacancy').hide();
				$('#grid-vacancy').show();
			},
			show_editor: function() {
				$('#grid-vacancy').hide();
				$('#form-vacancy').show();
			}
		}
		
		var param = {
			id: 'cnt-vacancy',
			source: web.host + 'company/vacancy/grid',
			column: [ { }, { }, { }, { }, { bSortable: false, sClass: "center" } ],
			init: function() {
				$('#cnt-vacancy_length').prepend('<div style="float: left; width: 65px; padding: 2px 0 0 0;"><button class="btn btn-small btn-add">Tambah</button></div>');
				$('#cnt-vacancy_length .btn-add').click(function() {
					$('#form-vacancy')[0].reset();
					$('#form-vacancy [name="id"]').val(0);
					$('#form-vacancy [name="company_id"]').val(company.id);
					$('#form-vacancy [name="position"]').val([]).select2();
					$('#cnt-company-name').html(company.nama);
					
					page.show_editor();
				});
			},
			callback: function() {
				$('#cnt-vacancy .edit').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var temp = ' + raw_record);
					Func.ajax({ url: web.host + 'company/vacancy/action', param: { action: 'get_by_id', id: temp.id }, callback: function(record) {
						$('#cnt-company-name').html(record.company_name);
						$('#form-vacancy [name="id"]').val(record.id);
						$('#form-vacancy [name="company_id"]').val(record.company_id);
						$('#form-vacancy [name="kategori_id"]').val(record.kategori_id);
						$('#form-vacancy [name="propinsi_id"]').val(record.propinsi_id);
						$('#form-vacancy [name="vacancy_status_id"]').val(record.vacancy_status_id);
						$('#form-vacancy [name="jenjang_id"]').val(record.jenjang_id);
						$('#form-vacancy [name="jenis_pekerjaan_id"]').val(record.jenis_pekerjaan_id);
						$('#form-vacancy [name="pengalaman_id"]').val(record.pengalaman_id);
						$('#form-vacancy [name="nama"]').val(record.nama);
						$('#form-vacancy [name="position"]').val(record.position.split(',')).select2();
						$('#form-vacancy [name="article_url"]').val(record.article_url);
						$('#form-vacancy [name="article_link"]').val(record.article_link);
						$('#form-vacancy [name="content_short"]').val(record.content_short);
						$('#form-vacancy [name="content"]').val(record.content);
						$('#form-vacancy [name="opsi_1"]').val(record.opsi_1);
						$('#form-vacancy [name="opsi_2"]').val(record.opsi_2);
						$('#form-vacancy [name="gaji"]').val(record.gaji);
						$('#form-vacancy [name="publish_date"]').val(Func.SwapDate(record.publish_date));
						$('#form-vacancy [name="close_date"]').val(Func.SwapDate(record.close_date));
						$('#form-vacancy [name="email_apply"]').val(record.email_apply);
						$('#form-vacancy [name="email_quick"]').val(record.email_quick);
						
						combo.kota({ propinsi_id: record.propinsi_id, target: $('[name="kota_id"]'), callback: function() { $('[name="kota_id"]').val(record.kota_id); } });
						combo.subkategori({ kategori_id: record.kategori_id, target: $('[name="subkategori_id"]'), callback: function() { $('[name="subkategori_id"]').val(record.subkategori_id); } });
					} });
					page.show_editor();
				});
				
				$('#cnt-vacancy .delete').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
                    Func.confirm_delete({
                        data: { action: 'delete', id: record.id },
                        url: web.host + 'company/vacancy/action', callback: function() { dt.reload(); }
                    });
				});
			}
		}
		dt = Func.init_datatable(param);
		
		// form
		$('[name="kategori_id"]').change(function() {
			combo.subkategori({ kategori_id: $('[name="kategori_id"]').val(), target: $('[name="subkategori_id"]') })
		});
		$('[name="propinsi_id"]').change(function() {
			combo.kota({ propinsi_id: $('[name="propinsi_id"]').val(), target: $('[name="kota_id"]') })
		});
		
		/*	Modal */
		$('#form-vacancy .form-close').click(function() {
			page.show_grid();
			$("html, body").animate({ scrollTop: 0 }, "slow");
		});
		$('#form-vacancy').submit(function() {
			if (! $('#form-vacancy').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('form-vacancy');
			param.action = 'update';
			param.publish_date = Func.SwapDate(param.publish_date);
			param.close_date = Func.SwapDate(param.close_date);
			param.position = param.position.join(',');
			
			Func.ajax({ url: web.host + 'company/vacancy/action', param: param, callback: function(result) {
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