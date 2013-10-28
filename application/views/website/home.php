<?php
	$seeker_login = $this->Seeker_model->is_login();
	$company_login = $this->Company_model->is_login();
	
	$param_slide1 = array(
		'sort' => '{"is_custom":"1","query":"RAND()"}', 'limit' => 20
	);
	$array_slide1 = $this->Company_model->get_array($param_slide1);
	
	$param_slide2 = array(
		'vacancy_status_id' => VACANCY_STATUS_APPROVE,
		'publish_date' => $this->config->item('current_datetime'),
		'sort' => '[{"property":"publish_date","direction":"DESC"}]',
		'limit' => 20
	);
	$array_slide2 = $this->Vacancy_model->get_array($param_slide2);
	
	$param_vacancy = array(
		'vacancy_status_id' => VACANCY_STATUS_APPROVE,
		'publish_date' => $this->config->item('current_datetime'),
		'sort' => '[{"property":"publish_date","direction":"DESC"}]',
		'limit' => 2
	);
	$array_vacancy = $this->Vacancy_model->get_array($param_vacancy);
	
	$param_article = array(
		'filter' => '[{"type":"numeric","comparison":"eq","value":"'.ARTICLE_PUBLISH.'","field":"Article.article_status_id "}]',
		'sort' => '[{"property":"publish_date","direction":"DESC"}]', 'limit' => 1
	);
	$array_article = $this->Article_model->get_array($param_article);
	
	$param_seeker = array( 'is_active' => 1, 'with_alias' => 1, 'sort' => '{"is_custom":"1","query":"RAND()"}', 'limit' => 5 );
	$array_seeker = $this->Seeker_model->get_array($param_seeker);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<div id='slider' class='hidden-phone'>
	<div class='container'><div class='row'><div class='slider'>
	<ul class='slides'>
		<li class="slide-item">
			<div class='span9'><br/>
				<div id="content">
					<h1>Over 225 million professionals use Parapekerja to exchange information, ideas and opportunities</h1>
					<ul>
						<li id="reconnect">Stay informed about your contacts and industry</li>
						<li id="answers">Find the people &amp; knowledge you need to achieve your goals</li>
						<li id="power">Control your professional identity online</li>
					</ul>
				</div>
			</div>
			<div class='slider-sidebar span3'>
				<?php $this->load->view( 'website/common/register' ); ?>
				
				<?php for ($i = 1; $i <= 2; $i++) { ?>
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
	</ul>
	</div></div></div>
</div>
<!-- YANG DI TAMBAHIN FOTO PROFILE YANG INI 
<div style="background-color:#fff">
	<div class='container'><div class='row'> 
	<ul class='slides'>
		<li class="slide-item">
			<div class='span9'><br/>
			<div style="border-bottom: 1px inset rgb(187, 51, 0); margin-bottom: 20px; padding: 5px 5px 5px 30px;">
			Baru Bergabung</div>
				<div class="span9">
				 
				 
                               
                                    <a href="#">
                                        <div class="artwork">
                                            <div class="glow"></div>
                                            <img alt="" src="img/artwork03.png">
                                        </div>
                                    </a>
									
									 <a href="#">
                                        <div class="artwork">
                                            <div class="glow"></div>
                                            <img alt="" src="img/artwork03.png">
                                        </div>
                                    </a>
									
									 <a href="#">
                                        <div class="artwork">
                                            <div class="glow"></div>
                                            <img alt="" src="img/artwork03.png">
                                        </div>
                                    </a>
									
									 <a href="#">
                                        <div class="artwork">
                                            <div class="glow"></div>
                                            <img alt="" src="img/artwork03.png">
                                        </div>
                                    </a>
									
									 <a href="#">
                                        <div class="artwork">
                                            <div class="glow"></div>
                                            <img alt="" src="img/artwork03.png">
                                        </div>
                                    </a>
									
									 <a href="#">
                                        <div class="artwork">
                                            <div class="glow"></div>
                                            <img alt="" src="img/artwork03.png">
                                        </div>
                                    </a>
									
									 <a href="#">
                                        <div class="artwork">
                                            <div class="glow"></div>
                                            <img alt="" src="img/artwork03.png">
                                        </div>
                                    </a>
                                   
								     <a href="#">
                                        <div class="artwork">
                                            <div class="glow"></div>
                                            <img alt="" src="img/artwork03.png">
                                        </div>
                                    </a>
									
									  <a href="#">
                                        <div class="artwork">
                                            <div class="glow"></div>
                                            <img alt="" src="img/artwork03.png">
                                        </div>
                                    </a>
									
									  <a href="#">
                                        <div class="artwork">
                                            <div class="glow"></div>
                                            <img alt="" src="img/artwork03.png">
                                        </div>
                                    </a>
                                
                                
                                   
                                   </div>
			</div>
				
			<div class='slider-sidebar span3'>
			<div style="border-bottom: 1px inset rgb(187, 51, 0); margin-bottom: 20px; padding: 5px 5px 5px 30px; margin-top: 20px;">
			biarin saja</div>
			</div>
		</li>
	</ul>
	 </div></div>
</div>
-->
<?php if ($seeker_login || $company_login) { ?>
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
					
					<h1>Random Member</h1>
					<hr />
					<?php foreach ($array_seeker as $key => $row) { ?>
						<?php if (empty($row['full_name'])) { ?>
							<?php continue; ?>
						<?php } ?>
						
						<div class="jp-audio custom"><a href="<?php echo $row['profile_link']; ?>"><?php echo $row['full_name']; ?></a></div>
					<?php } ?>
				</div>
				<div class='weekly-features span3'>
					<h1>Artikel Parapekerja </h1>
					<hr />
					
					<?php if (count($array_article) > 0) { ?>
					<figure><a href="<?php echo $array_article[0]['article_link']; ?>"><img src="<?php echo $array_article[0]['photo_link']; ?>" /></a></figure>
					<h2><a href="<?php echo $array_article[0]['article_link']; ?>" title="<?php echo $array_article[0]['nama']; ?>"><?php echo $array_article[0]['nama']; ?></a></h2>
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
<?php } ?>

<?php $this->load->view( 'website/common/footer' ); ?>