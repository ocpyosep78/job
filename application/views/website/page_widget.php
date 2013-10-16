<?php
	// breadcrump
	$breadcrump[] = array( 'title' => 'Index', 'link' => base_url() );
	$breadcrump[] = array( 'title' => $widget['nama'] );
?>

<?php $this->load->view( 'website/common/meta', array( 'title' => $widget['nama'] ) ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<section id='main'>
	<div class='container'><div class='row'>
		<div class='span9 content'>
				<div class='main-top span9'>
					<?php $this->load->view( 'website/common/breadcrumb', array( 'array_breadcrumb' => $breadcrump, 'title' => $widget['nama'] ) ); ?>
				</div>
				
				<div class="span9 news blog-article no-margin">
					<h2><?php echo $widget['nama']; ?></h2>
					
					<div><?php echo $widget['content']; ?></div>
				</div>
			</div>

			<aside class='span3'>
				<div class='inner'>
					<?php $this->load->view( 'website/common/register' ); ?>
					<?php $this->load->view( 'website/common/category_list' ); ?>
					<?php $this->load->view( 'website/common/site_banner' ); ?>
				</div>
			</aside>
		</div>
	</div>
</section>

<?php $this->load->view( 'website/common/footer' ); ?>