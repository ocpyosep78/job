<?php
	// breadcrump
	$breadcrump[] = array( 'title' => 'Index', 'link' => base_url() );
	$breadcrump[] = array( 'title' => 'Company', 'link' => '#' );
	$breadcrump[] = array( 'title' => $company['nama'], 'link' => $company['company_link'] );
	
	$param_vacancy = array(
		'company_id' => $company['id'],
		'publish_date' => $this->config->item('current_datetime'),
		'filter' => '[{"type":"numeric","comparison":"eq","value":"'.VACANCY_STATUS_APPROVE.'","field":"Vacancy.vacancy_status_id"}]',
		'limit' => 15
	);
	$array_vacancy = $this->Vacancy_model->get_array($param_vacancy);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<style>
.buy a { text-decoration: none; }
</style>

<section id='main'>
	<div class='container'><div class='row'>
		<div class='span9 content'>
			<div class='main-top span9'>
				<?php $this->load->view( 'website/common/breadcrumb', array( 'array_breadcrumb' => $breadcrump, 'sub_title' => $company['nama'] ) ); ?>
			</div>
			<div class='span9 no-margin album-article'>
				<figure>
					<img src="<?php echo $company['logo_link']; ?>" alt="" />
				</figure>
				
				<div class='info-line'><span>Industry : </span> <?php echo $company['industri_nama']; ?></div>
				<div class='info-line'><span>Company Address : </span> <?php echo $company['address']; ?></div>
				<div class='info-line'><span>City: </span> <?php echo $company['kota_nama']; ?></div>
				<div class='info-line'><span>Sales: </span> <?php echo $company['sales']; ?></div>
				<div class='buy'>
					<a href="<?php echo $company['google_map']; ?>" target="_blank"><span class='price'>Lihat Peta</span></a>
					<span class='price'>Laporkan</span>
					<a href="#" title='Subscribe' class='btn btn-blue buy-album'>Subscribe</a>
				</div>
				
				<p class='description'><?php echo $company['description']; ?></p>
			</div>
			<div class='span9 album-files no-margin'>
				<h1>Lowongan Yang Tersedia</h1>
				<hr />
				
				<?php if (count($array_vacancy) == 0) { ?>
				<div class="jp-audio custom">Saat Ini tidak ada lowongan yang tersedia</div>
				<?php } else { ?>
				<?php foreach ($array_vacancy as $vacancy) { ?>
				<?php } ?>
				<div class="jp-audio custom"><a href="<?php echo $vacancy['vacancy_link']; ?>"><?php echo $vacancy['nama']; ?></a></div>
				<?php } ?>
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

<?php $this->load->view( 'website/common/footer' ); ?>