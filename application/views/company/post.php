<?php
	$company = $this->Company_model->get_session();
	$post = $this->Post_model->get_by_id(array( 'company_id' => $company['id'] ));
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Post' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Create Page', 'class' => 'icon-edit' ) ); ?>
		
		<div class="box-content">
			<div class="hide">
				<div class="cnt-company"><?php echo json_encode($company); ?></div>
			</div>
			
			<form class='form-horizontal form-validate' id="form-post">
				<input type="hidden" name="id" value="0" />
				<input type="hidden" name="company_id" value="0" />
				
				<div class="control-group">
					<label for="input-nama" class="control-label">Judul Post</label>
					<div class="controls"><input type="text" name="nama" id="input-nama" class="input-xxlarge" data-rule-required="true" value="<?php echo @$post['nama']; ?>" /></div>
				</div>
				<div class="control-group">
					<label for="input-content" class="control-label">Text Area</label>
					<div class="controls"><textarea name="content" id="input-content" class="tinymce span9" style="height: 250px;"><?php echo @$post['content']; ?></textarea></div>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Save changes</button>
					<button type="button" class="btn">Cancel</button>
				</div>
			</form>
		</div>
	</div></div></div></div></div>
</div>

<script>
	var company = Func.get_company();
	$('[name="company_id"]').val(company.id);
	
	$('#form-post').submit(function() {
		if (! $('#form-post').valid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('form-post');
		param.action = 'update';
		Func.ajax({ url: web.host + 'company/post/action', param: param, callback: function(result) {
			if (result.status == 1) {
				$('[name="id"]').val(result.id);
				Func.show_notice({ text: result.message });
			}
		} });
		
		return false;
	});
</script>
</body>
</html>