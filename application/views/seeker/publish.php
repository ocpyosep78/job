<?php
	$is_pdf = (isset($is_pdf)) ? $is_pdf : false;
	$is_login_editor = $this->Editor_model->is_login();
	$is_company = (isset($is_company)) ? $is_company : false;
	
	$allow_update = (isset($allow_update)) ? $allow_update : false;
	
	$allow_view = false;
	if ($allow_update) {
		$allow_view = true;
	} else if ($is_company) {
		$allow_view = true;
	} else if ($is_login_editor) {
		$allow_view = true;
	}
	
	$array_pendidikan = $this->Seeker_Education_model->get_array(array( 'seeker_id' => $seeker['id'] ));
	$array_language = $this->Seeker_Language_model->get_array(array( 'seeker_id' => $seeker['id'] ));
	$array_exp = $this->Seeker_Exp_model->get_array(array( 'seeker_id' => $seeker['id'] ));
	$array_expert = $this->Seeker_Expert_model->get_array(array( 'seeker_id' => $seeker['id'] ));
	$array_reference = $this->Seeker_Reference_model->get_array(array( 'seeker_id' => $seeker['id'] ));
	$seeker_addon = $this->Seeker_Addon_model->get_by_id(array( 'seeker_id' => $seeker['id'] ));
	$seeker_summary = $this->Seeker_Summary_model->get_by_id(array( 'seeker_id' => $seeker['id'] ));
	$is_public = $this->Seeker_Setting_model->is_public(array( 'seeker_id' => $seeker['id'] ));
	$is_work = $this->Seeker_Setting_model->is_work(array( 'seeker_id' => $seeker['id'] ));
	
	if (!$is_pdf && !$allow_view && !$is_public) {
		echo '<div style="text-align: center;">Resume ini tidak tersedia untuk Public</div>';
		exit;
	} else if (!$is_pdf && !$allow_view && $is_work) {
		echo '<div style="text-align: center;">Pelamar ini sudah bekerja</div>';
		exit;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Lihat ulang resume saya</title>
	<link type="text/css" href="<?php echo base_url('static/css/resume.css'); ?>" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo base_url('static/js/jquery-1.8.2.min.js'); ?>"></script>
</head>
<body>

<?php if ($allow_update) { ?>
<div id="subNavWrap">
	<div id="subNav">
		<h1>Resume Saya</h1>
		<h2><a href="<?php echo base_url('seeker/resume'); ?>">Perbarui Resume</a></h2>
		<h2>|<a class="activeLink">Pratinjau Resume</a></h2>
		<h2>|<a href="<?php echo $seeker['seeker_no_pdf']; ?>">Simpan Resume Sebagai Pdf (.pdf)</a></h2>
	</div>
</div>
<?php } ?>

<div id="contentWrap">
	<div id="content"><div id="pageContent" style="width:100%; margin:0px">
        <div id="pageRow">&nbsp;</div>
		<?php if (! $is_pdf) { ?>
        <div id="pageRow">
            <div class="colLeft" style="width:70%">&nbsp;</div>
            <div class="colRight" style="width:27%" id="print"><a style="cursor: pointer;" onclick="javascript: window.print();">Cetak resume</a></div>
		</div>
		<?php } ?>
		
        <div class="formSection">
            <div class="pageRow">&nbsp;</div>            
            <div class="pageRow">
                <div style="padding:10px;">
                    <table class="pvResume" border="0" cellpadding="2" cellspacing="0" width="90%"><tbody>
<tr><td colspan="6">
	<table border="0" width="100%"><tbody>
		<tr>
			<td style="font-type:verdana;font-size:13pt;font-weight:bold" valign="top" width="90%">
				<?php echo $seeker['full_name']; ?><br>
				<em><span style="font-size:10px;font-family:verdana;font-weight:normal">(Diperbaharui: <?php echo GetFormatDate($seeker['last_update'], array( 'FormatDate' => 'd M Y' )); ?>)</span></em></td>
			</tr>
		<tr valign="top"><td class="tdRight" valign="top"><?php echo $seeker['address'].' - '.$seeker['kota_nama'].' '.$seeker['propinsi_nama'].', '.$seeker['negara_nama']; ?></td></tr>
		<tr>
			<td valign="top">Email: <a href="mailto:<?php echo $seeker['email']; ?>"><?php echo $seeker['email']; ?></a></td></tr>
		<tr><td><span class="text"></span></td></tr>
		<tr><td valign="top">&nbsp;</td></tr>
		<tr><td valign="top">
			<table border="0" width="100%"><tbody>
				<?php if (!empty($seeker['phone'])) { ?>
				<tr>
					<td valign="top" style="width: 40%;">Telepon</td>
					<td valign="top" style="width: 5%;">:</td>
					<td class="tdRight" valign="top" style="width: 55%;"><?php echo $seeker['phone']; ?></td></tr>
				<?php } ?>
				<?php if (!empty($seeker['hp'])) { ?>
				<tr>
					<td valign="top" width="25%">Ponsel</td>
					<td valign="top">:</td>
					<td class="tdRight" valign="top"><?php echo $seeker['hp']; ?></td></tr>
				<?php } ?>
				<tr>
					<td valign="top" width="25%">Tempat Tangal lahir</td>
					<td valign="top">:</td>
					<td class="tdRight" valign="top">
						<?php echo $seeker['tempat_lahir']; ?>
						-
						<?php echo GetFormatDate($seeker['tgl_lahir'], array( 'FormatDate' => 'd M Y' )); ?>
					</td></tr>
				<tr>
					<td valign="top" width="25%">Agama</td>
					<td valign="top">:</td>
					<td class="tdRight" valign="top"><?php echo $seeker['agama']; ?></td></tr>
				<tr>
					<td valign="top" width="25%">Status</td>
					<td valign="top">:</td>
					<td class="tdRight" valign="top"><?php echo $seeker['marital_nama']; ?></td></tr>			
			</tbody></table>
		</td></tr>
		<tr><td valign="top">&nbsp;</td></tr>
	</tbody></table>
  </td>
</tr>

<?php if (count($array_pendidikan) > 0) { ?>
<tr class="TRHeader"><td colspan="6" class="ResumeHdr" valign="top"><b>Latar belakang pendidikan</b></td></tr>
<?php foreach ($array_pendidikan as $item) { ?>
<tr>
	<td colspan="6" class="tdRight" valign="top">
		<div style="float:left; font-weight: bold;"><?php echo $item['jenjang_nama'].' - '.$item['bidang_studi']; ?></div>
		<div style="float:right; text-align:right; font-size:10px; font-family:verdana;">Tanggal Kelulusan: <?php echo GetFormatDate($item['tgl_lulus'], array( 'FormatDate' => 'M Y' )); ?></div>
	</td>
</tr>
<tr>
	<td valign="top" width="23%">Jurusan</td>
	<td valign="top">:</td>
	<td colspan="4" class="tdRight" valign="top"><?php echo $item['jurusan']; ?></td></tr>
<tr>
	<td valign="top" width="23%">Institusi / Universitas</td>
	<td valign="top">:</td>
	<td colspan="4" class="tdRight" valign="top"><?php echo $item['nama_sekolah']; ?></td></tr>
<tr>
	<td valign="top" width="23%">CGPA</td>
	<td valign="top">:</td>
	<td valign="top"><?php echo $item['score']; ?></td></tr>
<tr><td colspan="6" valign="top">&nbsp;</td></tr>
<?php } ?>
<?php } ?>

<?php if (count($array_expert) > 0) { ?>
<tr class="TRHeader"><td colspan="6" class="ResumeHdr" valign="top"><b>Keahlian / Ketrampilan</b></td></tr>
<tr>
	<td colspan="6" valign="top">
		<ul>
			<?php foreach ($array_expert as $item) { ?>
			<li><?php echo $item['content']; ?></li>
			<?php } ?>
		</ul>
	</td>
</tr>
<tr><td colspan="6" valign="top">&nbsp;</td></tr>
<?php } ?>

<?php if (count($array_language) > 0) { ?>
<tr class="TRHeader"><td colspan="6" class="ResumeHdr" valign="top"><b>Penguasaan Bahasa</b></td></tr>
<tr><td colspan="6">
    <table cellpadding="2" cellspacing="0" style="width: 100%;"><tbody>
	<tr>
        <td style="width: 30%;"><b>Bahasa</b></td>
        <td style="width: 35%;" align="center" valign="top"><b>Lisan</b></td>
		<td style="width: 35%;" align="center" valign="top"><b>Tertulis</b></td></tr>
	<?php foreach ($array_language as $bahasa) { ?>
	<tr>
		<td valign="top"><?php echo $bahasa['nama']; ?></td>
        <td align="center" valign="top"><?php echo $bahasa['lisan']; ?></td>
        <td align="center" valign="top"><?php echo $bahasa['tulis']; ?></td>
      </tr>
	<?php } ?>
    </tbody></table>
</td></tr>
<tr><td colspan="6" valign="top">&nbsp;</td></tr>
<?php } ?>

<?php if (count($array_exp) > 0) { ?>
<tr class="TRHeader"><td colspan="6" class="ResumeHdr" valign="top"><b>Pengalaman Kerja</b></td></tr>
<?php foreach ($array_exp as $exp) { ?>
<tr>
	<td valign="top" width="23%">Tingkat Pengalaman</td>
	<td valign="top">:</td>
	<td colspan="4" valign="top"><?php echo strip_tags($exp['content']); ?></td></tr>
<?php } ?>
<tr><td colspan="6" valign="top">&nbsp;</td></tr>
<?php } ?>

<?php if (!empty($seeker_addon['text_clean'])) { ?>
<tr class="TRHeader"><td colspan="6" class="ResumeHdr" valign="top"><b>Info Tambahan</b></td></tr>
<tr><td colspan="6" class="tdRight" valign="top">
	<?php echo $seeker_addon['content']; ?>
	
	<?php if ($seeker_addon['kendaraan'] == 1) { ?>
	<div>Saya memiliki kendaraan roda 2</div>
	<?php } else { ?>
	<div>Saya tidak memiliki kendaraan roda 2</div>
	<?php } ?>
</td></tr>
<tr><td colspan="6" valign="top">&nbsp;</td></tr>
<?php } ?>

<?php if (count($array_reference) > 0) { ?>
<tr class="TRHeader"><td colspan="6" class="ResumeHdr" valign="top"><b>Referensi</b></td></tr>
<?php foreach ($array_reference as $item) { ?>
<tr><td colspan="6" class="tdRight" valign="top"><?php echo $item['nama'].' : '.$item['content']; ?></td></tr>
<?php } ?>
<tr><td colspan="6" valign="top">&nbsp;</td></tr>
<?php } ?>

<?php if ($allow_update) { ?>
<tr>
	<td colspan="6"><hr />
		<table border="0" width="100%"><tbody>
		<tr><td style="font-type:Arial;font-size:14px" valign="top"><b>Ringkasan Resume (Bagian ini tidak akan di tampilkan untuk Perusahaan)</b></td></tr>
		<tr><td valign="top">
			<table border="0" width="100%"><tbody>
				<tr>
					<td valign="top" width="25%"> Pendidikan Terakhir</td>
					<td valign="top">:</td>
					<td class="tdRight" valign="top"><?php echo $seeker_summary['jenjang_nama']; ?></td></tr>
				<tr>
					<td valign="top" width="25%">Pendidikan Tertinggi</td>
					<td valign="top">:</td>
					<td class="tdRight" valign="top"><?php echo $seeker_summary['school']; ?></td></tr>
				<tr>
					<td valign="top" width="25%">Nilai / IPK Terakhir</td>
					<td valign="top">:</td>
					<td class="tdRight" valign="top"><?php echo $seeker_summary['score']; ?></td></tr>
				<tr>
					<td valign="top" width="25%">Tempat Dan Penglaman Terakhir</td>
					<td valign="top">:</td>
					<td class="tdRight" valign="top"><?php echo $seeker_summary['experience']; ?></td></tr>
			</tbody></table>
		</td></tr>
		<tr><td valign="top">&nbsp;</td></tr>
		</tbody></table>
	</td></tr>
<?php } ?>
</tbody></table>

                </div>
            </div>
        </div>
        <div id="pageRow">&nbsp;</div>
        <div id="pageRow"><div class="colFRight">[<a href="#" class="to-top">Kembali ke atas</a>]</div></div>
        <div id="pageRow">&nbsp;</div>
		<div class="clear"></div>
    </div></div>
</div>
<div id="footer"> 
	<div id="footer2Wrap">
		<div class="horizontol_grey"></div>
		<div id="term">
			<a href="#">Tentang Kami</a>
			<a href="#">Bantuan</a>
		</div>
		<div class="clear"></div>
		<div id="copyright">Hak Cipta &#169; <?php echo date("Y"); ?> parapekerja.com</div>
	</div>
</div>

<script>
$(document).ready(function() {
	$('.to-top').click(function(){
		$('html, body').animate({scrollTop:0}, 'slow');
		return false;
	});
});
</script>

</body>
</html>