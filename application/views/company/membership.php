<?php
	$company = $this->Company_model->get_session();
	$company = $this->Company_model->get_by_id(array( 'id' => $company['id'] ));
	$is_member = $this->Company_model->get_membership_status(array( 'id' => $company['id'] ));
	$array_membership = $this->Membership_model->get_array();
	$membership_request = $this->Company_Membership_model->get_membership_request(array( 'company_id' => $company['id'] ));
	$membership_invoice = $this->Widget_model->get_by_id(array( 'alias' => 'membership-invoice' ));
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
			
			<div class="row-fluid margin-top">
				<div class="alert alert-info">
					<?php if ($is_member) { ?>
					<div>Membership anda berlaku sampai : <?php echo GetFormatDate($company['membership_date'], array( 'FormatDate' => 'd-m-Y' )); ?></div>
					<div>Jumlah posting lowongan yang tersedia sampai : <?php echo $company['vacancy_count_left']; ?></div>
					<?php } else { ?>
					<div>Membership anda sudah tidak berlaku, harap untuk segera diperpanjang</div>
					<?php } ?>
				</div>
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
			
			<?php if (count($membership_request) > 0) { ?>
			<div class="row-fluid" style="border: 1px solid red;"><div style="padding: 0 25px;">
				<h3>Invoice :</h3>
				<div style="padding: 0 0 10px 0; border-bottom: 1px solid #CCCCCC;"><?php echo $membership_invoice['content']; ?></div>
				<div style="padding: 15px 0;">
					<div>Berlaku sampai : <?php echo GetFormatDate($membership_request['membership_date'], array( 'FormatDate' => 'd-m-Y' )); ?></div>
					<div>Jumlah Posting maksimal : <?php echo $membership_request['post_count']; ?></div>
					<div>Harga : <?php echo $membership_request['price']; ?></div>
				</div>
			</div></div>
			<?php } ?>
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
		
		bootbox.confirm("Confirm Membership, apa anda yakin ?", function(result) {
			if (! result) {
				return;
			}
			
			Func.ajax({ url: web.host + 'company/membership/action', param: param, callback: function(result) {
				Func.show_notice({ text: result.message });
				setTimeout(function(){ window.location.reload(); }, 3000);
			} });
		});
		
		return false;
	});
</script>
</body>
</html>