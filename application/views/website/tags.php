<?php
	preg_match('/tags\/([a-z0-9\-]+)/i', $_SERVER['REQUEST_URI'], $match);
	$tag_name = (!empty($match[1])) ? $match[1] : '';
	$tag = $this->Tag_model->get_by_id(array( 'alias' => $tag_name ));
	
	// page
	$page_active = get_page();
	$list_page = base_url('tags/'.$tag_name);
	$page_item = 5;
	
	// article tag
	$array_tag_article = $this->Article_Tag_model->get_array(array( 'tag_id' => $tag['id'], 'limit' => 500 ));
	$array_tag_event = $this->Event_Tag_model->get_array(array( 'tag_id' => $tag['id'], 'limit' => 500 ));
	$array_tag = array_merge($array_tag_article, $array_tag_event);
	
	// content
	$page_start = ($page_active - 1) * $page_item;
	$page_end = $page_start + $page_item;
	$array_tag = GetPageFromArray($array_tag, $page_start, $page_end);
	$page_count = ceil(count($array_tag) / $page_item);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<section id='main'>
	<div class='container'><div class='row'>
		<div class='span9 content grey'>
			<h1>List Tag</h1>
			<div class='options-line' style="position: relative;">
				<div class='breadcrumb-container'>
					<ul class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Index</a> <span class="divider">&raquo;</span></li>
						<li class="active">Tag <span class="divider">&raquo;</span></li>
						<li class="active"><?php echo $tag['nama']; ?></li>
					</ul>
				</div>
			</div>
			
			<?php if (count($array_tag) > 0) { ?>
			<div class='new-albums list' style="width: 100%;">
				<?php foreach ($array_tag as $array) { ?>
				<?php if (@$array['is_article']) { ?>
				<div class="new-album-box">
					<div style="padding-left: 15px;">&nbsp;</div>
					<div class="inner" style="border-left: none; border-right: none;">
						<figure><img src="<?php echo $array['article_photo_link']; ?>" /></figure>
						<div class="details">
							<h2 style="padding: 0 0 10px 0;"><a href="<?php echo $array['article_link']; ?>"><?php echo $array['article_nama']; ?></a></h2>
							<div class="extra-field">
								<ul>
									<li id="m_tipe"><strong>Kategori</strong> : <?php echo $array['kategori_nama']; ?></li>
									<li id="m_tipe"><strong>Sub Kategori</strong> : <?php echo $array['subkategori_nama']; ?></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<?php } else if (@$array['is_event']) { ?>
				<div class="new-album-box">
					<div style="padding-left: 15px;">&nbsp;</div>
					<div class="inner" style="border-left: none; border-right: none;">
						<figure><img src="<?php echo $array['event_photo_link']; ?>" style="width: 143px; height: 127px;" /></figure>
						<div class="details">
							<h2 style="padding: 0 0 10px 0;"><a href="<?php echo $array['event_link']; ?>"><?php echo $array['event_nama']; ?></a></h2>
							<div class="extra-field">
								<ul>
									<li id="m_tipe"><strong>Lokasi</strong> : <?php echo $array['event_lokasi']; ?></li>
									<li id="m_tipe"><strong>Waktu</strong> : <?php echo GetFormatDate($array['event_waktu'], array( 'FormatDate' => 'j F Y' )); ?></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<?php } ?>
			</div>
			
			<div class='standard-pagination'>
				<ul>
					<?php for ($i = -5; $i <= 5; $i++) { ?>
						<?php $class = ($i == 0) ? 'active' : ''; ?>
						<?php $page_counter = $page_active + $i; ?>
						<?php $page_link = $list_page.'/page_'.$page_counter; ?>
						<?php if ($page_counter > 0 && $page_counter <= $page_count) { ?>
						<li class='<?php echo $class; ?>'><a href='<?php echo $page_link; ?>' class='btn'><?php echo $page_counter; ?></a></li>
						<?php } ?>
					<?php } ?>
				</ul>
			</div>
			<?php } else { ?>
			<div class='new-albums list' style="width: 100%; padding: 25px 15px;">
				Maaf, tidak ada hasil tag terkait yang ditemukan.
			</div>
			<?php } ?>
		</div>
		
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