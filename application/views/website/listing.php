<?php
	$request_uri = $_SERVER['REQUEST_URI'];
	preg_match('/\/(search)/i', $request_uri, $match);
	$is_search = false;
	if (!empty($match[1]) && $match[1] == 'search') {
		$is_search = true;
	}
	
	// url keyword
	preg_match('/search\/([\w\-]+)/i', $_SERVER['REQUEST_URI'], $match);
	$raw_keyword = (!empty($match[1])) ? $match[1] : '';
	$raw_keyword = str_replace('-', ' ', $raw_keyword);
	
	// set data
	$keyword = (!empty($_POST['keyword'])) ? $_POST['keyword'] : $raw_keyword;
	$array_propinsi = $this->Propinsi_model->get_array(array( 'negara_id' => NEGARA_INDONESIA_ID, 'limit' => 250 ));
	$array_position = $this->Position_model->get_array(array( 'limit' => 250 ));
	$array_jenjang = $this->Jenjang_model->get_array();
	$array_jenis_pekerjaan = $this->Jenis_Pekerjaan_model->get_array();
	
	// page
	$page_active = get_page();
	$list_page = base_url('listing');
	$page_item = 10;
	
	// default data
	$_POST['keyword_category'] = (empty($_POST['keyword_category'])) ? 0 : $_POST['keyword_category'];
	
	// set search param
	if (!empty($keyword) && isset($_POST['keyword_category'])) {
		if ($_POST['keyword_category'] == 0) {
			$filter[] = array( 'type' => 'custom', 'field' => "(Vacancy.nama LIKE '%".$keyword."%' OR Company.nama LIKE '%".$keyword."%')" );
		} else if ($_POST['keyword_category'] == 1) {
			$filter[] = array( 'type' => 'string', 'value' => $keyword, 'field' => 'Vacancy.nama' );
		} else if ($_POST['keyword_category'] == 2) {
			$filter[] = array( 'type' => 'string', 'value' => $keyword, 'field' => 'Company.nama' );
		}
	} else if (!empty($keyword)) {
		$filter[] = array( 'type' => 'custom', 'field' => "(Vacancy.nama LIKE '%".$keyword."%' OR Company.nama LIKE '%".$keyword."%')" );
	}
	if (!empty($_POST['propinsi_id'])) {
		$filter[] = array( 'type' => 'numeric', 'comparison' => 'eq', 'value' => $_POST['propinsi_id'], 'field' => 'Kota.propinsi_id' );
	}
	if (!empty($_POST['jenjang_id'])) {
		$filter[] = array( 'type' => 'numeric', 'comparison' => 'eq', 'value' => $_POST['jenjang_id'], 'field' => 'Vacancy.jenjang_id' );
	}
	if (!empty($_POST['jenis_pekerjaan_id'])) {
		$filter[] = array( 'type' => 'numeric', 'comparison' => 'eq', 'value' => $_POST['jenis_pekerjaan_id'], 'field' => 'Vacancy.jenis_pekerjaan_id' );
	}
	if (!empty($_POST['position'])) {
		$filter[] = array( 'type' => 'string', 'value' => $_POST['position'], 'field' => 'Vacancy.position' );
	}
	
	$filter[] = array( 'type' => 'numeric', 'comparison' => 'eq', 'value' => VACANCY_STATUS_APPROVE, 'field' => 'Vacancy.vacancy_status_id' );
	$param_vacancy = array(
		'close_date' => $this->config->item('current_date'),
		'publish_date' => $this->config->item('current_datetime'),
		'filter' => json_encode($filter),
		'start' => ($page_active - 1) * $page_item,
		'limit' => $page_item
	);
	
	$array_vacancy = $this->Vacancy_model->get_array($param_vacancy);
	$page_count = ceil($this->Vacancy_model->get_count() / $page_item);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<section id='main'>
	<input type="hidden" name="is_search" value="<?php echo ($is_search) ? 1 : 0; ?>" />
	
	<div class='container'><div class='row'>
		<div class='span9 content grey'>
			<h1>List Lowongan</h1>
			<div class='options-line' style="position: relative;">
				<div class='breadcrumb-container'>
					<ul class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Index</a> <span class="divider">&raquo;</span></li>
						<li class="active">Listing</li>
					</ul>
				</div>
				<div class='buttons'>
					<div class="btn-group">
						<button class="btn show-region">Sort By Region</button>
						<?php if($is_search) { ?>
						<button class="btn show-search">Advance Search</button>
						<?php } ?>
					</div>
				</div>
				
				<div id="cnt-region" class="hide">
					<div class="border-green">
					<div class="cnt-option">
						<div class="item"><a>Seluruh Propinsi</a></div>
						<?php foreach ($array_propinsi as $propinsi) { ?>
						<div class="item"><a><?php echo $propinsi['nama']; ?><span class="hide"><?php echo json_encode($propinsi); ?></span></a></div>
						<?php } ?>
					</div>
					</div>
				</div>
			</div>
			
			<div id="advance-search" class="hide"><form action="<?php echo base_url('search'); ?>" method="post">
				<input type="hidden" name="page_no" value="1" />
				
				<div><strong>Kata Kunci</strong> - Sebuah kata atau frase yang sesuai dengan lowongan yang sesuai</div>
				<div class="cnt-border">
					<div style="padding: 2px 0;"><input type="text" name="keyword" placeholder="Masukkan nama perusahaan" value="<?php echo $keyword; ?>" style="width: 80%;" /></div>
					<div style="padding: 2px 0;">
						<div style="float: left; padding: 0 5px 0 0;">Cari di</div>
						<label><input type="radio" name="keyword_category" value="0" class="radio" <?php echo (@$_POST['keyword_category'] == '0') ? 'checked' : ''; ?>  /> Seluruh iklan lowongan</label>
						<label><input type="radio" name="keyword_category" value="1" class="radio" <?php echo (@$_POST['keyword_category'] == '1') ? 'checked' : ''; ?> /> Judul Lowongan</label>
						<label><input type="radio" name="keyword_category" value="2" class="radio" <?php echo (@$_POST['keyword_category'] == '2') ? 'checked' : ''; ?> /> Nama Perusahaan</label>
					</div>
					<div style="clear: both;"></div>
				</div>
				<div><strong>Lokasi</strong> - Di manakah Anda ingin bekerja</div>
				<div class="cnt-border">
					<div style="padding: 2px 0;"><select style="width: 50%;" name="propinsi_id">
						<?php echo ShowOption(array( 'Array' => $array_propinsi, 'ArrayID' => 'id', 'ArrayTitle' => 'nama', 'OptAll' => true, 'WithEmptySelect' => 0, 'Selected' => @$_POST['propinsi_id'] )); ?>
					</select></div>
				</div>
				<div><strong>Spesialisasi</strong> - Apa fungsi spesifik atau kemahiran dari lowongan yang Anda inginkan ?</div>
				<div class="cnt-border">
					<div style="padding: 2px 0;"><select style="width: 50%;" name="position">
						<?php echo ShowOption(array( 'Array' => $array_position, 'ArrayID' => 'nama', 'ArrayTitle' => 'nama', 'OptAll' => true, 'WithEmptySelect' => 0, 'Selected' => @$_POST['position'] )); ?>
					</select></div>
				</div>
				<div><strong>Tipe Pendidikan</strong></div>
				<div class="cnt-border">
					<div style="padding: 2px 0;"><select style="width: 50%;" name="jenjang_id">
						<?php echo ShowOption(array( 'Array' => $array_jenjang, 'ArrayID' => 'id', 'ArrayTitle' => 'nama', 'OptAll' => true, 'WithEmptySelect' => 0, 'Selected' => @$_POST['jenjang_id'] )); ?>
					</select></div>
				</div>
				<div><strong>Tipe Pekerjaan</strong></div>
				<div class="cnt">
					<div style="padding: 2px 0;"><select style="width: 50%;" name="jenis_pekerjaan_id">
						<?php echo ShowOption(array( 'Array' => $array_jenis_pekerjaan, 'ArrayID' => 'id', 'ArrayTitle' => 'nama', 'OptAll' => true, 'WithEmptySelect' => 0, 'Selected' => @$_POST['jenis_pekerjaan_id'] )); ?>
					</select></div>
				</div>
				<div style="padding: 0 50px 25px 0; text-align: right;"><input type="submit" class="btn" value="Cari Lowongan" /></div>
			</form></div>
			<script>
				$('#advance-search form').submit(function() {
					var name = Func.GetName($('#advance-search [name="keyword"]').val());
					var action = $('#advance-search form').attr('action') + '/' + name;
					$('#advance-search form').attr('action', action);
				});
			</script>
			
			<?php if (count($array_vacancy) > 0) { ?>
			<div class='new-albums list' style="width: 100%;">
				<?php foreach ($array_vacancy as $vacancy) { ?>
				<div class="new-album-box">
					<div style="padding-left: 15px;"><?php echo $vacancy['kategori_nama'].' - '.$vacancy['subkategori_nama']; ?></div>
					<div class="inner" style="border-left: none; border-right: none;">
						<figure><img src="<?php echo $vacancy['company_logo_link']; ?>" style="width: 100px; height: 100px;" /></figure>
						<div class="details">
							<h2><a href="<?php echo $vacancy['vacancy_link']; ?>"><?php echo $vacancy['nama']; ?></a></h2>
							<p><?php echo $vacancy['company_nama'].' - '.$vacancy['company_kota_nama']; ?></p>
							<div class="extra-field">
								<ul>
									<li id="m_tipe"><strong>Tipe Pekerjaan</strong> : <?php echo $vacancy['jenis_pekerjaan_nama']; ?></li>
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
						<?php $page_link = $list_page.'/page_'.$page_counter; ?>
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
				<?php $this->load->view( 'website/common/site_banner' ); ?>
			</div>
		</aside>
	</div></div>
</section>

<script>
$('.show-region').click( function() { $('#cnt-region').show(); } );
$('#cnt-region').hover( function() { $('#cnt-region').show(); }, function() { $('#cnt-region').hide(); } );
$('.show-search').click(function() {
	var display = $('#advance-search').css('display');
	if (display == 'none') {
		$('#advance-search').slideDown('slow');
	} else {
		$('#advance-search').slideUp('slow');
	}
});

// form
$('.cnt-option .item a').click(function() {
	var raw = $(this).find('.hide').text();
	if (raw == '') {
		var propinsi = { id: 0 };
	} else {
		eval('var propinsi = ' + raw);
	}
	
	$('[name="propinsi_id"]').val(propinsi.id);
	$('#advance-search form').submit();
});

var is_search = $('[name="is_search"]').val();
if (is_search == 1) {
	$('.standard-pagination a').click(function(e) {
		e.preventDefault();
		
		var page_no = $(this).text();
		$('[name="page_no"]').val(page_no);
		$('#advance-search form').submit();
	});
}
</script>

<?php $this->load->view( 'website/common/footer' ); ?>