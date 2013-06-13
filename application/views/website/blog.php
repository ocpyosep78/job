<?php
	$request_uri = $_SERVER['REQUEST_URI'];
	$request_uri = preg_replace('/\/page_[0-9]+$/i', '', $request_uri);
	$temp = preg_replace('/.+blog\//i', '', $request_uri);
	$array_temp = explode('/', $temp);
	
	$blog_page = base_url('blog');
	$kategori = $this->Kategori_model->get_by_id( array( 'alias' => @$array_temp[0] ) );
	$subkategori = $this->Subkategori_model->get_by_id( array( 'alias' => @$array_temp[1] ) );
	
	// breadcrump
	$title = 'Blog';
	$array_tag = array();
	$breadcrump[] = array( 'title' => 'Index', 'link' => base_url() );
	if (count($kategori) > 0) {
		$blog_page = $kategori['link'];
		$title .= ' - '.$kategori['nama'];
		$breadcrump[] = array( 'title' => $kategori['nama'], 'link' => $kategori['link'] );
		
		// tag
		$array_tag = $this->Kategori_Tag_model->get_array(array( 'kategori_id' => $kategori['id'] ));
	}
	if (count($kategori) > 0 && count($subkategori) > 0) {
		$blog_page = $subkategori['link'];
		$title .= ' - '.$subkategori['nama'];
		$breadcrump[] = array( 'title' => $subkategori['nama'], 'link' => $subkategori['link'] );
		
		// tag
		$array_tag = $this->Subkategori_Tag_model->get_array(array( 'subkategori_id' => $subkategori['id'] ));
	}
	
	// blog
	$param_article = array(
		'article_status_id' => ARTICLE_PUBLISH,
		'publish_date' => $this->config->item('current_datetime'),
		'kategori_id' => @$kategori['id'],
		'subkategori_id' => @$subkategori['id'],
		'sort' => '[{"property":"publish_date","direction":"DESC"}]'
	);
	$array_article = $this->Article_model->get_array($param_article);
	
	// page
	$page_item = 9;
	$page_active = get_page();
	$page_count = ceil($this->Article_model->get_count() / $page_item);
?>

<?php $this->load->view( 'website/common/meta', array( 'title' => $title ) ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<section id='main'>
	<div class='container'><div class='row'>
		<div class='span9 content'>
			<div class='main-top span9'>
				<?php $this->load->view( 'website/common/breadcrumb', array( 'array_breadcrumb' => $breadcrump, 'title' => 'Blog' ) ); ?>
				
				<div class='span5 tags-container'>
					<div class="overlay"></div>
					<div class='tags'>
						<?php foreach ($array_tag as $tag) { ?>
						<a href="#"><span><?php echo $tag['tag_nama']; ?></span></a>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class='span9 news no-margin'>
				<?php foreach ($array_article as $article) { ?>
				<article class='span3-article'>
					<div class='inner'>
						<figure><img src="<?php echo $article['photo_link']; ?>" /></figure>
						<h2><a href='<?php echo $article['article_link']; ?>'><?php echo $article['nama']; ?></a></h2>
						<p><?php echo $article['desc_short']; ?></p>
					</div>
				</article>
				<?php } ?>
			</div>
			<div class='standard-pagination'>
				<ul>
					<?php for ($i = -5; $i <= 5; $i++) { ?>
						<?php $class = ($i == 0) ? 'active' : ''; ?>
						<?php $page_counter = $page_active + $i; ?>
						<?php $page_link = $blog_page.'/page_'.$page_counter; ?>
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
				<?php $this->load->view( 'website/common/category_list' ); ?>
				<div class='cart'></div>
			</div>
		</aside>
	</div></div>
</section>

<?php $this->load->view( 'website/common/footer' ); ?>