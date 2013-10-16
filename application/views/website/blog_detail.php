<?php
	// get view type
	preg_match('/(overview)/i', $_SERVER['REQUEST_URI'], $match);
	$view_type = (!empty($match[1])) ? $match[1] : 'normal';
	
	// breadcrump
	$breadcrump[] = array( 'title' => 'Index', 'link' => base_url() );
	$breadcrump[] = array( 'title' => $article['nama'], 'link' => $article['article_link'] );
	
	$array_tag = $this->Article_Tag_model->get_array(array( 'article_id' => $article['id'] ));
	
	$param_article = array(
		'filter' => '[{"type":"numeric","comparison":"not","value":"'.$article['id'].'","field":"Article.id"}]',
		'sort' => '{"is_custom":"1","query":"RAND()"}', 'limit' => 3
	);
	$array_article = $this->Article_model->get_array($param_article);
?>

<?php $this->load->view( 'website/common/meta', array( 'title' => $article['nama'] ) ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<section id='main'>
	<div class='container'><div class='row'>
		<div class='span9 content'>
				<div class='main-top span9'>
					<?php $this->load->view( 'website/common/breadcrumb', array( 'array_breadcrumb' => $breadcrump, 'title' => 'Blog' ) ); ?>
				</div>
				
				<div class="span9 news blog-article no-margin">
					<h2><?php echo $article['nama']; ?></h2>
					
					<?php if (!empty($article['photo_link'])) { ?>
					<figure><img src="<?php echo $article['photo_link']; ?>" alt="<?php echo $article['nama']; ?>" /></figure>
					<?php } ?>
					
					<?php if ($view_type == 'overview') { ?>
					<h2>Ini Halaman Overview, Tambahkan apa yang ada suka disini</h2>
					<?php } ?>
					
					<?php echo $article['article_desc_1']; ?>
					<blockquote><?php echo $article['article_desc_2']; ?></blockquote>
					<?php echo $article['article_desc_3']; ?>
				</div>
				
				<?php if (count($array_tag) > 0) { ?>
				<div class='article-details span9'>
					<div class='tags no-margin'>
						<?php foreach ($array_tag as $tag) { ?>
						<a href="<?php echo $tag['tag_link']; ?>"><span><?php echo $tag['tag_nama']; ?></span></a>
						<?php } ?>
					</div>
				</div>
				<?php } ?>
				
				<div class='span9 news no-margin homepage'>
					<h1>Other posts</h1><hr />
					<?php foreach ($array_article as $article) { ?>
					<article class='span3-article'>
						<div class='inner'>
							<?php if (!empty($article['photo_link'])) { ?>
							<figure><img src="<?php echo $article['photo_link']; ?>" /></figure>
							<?php } ?>
							
							<h2><a href='<?php echo $article['article_link']; ?>'><?php echo $article['nama']; ?></a></h2>
							<p><?php echo $article['desc_short']; ?></p>
						</div>
					</article>
					<?php } ?>
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