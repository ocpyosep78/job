<?php
	$company = $this->Company_model->get_session();
	$array_membership = $this->Membership_model->get_array();
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Membership' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<style>
.controls { margin-left: 30px !important; }
</style>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Membership', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="hide">
				<div class="cnt-company"><?php echo json_encode($company); ?></div>
			</div>
			
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<form class='form-horizontal form-validate' id="form-membership">
					<input type="hidden" name="id" value="0" />
					
					<div class="control-group">
						<?php foreach ($array_membership as $item) { ?>
						<div class="controls">
							<label class="radio">
								<div style="float: left; width: 150px;"><input type="radio" name="membership_id" value="<?php echo $item['id']; ?>" /> <?php echo $item['date_count']; ?></div>
								<div style="float: left; width: 200px;">Post <?php echo $item['post_count']; ?> jobs</div>
								<div style="float: left; width: 300px;"><?php echo $item['price']; ?></div>
								<div class="clear"></div>
							</label>
						</div>
						<?php } ?>
					</div>
					
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Save changes</button>
						<button type="button" class="btn">Cancel</button>
					</div>
				</form>
			</div></div></div></div>
		</div>
	</div></div></div></div></div>
</div>
<script>
	var company = Func.get_company();
	$('#form-membership').submit(function() {
		var param = {
			action: 'update',
			id: 0,
			company_id: company.id,
			membership_id: $('input[name=membership_id]:checked').val()
		};
		if (param.membership_id == null) {
			return false;
		}
		
		Func.ajax({ url: web.host + 'company/membership/action', param: param, callback: function(result) {
			Func.show_notice({ text: result.message });
		} });
		
		return false;
	});
</script>
</body>
</html>