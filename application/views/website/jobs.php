<?php
	$request_uri = $_SERVER['REQUEST_URI'];
	$request_uri = preg_replace('/\/page_[0-9]+$/i', '', $request_uri);
	$temp = preg_replace('/.+jobs\//i', '', $request_uri);
	$array_temp = explode('/', $temp);
	
	$kategori = $this->Kategori_model->get_by_id( array( 'alias' => @$array_temp[0] ) );
	$subkategori = $this->Subkategori_model->get_by_id( array( 'alias' => @$array_temp[1] ) );
	
	// page
	$page_jobs = base_url('jobs');
	$page_item = 10;
	$page_active = get_page();
	
	// breadcrump
	$title = 'Jobs';
	$array_tag = array();
	$breadcrump[] = array( 'title' => 'Index', 'link' => base_url() );
	$array_button = array( array( 'title' => 'RSS', 'link' => base_url('jobs/rss') ) );
	
	if (count($kategori) > 0) {
		$page_jobs = $kategori['link'];
		$title .= ' - '.$kategori['nama'];
		$breadcrump[] = array( 'title' => $kategori['nama'], 'link' => $kategori['link'] );
		$array_button = array( array( 'title' => 'RSS', 'link' => $kategori['link_rss'] ) );
		
		// tag
		$array_tag = $this->Kategori_Tag_model->get_array(array( 'kategori_id' => $kategori['id'] ));
	}
	if (count($kategori) > 0 && count($subkategori) > 0) {
		$page_jobs = $subkategori['link'];
		$title .= ' - '.$subkategori['nama'];
		$breadcrump[] = array( 'title' => $subkategori['nama'], 'link' => $subkategori['link'] );
		$array_button = array( array( 'title' => 'RSS', 'link' => $subkategori['link_rss'] ) );
		
		// tag
		$array_tag = $this->Subkategori_Tag_model->get_array(array( 'subkategori_id' => $subkategori['id'] ));
	}
	
	// jobs
	$param_vacancy = array(
		'vacancy_status_id' => VACANCY_STATUS_APPROVE,
		'publish_date' => $this->config->item('current_datetime'),
		'kategori_id' => @$kategori['id'],
		'subkategori_id' => @$subkategori['id'],
		'sort' => '[{"property":"publish_date","direction":"DESC"}]',
		'start' => ($page_active - 1) * $page_item,
		'limit' => $page_item
	);
	$array_vacancy = $this->Vacancy_model->get_array($param_vacancy);
	$page_count = ceil($this->Vacancy_model->get_count() / $page_item);
?>

<?php $this->load->view( 'website/common/meta', array( 'title' => $title ) ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<section id='main'>
	<div class='container'><div class='row'>
		<div class='span9 content'>
			<div class='main-top span9'>
				<?php $this->load->view( 'website/common/breadcrumb', array( 'array_breadcrumb' => $breadcrump, 'array_button' => $array_button,  'title' => 'List Lowongan' ) ); ?>
			</div>
			
			<?php if (count($array_vacancy) > 0) { ?>
			<div class='new-albums list' style="width: 100%;">
				<?php foreach ($array_vacancy as $vacancy) { ?>
				<div class="new-album-box">
					<div style="padding-left: 15px;"><?php echo $vacancy['kategori_nama'].' - '.$vacancy['subkategori_nama']; ?></div>
					<div class="inner" style="border-left: none; border-right: none;">
						<figure><img src="<?php echo $vacancy['company_logo_link']; ?>" /></figure>
						<div class="details">
							<h2><a href="<?php echo $vacancy['vacancy_link']; ?>"><?php echo $vacancy['nama']; ?></a></h2>
							<p><?php echo $vacancy['company_nama'].' - '.$vacancy['company_kota_nama']; ?></p>
							<div class="extra-field">
								<ul>
									<li id="m_fuel"><strong>Tipe Pekerjaan</strong> : <?php echo $vacancy['jenis_pekerjaan_nama']; ?></li>
									<li id="m_fuel"><strong>Lokasi</strong> : <?php echo $vacancy['kota_nama']; ?></li>
									<li id="m_fuel"><strong>Batas Waktu</strong> : <?php echo GetFormatDate($vacancy['close_date'], array( 'FormatDate' => 'd-m-Y' )); ?></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			
			<div class='standard-pagination'>
				<ul>
					<?php for ($i = -5; $i <= 5; $i++) { ?>
						<?php $class = ($i == 0) ? 'active' : ''; ?>
						<?php $page_counter = $page_active + $i; ?>
						<?php $page_link = $page_jobs.'/page_'.$page_counter; ?>
						<?php if ($page_counter > 0 && $page_counter <= $page_count) { ?>
						<li class='<?php echo $class; ?>'><a href='<?php echo $page_link; ?>' class='btn'><?php echo $page_counter; ?></a></li>
						<?php } ?>
					<?php } ?>
				</ul>
			</div>
			<?php } else { ?>
			<div class='new-albums list' style="width: 100%; padding: 25px 15px;">
				Maaf, tidak ada hasil pencarian yang ditemukan.
			</div>
			<?php } ?>
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