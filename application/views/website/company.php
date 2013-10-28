<?php
	// check report
	if (!empty($_POST['action'])) {
		$result = array();
		
		if ($_POST['action'] == 'report') {
			$result = $this->Report_model->update($_POST);
		}
		
		echo json_encode($result);
		exit;
	}
	
	// get user
	$user = get_user();
	
	// breadcrump
	$breadcrump[] = array( 'title' => 'Index', 'link' => base_url() );
	$breadcrump[] = array( 'title' => 'Company', 'link' => '#' );
	$breadcrump[] = array( 'title' => $company['nama'], 'link' => $company['company_link'] );
	
	$param_vacancy = array(
		'close_date' => $this->config->item('current_date'),
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

<div id="popup_box">
	<h3>Report Company</h3>
	<hr />
	
	<div class="content message hide">Terima kasih, report anda berhasil dikirim</div>
	<div class="content confirm hide">
		<input type="hidden" name="company_id" value="<?php echo $company['id']; ?>" />
		<div>Silahkan masukkan report anda pada form berikut :</div>
		<div><textarea name="content" style="width: 385px; height: 50px;"></textarea></div>
		<div><input type="submit" name="submit" value="Kirim" style="width: 125px;"/></div>
	</div>
	<div class="content default">Please <a href="<?php echo base_url('login'); ?>">login</a> to report</div>
	
	<a id="popupBoxClose">Close</a>	
</div>

<section id='main'>
	<div class="hide">
		<div class="cnt-user"><?php echo json_encode($user); ?></div>
	</div>
	
	<div class='container'><div class='row'>
		<div class='span9 content'>
			<div class='main-top span9'>
				<?php $this->load->view( 'website/common/breadcrumb', array( 'array_breadcrumb' => $breadcrump, 'sub_title' => $company['nama'] ) ); ?>
			</div>
			<div class='span9 no-margin album-article'>
				<div class="hide subscribe-message" style="text-align: center; padding: 10px 0px 15px; font-size: 14px; color: rgb(255, 0, 0);"></div>
				
				<figure><img src="<?php echo $company['logo_link']; ?>" style="max-width: 150px;" /></figure>
				<div class='info-line'><span>Industry : </span> <?php echo @$company['industri_nama']; ?></div>
				<div class='info-line'><span>Company Address : </span> <?php echo $company['address']; ?></div>
				<div class='info-line'><span>City: </span> <?php echo @$company['kota_nama']; ?></div>
				<div class='info-line'><span>Sales: </span> <?php echo $company['sales']; ?></div>
				
		 

				<p class='description'><?php echo $company['description']; ?></p>
			</div>

 

			<div class='span9 album-files no-margin'>
	<div style='float:right;margin-top:12px;font-size:15px;'>
					<a href="<?php echo $company['google_map']; ?>" target="_blank"><span class='price'>Lihat Peta</span></a>
				<!--	<span class="cursor btn-report">Laporkan</span> -->
					<a title='Subscribe' class='cursor btn-report'>Laporkan</a>
					<a title='Subscribe' class='cursor buy-album'>Subscribe</a>
					<a href="<?php echo $company['company_link_rss']; ?>" title='RSS' class='btn btn-blue' style="margin: 0 0 0 10px;">RSS</a>
	</div>
				<h1>Lowongan Yang Tersedia</h1>
				<hr />
				
				<?php if (count($array_vacancy) == 0) { ?>
				<div class="jp-audio custom">Saat Ini tidak ada lowongan yang tersedia</div>
				<?php } else { ?>
				<?php foreach ($array_vacancy as $vacancy) { ?>
				<?php } ?>
				<div class="jp-audio custom"><a href="<?php echo $vacancy['vacancy_link']; ?>"><?php echo $vacancy['nama']; ?></a></div>
				<?php } ?>
			</div> <br/><br/>
		</div>
		
		<aside class='span3'>
			<div class='inner'>
				<?php $this->load->view( 'website/common/register' ); ?>
				<?php $this->load->view( 'website/common/site_banner' ); ?>
			</div>
		</aside>
	</div></div>
</section>

<script type="text/javascript">
$(document).ready( function() {
	var raw_user = $('.cnt-user').text();
	eval('var user = ' + raw_user);
	
	// init popup
	if (user.email != null) {
		$('#popup_box .confirm').show();
		$('#popup_box .default').hide();
	}
	
	// form report
	$('#popup_box [name="submit"]').click(function() {
		var param = { action: 'report', email: user.email, company_id: $('[name="company_id"]').val(), content: $('[name="content"]').val() };
		if (param.content.length == 0) {
			alert('Harap mengisi report Anda pada Textbox');
			return false;
		}
		
		Func.ajax({ url: window.location.href, param: param, callback: function(result) {
			if (result.status == 1) {
				$('#popup_box .content').hide();
				$('#popup_box .message').fadeIn("slow");
			}
		} });
	});
	
	// form subscribe
	$('.buy-album').click(function() {
		if (user.email == null) {
			show_dialog({ title: 'Subscribe' });
			return;
		}
		
		Func.ajax({ url: web.host + 'ajax', param: { action: 'subscribe', jenis_subscribe_id: 3, email: user.email }, callback: function(result) {
			$(".subscribe-message").html('Anda berhasil berlangganan'); 
			$(".subscribe-message").slideDown('slow');
		} });
	});
	
	// popup
	$('.btn-report').click( function() { show_dialog({}); });
	$('#popupBoxClose').click( function() { hide_dialog(); });
	$('#container').click( function() { hide_dialog(); });
	function hide_dialog() {
		$('#popup_box').fadeOut("slow");
		$("#container").css({ "opacity": "1" }); 
	}
	function show_dialog(p) {
		p.title = (p.title == null) ? 'Report Company' : p.title;
		
		// render html
		$('#popup_box h3').text(p.title);
		
		$('#popup_box').fadeIn("slow");
		$("#container").css({ "opacity": "0.3" }); 		
	}
});
</script>

<?php $this->load->view( 'website/common/footer' ); ?>