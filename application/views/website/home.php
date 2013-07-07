<?php
	$param_slide1 = array(
		'sort' => '{"is_custom":"1","query":"RAND()"}', 'limit' => 20
	);
	$array_slide1 = $this->Company_model->get_array($param_slide1);
	
	$param_slide2 = array(
		'filter' => '[{"type":"numeric","comparison":"eq","value":"'.ARTICLE_PUBLISH.'","field":"Article.article_status_id "}]',
		'sort' => '{"is_custom":"1","query":"RAND()"}', 'limit' => 20
	);
	$array_slide2 = $this->Article_model->get_array($param_slide2);
	
	$param_vacancy = array(
		'filter' => '[{"type":"numeric","comparison":"eq","value":"'.VACANCY_STATUS_APPROVE.'","field":"Vacancy.vacancy_status_id"}]',
		'sort' => '[{"property":"publish_date","direction":"DESC"}]', 'limit' => 15
	);
	$array_vacancy = $this->Vacancy_model->get_array($param_vacancy);
	
	$param_article = array(
		'filter' => '[{"type":"numeric","comparison":"eq","value":"'.ARTICLE_PUBLISH.'","field":"Article.article_status_id "}]',
		'sort' => '[{"property":"publish_date","direction":"DESC"}]', 'limit' => 1
	);
	$array_article = $this->Article_model->get_array($param_article);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<div id='slider' class='hidden-phone'>
	<div class='container'><div class='row'><div class='slider'>
	<ul class='slides'>
		<li class="slide-item">
			<div class='span9'>
				<?php for ($i = 0; $i < 18; $i++) { ?>
				<?php if (empty($array_slide1[$i]['logo_link'])) { ?>
				<a href="<?php echo $array_slide1[$i]['company_link']; ?>">
					<div class='artwork'>
						<div class='glow'></div>
						<div class='text'>
							<span class='artist'><?php echo $array_slide1[$i]['nama']; ?></span>
						</div>
					</div>
				</a>
				<?php } else { ?>
				<a href="<?php echo $array_slide1[$i]['company_link']; ?>">
					<div class='artwork'>
						<div class='glow'></div>
						<img src="<?php echo $array_slide1[$i]['logo_link']; ?>" />
					</div>
				</a>
				<?php } ?>
				<?php } ?>
			</div>
			<div class='slider-sidebar span3'>
				<?php $this->load->view( 'website/common/register' ); ?>
				
				<?php for ($i = 18; $i <= 19; $i++) { ?>
				<?php if (empty($array_slide1[$i]['logo_link'])) { ?>
				<a href="<?php echo $array_slide1[$i]['company_link']; ?>">
					<div class='artwork'>
						<div class='glow'></div>
						<div class='text'>
							<span class='artist'><?php echo $array_slide1[$i]['nama']; ?></span>
						</div>
					</div>
				</a>
				<?php } else { ?>
				<a href="<?php echo $array_slide1[$i]['company_link']; ?>">
					<div class='artwork'>
						<div class='glow'></div>
						<img src="<?php echo $array_slide1[$i]['logo_link']; ?>" />
					</div>
				</a>
				<?php } ?>
				<?php } ?>
			</div>
		</li>
		<li class="slide-item" style="display: none;">
			<div class='span9'>
				<?php for ($i = 0; $i < 18; $i++) { ?>
				<?php if (empty($array_slide2[$i]['photo_link'])) { ?>
				<a href="<?php echo $array_slide2[$i]['article_link']; ?>">
					<div class='artwork'>
						<div class='glow'></div>
						<div class='text'>
							<span class='artist'><?php echo $array_slide2[$i]['nama']; ?></span>
						</div>
					</div>
				</a>
				<?php } else { ?>
				<a href="<?php echo $array_slide2[$i]['article_link']; ?>">
					<div class='artwork'>
						<div class='glow'></div>
						<img src="<?php echo $array_slide2[$i]['photo_link']; ?>" />
					</div>
				</a>
				<?php } ?>
				<?php } ?>
			</div>
			<div class='slider-sidebar span3'>
				<?php $this->load->view( 'website/common/register' ); ?>
				
				<?php for ($i = 18; $i <= 19; $i++) { ?>
				<?php if (empty($array_slide2[$i]['photo_link'])) { ?>
				<a href="<?php echo $array_slide2[$i]['article_link']; ?>">
					<div class='artwork'>
						<div class='glow'></div>
						<div class='text'>
							<span class='artist'><?php echo $array_slide2[$i]['nama']; ?></span>
						</div>
					</div>
				</a>
				<?php } else { ?>
				<a href="<?php echo $array_slide2[$i]['article_link']; ?>">
					<div class='artwork'>
						<div class='glow'></div>
						<img src="<?php echo $array_slide2[$i]['photo_link']; ?>" />
					</div>
				</a>
				<?php } ?>
				<?php } ?>
			</div>
		</li>
	</ul>
	
	<ol class="flex-control-nav flex-control-paging"><li><a class="flex-active">1</a></li><li><a class="">2</a></li></ol>
	</div></div></div>
</div>

<section id='main'>
	<div class='container'>
		<div class='row'>
			<div class='span9 content'>
				<div class='new-items span6 no-margin'>
					<h1>Lowongan Kerja Terbaru</h1>
					<hr />
					<?php foreach ($array_vacancy as $key => $vacancy) { ?>
						<div class="jp-audio custom"><a href="<?php echo $vacancy['vacancy_link']; ?>"><?php echo $vacancy['nama']; ?></a></div>
					<?php } ?>
					<a href="<?php echo base_url('listing'); ?>" class='btn btn-main'>Lihat Semua</a>
				</div>
				<div class='weekly-features span3'>
					<h1>Artikel Dunia Kerja </h1>
					<hr />
					
					<?php if (count($array_article) > 0) { ?>
					<figure><img src="<?php echo $array_article[0]['photo_link']; ?>" /></figure>
					<h2><a href="<?php echo $array_article[0]['article_link']; ?>"><?php echo $array_article[0]['nama']; ?></a></h2>
					<p><?php echo $array_article[0]['desc_short']; ?></p>
					<?php } ?>
				</div>
			</div>
			<aside class='span3'>
				<div class='inner'>
					<?php $this->load->view( 'website/common/site_banner' ); ?>
				</div>
			</aside>
		</div>
	</div>
</section>

<?php $this->load->view( 'website/common/footer' ); ?>