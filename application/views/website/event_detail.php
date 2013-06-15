<?php
	// breadcrump
	$breadcrump[] = array( 'title' => 'Index', 'link' => base_url() );
	$breadcrump[] = array( 'title' => 'Events', 'link' => base_url('event') );
	$breadcrump[] = array( 'title' => $event['nama'], 'link' => $event['event_link'] );
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<section id='main'>
	<div class='container'><div class='row'>
		<div class='span9 content'>
			<div class='main-top span9'>
				<?php $this->load->view( 'website/common/breadcrumb', array( 'array_breadcrumb' => $breadcrump, 'title' => 'Events' ) ); ?>
			</div>
			<div class="span9 news event-article no-margin">
				<figure class="span9 no-margin">
					<img src="<?php echo $event['photo_link']; ?>" />
				</figure>
				<div class="span6 no-margin"><?php echo $event['content']; ?></div>
				<div class="span3 right">
					<div class="inner">
						<div class="date">
						  Biarin Kosong
						</div>
					</div>
				</div>
			</div>
			<div class="article-details span9">
				<div class="star-rating span2">
					Submit by : <?php echo $event['editor_name']; ?>
				</div>
				<div class="tags span6 no-margin">
					<a href="#"><span>Malang</span></a>
					<a href="#"><span>Jobs fair</span></a>
					<a href="#"><span>Brawijaya</span></a>
					<a href="#"><span>Love</span></a>
				</div>
			</div>
		</div>
		<aside class="span3">
			<div class="inner">
				<?php $this->load->view( 'website/common/register' ); ?>
				<?php $this->load->view( 'website/common/site_banner' ); ?>
			</div>
		</aside>
	</div></div>
</section>

<?php $this->load->view( 'website/common/footer' ); ?>