<?php
	$seeker = $this->Seeker_model->get_session();
	$is_login = $this->Seeker_model->is_login();
	$is_apply = false;
	if ($is_login) {
		$is_apply = $this->Apply_model->is_apply(array( 'seeker_id' => $seeker['id'], 'vacancy_id' => $vacancy['id'] ));
	}
?>

<html>
<head>
	<title><?php echo $vacancy['nama'].' - '.$vacancy['company_nama']; ?></title>
	<script type="text/javascript">var web = { host: '<?php echo base_url(); ?>' };</script>
	<script type="text/javascript" src="<?php echo base_url('static/js/jquery-1.8.2.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('static/js/common.js'); ?>"></script>
	<style>
		a { text-decoration: none; }
		img { border: none; }
	</style>
</head>
<body style="background: #D1D3D4; font-family: arial;">
<input type="hidden" name="vacancy_id" value="<?php echo $vacancy['id']; ?>" />

<table border="0" cellpadding="0" cellspacing="0" align="center" width="700"><tbody><tr><td><table border="0" cellpadding="5" cellspacing="0" align="center" width="700"><tbody><tr>
	<td><div style="text-align: center; color: #000000; font-size: 12px;">
		Advertised: <?php echo $vacancy['publish_date']; ?> | 
		Closing Date: <?php echo $vacancy['close_date']; ?>
	</div></td>
</tr></tbody></table><table border="0" cellpadding="0" cellspacing="0" width="686"><tbody><tr><td>

<img src="<?php echo base_url('static/img/job_header.png'); ?>" alt="header" height="57" width="686">

</td></tr><tr><td><table cellpadding="0" cellspacing="0" align="center" width="686"><tbody><tr>
<td style="background: url('<?php echo base_url('static/img/job_sub_header.png'); ?>') top left repeat-y;">
<p style="text-align: center; padding: 15px 0;">
	<a href="<?php echo $vacancy['company_link']; ?>">
		<img src="<?php echo $vacancy['company_logo_link']; ?>" />
	</a>
</p></td></tr></tbody></table>
<table border="0" cellpadding="0" cellspacing="0" align="center" width="650">
<tbody><tr><td style="background: url('<?php echo base_url('static/img/creative_2_01_04.png'); ?>') top left repeat-y; padding-top: 10px;" align="center">
	<img src="<?php echo $vacancy['company_banner_link']; ?>" style="width: 650px; height: 186px;" alt="banner" />
</td></tr><tr><td style="background: url('<?php echo base_url('static/img/creative_2_01_04.png'); ?>') top left repeat-y;" align="center"><table cellpadding="10" cellspacing="0" align="center" width="600"><tbody><tr><td class="comURL">
<p style="text-align: center;">
	<a href="<?php echo $vacancy['company_link']; ?>" style="text-decoration: none; font-size: 22px; font-weight: bold; color: #FFFFFF;">
		<?php echo $vacancy['company_nama']; ?>
	</a>
</p>
</td></tr></tbody></table><table border="0" cellpadding="0" cellspacing="0" align="center" width="600"><tbody><tr><td align="left"><table cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="left"><p align="justify"><font color="#FFFFFF" face="Arial" size="2"></font></p><div><font color="#FFFFFF" face="Arial" size="2">
	<div>Kami adalah perusahaan yang bergerak di bidang <?php echo $vacancy['industri_nama']; ?>, saat ini kami sedang berkembang dengan pesat dan membutuhkan Anda sebagai profesional untuk maju berkembang bersama kami, sebagai :</div>
	<div>&nbsp;</div>
</font></div><font color="#FFFFFF" face="Arial" size="2">
</font>

<div style="text-align: center; color: #FFFFFF;">
	<div style="font-size: 24px; font-weight: bold;"><?php echo $vacancy['nama']; ?></div>
	<div style="font-size: 13px;"><?php echo $vacancy['kota_nama']; ?></div>
</div>
<div style="color: #FFFFFF; font-size: 13px;"><?php echo $vacancy['content']; ?></div>

<font color="#FFFFFF" face="Arial" size="2">
	<div style="text-align: center;"><?php echo $vacancy['content_short']; ?></div>
	<div style="text-align: center;">&nbsp;</div>
	<div style="text-align: center;">Pelamar Tertarik dapat mengirimkan CV dan Foto Terbaru ke email :</div>
	<div style="text-align: center;">&nbsp;</div>
	<div style="text-align: center;"><?php echo $vacancy['email_apply']; ?></div>
	<div style="text-align: center;">&nbsp;</div>
	<div style="text-align: center;">" Hanya kandidat yang memenuhi persaratan yang akan di panggil untuk interview "</div>
	<div style="text-align: center;">&nbsp;</div>
	<div style="text-align: center;"><?php echo $vacancy['company_website']; ?></div>
</font>

</td></tr></tbody></table>
</td></tr></tbody></table></td></tr><tr><td align="center"><img src="<?php echo base_url('static/img/creative_2_01_04.png'); ?>" alt="footer" height="67" width="686"></td></tr></tbody></table></td></tr><tr>
<td style="background: url('<?php echo base_url('static/img/job_sub_header.png'); ?>') top left repeat-y;">
<table border="0" cellpadding="0" cellspacing="0" align="center" width="600"><tbody><tr><td>
<table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody>
	<tr><td>
		<div class="cnt-apply" style="text-align: center; padding: 30px 0 30px 0;">
			<?php if ($is_apply) { ?>
			Anda sudah melamar lowongan ini.
			<?php } else if ($is_login) { ?>
			<input type="button" style="font-weight:bold; width:150px" value="Apply" />
			<?php } else { ?>
			Silahkan <a href="<?php echo base_url('login'); ?>" style="color: #0000FF;">login</a> untuk melamar lowongan ini
			<?php } ?>
		</div>
		
		<img src="<?php echo base_url('static/img/ads3_line.gif'); ?>" style="margin: 0 0 30px 0;">
		
		<div style="font-size: 12px; font-family: verdana; text-align: center;">
			<div><a href="<?php echo $vacancy['company_link']; ?>" style="text-decoration: none; font-size: 11px; color: #0000FF;">Company Information</a></div>
			<div><a style="color: #0000FF;" href="<?php echo base_url(); ?>" target="_blank">Dunia Karir</a></div>
			<div style="padding: 10px 0 0 0;">Copyright &copy; 2013</div>
		</div>

	</td></tr>
</tbody></table>
</td></tr></tbody></table></td></tr><tr><td>
<img src="<?php echo base_url('static/img/basic_2_05.png'); ?>" alt="footer" height="62" width="686">
</td></tr></tbody></table></td></tr></tbody></table>

<script>
	$('.cnt-apply input').click(function() {
		var param = { action: 'apply', vacancy_id: $('[name="vacancy_id"]').val() }
		Func.ajax({ url: web.host + 'ajax', param: param, callback: function(result) {
			$('.cnt-apply').text(result.message);
		} });
	});
</script>

</body>
</html>