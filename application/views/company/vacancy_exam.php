<?php
	preg_match('/vacancy_exam\/index\/([\d]+)/i', $_SERVER['REQUEST_URI'], $match);
	$vacancy_id = (empty($match[1])) ? 0 : $match[1];
	
	// prepare data
	$company = $this->Company_model->get_session();
	$vacancy = $this->Vacancy_model->get_by_id(array( 'id' => $vacancy_id ));
	$array_time[] = array( 'nama' => 'Bebas', 'value' => '0' );
	$array_time[] = array( 'nama' => '1 Jam', 'value' => '1H' );
	$array_time[] = array( 'nama' => '2 Jam', 'value' => '2H' );
	$array_time[] = array( 'nama' => '3 Jam', 'value' => '3H' );
	
	// seeker
	$param_apply = array(
		'vacancy_id' => $vacancy_id, 'is_delete' => 0, 'limit' => 1000,
		'apply_status_id' => APPLY_STATUS_INTERVIEW
	);
	$array_apply = $this->Apply_model->get_array_seeker($param_apply);
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Exam' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Exam', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="hide">
				<div class="cnt-vacancy"><?php echo json_encode($vacancy); ?></div>
				<iframe name="iframe_exam_file" src="<?php echo base_url('panel/upload?callback=exam_file&filetype=document'); ?>"></iframe>
			</div>
			
			<form class='form-horizontal form-validate' id="form-exam">
				<input type="hidden" name="id" value="0" />
				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="vacancy_id" value="<?php echo $vacancy['id']; ?>" />
				<input type="submit" class="btn-hidden" hidefocus="true" />
				
				<div class="control-group">
					<label class="control-label">Vacancy</label>
					<div class="controls"><label class="control-label" style="width: 400px;"><?php echo $vacancy['nama']; ?></label></div>
				</div>
				<div class="control-group">
					<label for="input-nama" class="control-label">Pilih Peserta</label>
					<div class="controls"><select name="apply_id" class="input-xlarge">
						<?php echo ShowOption(array( 'Array' => $array_apply, 'ArrayID' => 'id', 'ArrayTitle' => 'full_name', 'OptAll' => true )); ?>
					</select></div>
				</div>
				<div class="control-group">
					<label for="input-subkategori_id" class="control-label">Waktu</label>
					<div class="controls"><select name="exam_time" class="input-xlarge" data-rule-required="true">
						<?php echo ShowOption(array( 'Array' => $array_time, 'ArrayID' => 'value', 'ArrayTitle' => 'nama' )); ?>
					</select></div>
				</div>
				<div class="control-group">
					<label class="control-label">Email Panitia</label>
					<div class="controls"><input type="text" name="email" class="input-xlarge" data-rule-required="true" data-rule-email="true" /></div>
				</div>
				<div class="control-group">
					<label class="control-label">Upload Soal</label>
					<div class="controls">
						<input type="text" name="exam_file" class="input-xlarge" readonly="readonly" />
						<button type="button" class="btn btn-success browse-exam_file" style="width: 125px;">Upload</button><br />
						File yang dapat diupload berupa : doc, docx atau pdf
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
	exam_file = function(p) {
		$('[name="exam_file"]').val(p.file_name);
	}
	
	$(document).ready(function() {
		$('.browse-exam_file').click(function() { window.iframe_exam_file.browse() });
		
		// vacancy
		var raw = $('.cnt-vacancy').text();
		eval('var vacancy = ' + raw);
		
		$('#form-exam').submit(function() {
			if (! $('#form-exam').valid()) {
				return false;
			}
			
			var param = Site.Form.GetValue('form-exam');
			Func.ajax({ url: web.host + 'company/vacancy_exam/action', param: param, callback: function(result) {
				Func.show_notice({ text: result.message });
				if (result.status == 1) {
					window.location = web.host + 'company/download/index/' + vacancy.id;
				}
			} });
			
			return false;
		});
	});
</script>
</body>
</html>