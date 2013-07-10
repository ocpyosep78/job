<?php
	// breadcrump
	$breadcrump[] = array( 'title' => 'Index', 'link' => base_url() );
	$breadcrump[] = array( 'title' => 'Events', 'link' => base_url('event') );
	$array_button = array( array( 'title' => 'RSS', 'link' => base_url('event/rss') ) );
	
	// get user
	$user = get_user();
	
	// page
	$page_item = 4;
	$page_active = get_page();
	$event_page = base_url('event');
	
	// event
	$param_event = array(
		'publish_date' => $this->config->item('current_datetime'),
		'filter' => '[{"type":"custom","field":"DATE(waktu) = \''.date("Y-m-d").'\'"}]',
		'sort' => '[{"property":"waktu","direction":"ASC"}]', 'limit' => $page_item
	);
	$array_event = $this->Event_model->get_array($param_event);
	
	// next event
	$param_event = array(
		'publish_date' => $this->config->item('current_datetime'),
		'filter' => '[' .
			'{"type":"numeric","comparison":"gt","value":"'.date("Y-m-d").'","field":"Event.waktu"},' .
			'{"type":"numeric","comparison":"not","value":"'.date("Y-m-d").'","field":"DATE(Event.waktu)"}' .
		']',
		'sort' => '[{"property":"waktu","direction":"ASC"}]',
		'start' => ($page_active - 1) * $page_item,
		'limit' => $page_item
	);
	$next_event = $this->Event_model->get_array($param_event);
	$page_count = ceil(($this->Event_model->get_count()) / $page_item);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<section id='main'>
	<div class="hide">
		<div class="cnt-user"><?php echo json_encode($user); ?></div>
	</div>
	
	<div class='container'><div class='row'>
		<div class='span9 content'>
			<div class='main-top span9'>
				<?php $this->load->view( 'website/common/breadcrumb', array( 'array_breadcrumb' => $breadcrump, 'array_button' => $array_button, 'title' => 'Events' ) ); ?>
			</div>
			<div style="clear: both;"></div>
			<div class="slide-message"></div>
			<div style="clear: both;"></div>
			
			<div class='span9 events no-margin'>
				<?php if (count($array_event) > 0) { ?>
				<h1 class='span6 no-margin'>Hari Ini</h1>
				<?php if (count($array_event) > 1) { ?>
				<div class='today-event-controls span3'>
					<a href="#" class='next'>next</a>
					<a href="#" class='prev'>prev</a>
				</div>
				<?php } ?>
				<hr class='floating-hr' />
				
				<div id='daily-event' class='span9 no-margin'>
					<ul class='slides'>
						<?php foreach ($array_event as $event) { ?>
						<li>
							<div class="span9 no-margin today-event today01">
								<div class="left">
									<figure>
										<img src="<?php echo $event['photo_link']; ?>" />
										<figcaption><?php echo $event['photo_desc']; ?></figcaption>
									</figure>
									<?php echo $event['content_short']; ?>
								</div>
								<div class="right">
									<div class="date">
										<?php echo GetFormatDate($event['waktu'], array( 'FormatDate' => 'j F' )); ?>
										<span class="time">
											<?php echo GetFormatDate($event['waktu'], array( 'FormatDate' => 'H:i' )); ?>
										</span>
									</div>
									<a href="<?php echo $event['event_link']; ?>" class="location"><?php echo $event['lokasi']; ?></a>
									<div style="background: #FFFFFF; padding: 10px; font-size: 30px; line-height: 30px;"><?php echo $event['nama']; ?></div>
									<div class="users"><a href="<?php echo $event['event_link']; ?>" title="Lihat" class="go btn btn-main">Lihat</a></div>
								</div>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div>
				<?php } ?>
				
				<h1 class='pull-left'>Akan Datang... </h1>
				<div style="float:right; padding: 9px 0 0 0;"><a href="#" title='Sign in' class='go btn btn-main subscribe-event'>Kirim event Ke Email saya</a></div>
				<hr class='floating-hr' />
				
				<div class='row'>
					<?php foreach ($next_event as $event) { ?>
					<article class="span4 art1">
						<div class="inner">
							<div style="float:none; font-size: 20px; min-height: 40px;"><?php echo $event['nama']; ?></div>
							<figure>
								<?php if (!empty($event['photo_link'])) { ?>
								<img src="<?php echo $event['photo_link']; ?>" />
								<?php } ?>
								
								<figcaption><?php echo $event['photo_desc']; ?></figcaption>
							</figure>
							<div class="date">
								<?php echo GetFormatDate($event['waktu'], array( 'FormatDate' => 'j F' )); ?>
								<span class="time">
									<?php echo GetFormatDate($event['waktu'], array( 'FormatDate' => 'H:i' )); ?>
								</span>
							</div>
							<div><a href="<?php echo $event['event_link']; ?>" class="location"><?php echo $event['lokasi']; ?></a></div>
							<p><?php echo $event['content_short']; ?></p>
						</div>
					</article>
					<?php } ?>
				</div>
			</div>
			
			<div class='standard-pagination'>
				<ul>
					<?php for ($i = -5; $i <= 5; $i++) { ?>
						<?php $class = ($i == 0) ? 'active' : ''; ?>
						<?php $page_counter = $page_active + $i; ?>
						<?php $page_link = $event_page.'/page_'.$page_counter; ?>
						<?php if ($page_counter > 0 && $page_counter <= $page_count) { ?>
						<li class='<?php echo $class; ?>'><a href='<?php echo $page_link; ?>' class='btn'><?php echo $page_counter; ?></a></li>
						<?php } ?>
					<?php } ?>
				</ul>
			</div>
		</div>
		
		<aside class='span3'>
			<div class='inner'>
				<?php $this->load->view( 'website/common/register' ); ?>
				<?php $this->load->view( 'website/common/site_banner' ); ?>
			</div>
		</aside>
	</div></div>
</section>

<script type="text/javascript">
$(document).ready( function() {
	var raw_user = $('.cnt-user').text();
	eval('var user = ' + raw_user);
	
	// form subscribe
	$('.subscribe-event').click(function() {
		if (user.email == null) {
			$('.slide-message').text('Silahkan Login untuk melanjutkan');
			$('.slide-message').slideDown('slow');
			return;
		}
		
		Func.ajax({ url: web.host + 'ajax', param: { action: 'subscribe', jenis_subscribe_id: 2, email: user.email }, callback: function(result) {
			$(".slide-message").html('Anda berhasil berlangganan'); 
			$(".slide-message").slideDown('slow');
		} });
	});
});
</script>

<?php $this->load->view( 'website/common/footer' ); ?>