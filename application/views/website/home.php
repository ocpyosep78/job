<?php
	$param_company = array(
		'filter' => '[{"type":"numeric","comparison":"not","value":"","field":"Company.logo"}]',
		'sort' => '{"is_custom":"1","query":"RAND()"}', 'limit' => 40
	);
	$array_company = $this->Company_model->get_array($param_company);
	
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
	<div class='container'><div class='row'><div class='slider'><ul class='slides'>
		<li>
			<div class='span9'>
				<?php $is_text = false; ?>
				<?php for ($i = 0; $i < 18; $i++) { ?>
				<?php if ($is_text || ($i % 5) == 0) { ?>
				<a href="">
					<div class='artwork'>
						<div class='glow'></div>
						<div class='text'>
							<span class='artist'>Metallica</span> <br />
							<span class='song'>The Unforgiven</span> <br />
							<span class='year'>2001</span>
						</div>
					</div>
				</a>
				<?php } else { ?>
				<a href="#">
					<div class='artwork'>
						<div class='glow'></div>
						<img src="<?php echo $array_company[$i]['logo_link']; ?>" />
					</div>
				</a>
				<?php } ?>
				<?php } ?>
			</div>
			<div class='slider-sidebar span3'>
				<?php $this->load->view( 'website/common/register' ); ?>
				
				<a href="#">
					<div class='artwork'>
						<div class='glow'></div>
						<img src='<?php echo $array_company[18]['logo_link']; ?>' />
					</div>
				</a>
				<a href="#">
					<div class='artwork'>
						<div class='glow'></div>
						<img src='<?php echo $array_company[19]['logo_link']; ?>' />
					</div>
				</a>
			</div>
		</li>
		<li>
			<div class='span9'>
				<?php $is_text = false; ?>
				<?php for ($i = 20; $i < 38; $i++) { ?>
				<?php if ($is_text || ($i % 4) == 0) { ?>
				<a href="">
					<div class='artwork'>
						<div class='glow'></div>
						<div class='text'>
							<span class='artist'>Metallica</span> <br />
							<span class='song'>The Unforgiven</span> <br />
							<span class='year'>2001</span>
						</div>
					</div>
				</a>
				<?php } else { ?>
				<a href="#">
					<div class='artwork'>
						<div class='glow'></div>
						<img src="<?php echo $array_company[$i]['logo_link']; ?>" />
					</div>
				</a>
				<?php } ?>
				<?php } ?>
			</div>
			<div class='slider-sidebar span3'>
				<?php $this->load->view( 'website/common/register' ); ?>

				<a href="#">
					<div class='artwork'>
						<div class='glow'></div>
						<img src='<?php echo $array_company[38]['logo_link']; ?>' />
					</div>
				</a>
				<a href="#">
					<div class='artwork'>
						<div class='glow'></div>
						<img src='<?php echo $array_company[39]['logo_link']; ?>' />
					</div>
				</a>
			</div>
		</li>
	</ul></div></div></div>
</div>

<section id='main'>
	<div class='container'>
		<div class='row'>
			<div class='span9 content'>
				<div class='new-items span6 no-margin'>
					<h1>Lowongan Kerja Terbaru</h1>
					<hr />
					<?php foreach ($array_vacancy as $key => $vacancy) { ?>
						<div class="jp-audio custom"><a><?php echo $vacancy['nama']; ?></a></div>
					<?php } ?>
					<!-- <a href="#" class='btn btn-main'>Lihat Semua</a>	-->
				</div>
				<div class='weekly-features span3'>
					<h1>Artikel Dunia Kerja </h1>
					<hr />
					
					<?php if (count($array_article) > 0) { ?>
					<figure><img src="<?php echo $array_article[0]['photo_link']; ?>" /></figure>
					<h2><a href="#"><?php echo $array_article[0]['nama']; ?></a></h2>
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