<?php
	$array_propinsi = $this->Propinsi_model->get_array( array( 'negara_id' => NEGARA_INDONESIA_ID ) );
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<section id='main'>
	<div class='container'><div class='row'>
		<div class='span9 content grey'>
			<h1>List Region</h1>
			<div class='options-line' style="position: relative;">
				<div class='breadcrumb-container'>
					<ul class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Index</a> <span class="divider">&raquo;</span></li>
						<li class="active">Region</li>
					</ul>
				</div>
			</div>
			
			<div class='new-albums list' style="width: 100%;">
				<div style="padding: 10px 0 10px 30px;">
					<ul style="list-style: disc;">
					<?php foreach ($array_propinsi as $propinsi) { ?>
					<li><a class="cursor search-region" data-id="<?php echo $propinsi['id']; ?>"><?php echo $propinsi['nama']; ?></a></li>
					<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<script>
			$('.search-region').click(function() {
				$('#form-header [name="propinsi_id"]').val($(this).data('id'));
				$('#form-header [name="submit"]').click();
			});
		</script>
		
		<aside class='span3'>
			<div class='inner'>
				<?php $this->load->view( 'website/common/register' ); ?>
				<?php $this->load->view( 'website/common/category_list' ); ?>
				<?php $this->load->view( 'website/common/site_banner' ); ?>
			</div>
		</aside>
	</div></div>
</section>

<?php $this->load->view( 'website/common/footer' ); ?>