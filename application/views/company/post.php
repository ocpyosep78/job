<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Create Page', 'class' => 'icon-edit' ) ); ?>
		
		<div class="box-content">
			<form action="#" method="POST" class='form-horizontal form-wysiwyg'>
				<div class="control-group">
					<label for="judul_post" class="control-label">Judul Post</label>
					<div class="controls">
						<input type="text" name="judul_post" id="judul_post" class="input-xlarge">
					</div>
				</div>
				<div class="control-group">
					<label for="input_content" class="control-label">Text Area</label>
					<div class="controls">
						<textarea name="ckasdad" class="tinymce span12" style="height: 250px;"></textarea>
					</div>
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

</script>
</body>
</html>