<?php
	$page_active = get_page();
	$list_page = base_url('listing');
	$page_item = 10;
	
	$param_vacancy = array(
		'publish_date' => $this->config->item('current_datetime'),
		'filter' => '[{"type":"numeric","comparison":"eq","value":"'.VACANCY_STATUS_APPROVE.'","field":"Vacancy.vacancy_status_id"}]',
		'limit' => $page_item
	);
	$array_vacancy = $this->Vacancy_model->get_array($param_vacancy);
	$page_count = ceil($this->Vacancy_model->get_count() / $page_item);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<section id='main'>
	<div class='container'><div class='row'>
		<div class='span9 content grey'>
			<h1>List Lowongan</h1>
			<div class='options-line'>
				<div class='breadcrumb-container'>
					<ul class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Index</a> <span class="divider">&raquo;</span></li>
						<li class="active">Listing</li>
					</ul>
				</div>
				<div class='buttons'>
					<div class="btn-group">
						<button class="btn dropdown-toggle" data-toggle="dropdown">Sort By Region <span class="caret"></span></button>
					</div>
				</div>
			</div>
			
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
									<li id="m_tipe"><strong>Tipe Pekerjaan</strong> : <?php echo $vacancy['jenis_pekerjaan_nama']; ?></li>
									<li id="m_fuel"><strong>Lokasi</strong> : <?php echo $vacancy['kota_nama']; ?></li>
								</ul>
							</div>
						</div>
						<div class="options">
							<div class="star-rating"><?php echo GetFormatDate($vacancy['close_date'], array( 'FormatDate' => 'd-m-Y' )); ?></div>
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
						<?php $page_link = $list_page.'/page_'.$page_counter; ?>
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
				<?php $this->load->view( 'website/common/site_banner' ); ?>
			</div>
		</aside>
	</div></div>
</section>

<?php $this->load->view( 'website/common/footer' ); ?>