<?php
	$allow_update = (isset($allow_update)) ? $allow_update : false;
//	echo GetFormatDate($seeker['last_update'], array( 'FormatDate' => 'd M Y' )); exit;
//	print_r($seeker); exit;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Lihat ulang resume saya</title>
	<link type="text/css" href="<?php echo base_url('static/css/resume.css'); ?>" rel="stylesheet" />
</head>
<body>
<div id="subNavWrap">
	<div id="subNav">
		<h1>Resume Saya</h1>
		<h2><a href="<?php echo base_url('seeker/resume'); ?>">Perbarui Resume</a></h2>
		<h2>|<a class="activeLink">Pratinjau Resume</a></h2>
		<h2>|<a href="<?php echo $seeker['seeker_no_pdf']; ?>">Simpan Resume Sebagai Pdf (.pdf)</a></h2>
	</div>
</div>

<div id="contentWrap">
	<div id="content"><div id="pageContent" style="width:100%; margin:0px">
        <div id="pageRow">&nbsp;</div>
        <div id="pageRow">
            <div class="colLeft" style="width:70%"><span id="logoPrint" style="display:none"><img src="resume_files/js-logo.gif"></span>&nbsp;</div>
            <div class="colRight" style="width:27%" id="print"><a style="cursor: pointer;" onclick="javascript: window.print();">Cetak resume</a></div>
		</div>
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
					<td valign="top" width="25%">Telepon</td>
					<td valign="top">:</td>
					<td class="tdRight" valign="top"><?php echo $seeker['phone']; ?></td></tr>
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
</tr><tr class="TRHeader">
  <td colspan="6" class="ResumeHdr" valign="top">
    <b>Latar belakang pendidikan</b>
  </td>
</tr><tr>
  <td colspan="6" class="tdRight" valign="top">
    <div style="float:left;">
      <b>Sarjana S1 - Field Bidang Studi</b>
    </div>
    <div style="float:right;text-align:right;font-size:10px;font-family:verdana;">
                        Tanggal Kelulusan: 
    					Sep&nbsp;
                                        2010</div>
  </td>
</tr><tr>
  <td valign="top" width="23%">Jurusan </td>
  <td valign="top">:</td>
  <td colspan="4" class="tdRight" valign="top">Teknik Informatika</td>
</tr><tr>
  <td valign="top" width="23%">Institusi / Universitas</td>
  <td valign="top">:</td>
  <td colspan="4" class="tdRight" valign="top">Stiki, 
    					Indonesia</td>
</tr><tr>
  <td valign="top" width="23%">CGPA</td>
  <td valign="top">:</td>
  <td valign="top">3/4</td>
</tr><tr>
  <td colspan="6" valign="top">&nbsp;</td>
</tr><tr>
  <td colspan="6" class="tdRight" valign="top">
    <div style="float:left;">
      <b>(D3) Diploma of 
        				Jurnalisme</b>
    </div>
    <div style="float:right;text-align:right;font-size:10px;font-family:verdana;">
                        Tanggal Kelulusan: 
    					Aug&nbsp;
                                        2006</div>
  </td>
</tr><tr>
  <td valign="top" width="23%">Jurusan </td>
  <td valign="top">:</td>
  <td colspan="4" class="tdRight" valign="top">fsdfsd</td>
</tr><tr>
  <td valign="top" width="23%">Institusi / Universitas</td>
  <td valign="top">:</td>
  <td colspan="4" class="tdRight" valign="top">fdsfsdfds, 
    					Indonesia</td>
</tr><tr>
  <td valign="top" width="23%">CGPA</td>
  <td valign="top">:</td>
  <td valign="top">1/2</td>
</tr><tr>
  <td colspan="6" valign="top">&nbsp;</td>
</tr>

<tr class="TRHeader">
  <td colspan="6" class="ResumeHdr" valign="top"><b>Keahlian / Ketrampilan</b></td>
</tr><tr>
  <td colspan="6" valign="top">

DISINI TAMPILKAN DAFTAR KETRAMPILAN YANG DI ENTRY  DAN Tampilkan Ketrampilan dalam bentuk LIST
  
  </td>
</tr>

<tr>
  <td colspan="6" valign="top">&nbsp; </td>
</tr>

<tr class="TRHeader">
  <td colspan="6" class="ResumeHdr" valign="top"><b>Penguasaan Bahasa</b></td>
</tr><tr>
  <td colspan="6" valign="top">
    <table cellpadding="2" cellspacing="0" width="100%">
      <tbody><tr>
        <td valign="top" width="33%">
          <b>Bahasa</b>
        </td>
        <td align="center" valign="top" width="20%">
          <b>Lisan</b>
        </td>
        <td align="center" valign="top">
          <b>Tertulis</b>
        </td>
      </tr>
      <tr>
        <td valign="top">Bahasa Inggris</td>
        <td align="center" valign="top">Pasif</td>
        <td align="center" valign="top">Pasif</td>
      </tr>
    </tbody></table>
  </td>
</tr><tr>
  <td colspan="6" valign="top">&nbsp; </td>
</tr><tr class="TRHeader">
  <td colspan="6" class="ResumeHdr" valign="top">
    <b>Pengalaman Kerja</b>
  </td>
</tr><tr>
  <td valign="top" width="23%">Tingkat Pengalaman</td>
  <td valign="top">:</td>
  <td colspan="4" valign="top">Lulusan Baru</td>
</tr><tr>
  <td colspan="6" valign="top">&nbsp; </td>
</tr>
<tr class="TRHeader">
  <td colspan="6" class="ResumeHdr" valign="top">
    <b>Info Tambahan</b>
  </td>
</tr>
<tr>
  <td colspan="6" class="tdRight" valign="top">Saya yang bertandatangan dibawah ini :<br><br>Nama         <br>	<br>: Agus Darwanto, SE<br>Tempat, Tanggal Lahir <br>	<br>: Jakarta, 8 Mei 1980<br>Alamat  <br>	<br>: Petamburan RT. 02/09, Tn. Abang, Jakarta<br>No. Telp/HP<br>	<br>: 0812 987654321<br>Pendidikan terakhir<br>	<br>: S1 Akuntansi<br>Dengan ini mengajukan surat permohonan untuk bekerja di perusahaan Bapak/Ibu sebagai Accounting Manager.<br><br>Saat
 ini saya memiliki pendidikan Strata 1 yang memiliki korelasi dengan 

tes seleksi dan wawancara.<br><br>Demikian, atas perhatian dan kerjasamanya diucapkan terima kasih.			</td>
</tr>
<tr>
  <td colspan="6" valign="top">&nbsp; </td>
</tr>
<tr class="TRHeader">
  <td colspan="6" class="ResumeHdr" valign="top">
    <b>Referensi</b>
  </td>
</tr><tr>
  <td colspan="6" class="tdRight" valign="top">
Saya mendapatkan mandat dari pak presiden untuk menjadi direktur di tempat anda
  </td>
</tr><tr>
  <td colspan="6" valign="top">&nbsp; </td>
</tr>
<tr>
  <td colspan="6" valign="top">&nbsp; </td>
</tr><tr>
  <td colspan="6" valign="top">&nbsp; </td>
</tr>
<tr>
  <td colspan="6">
    <hr><table border="0" width="100%">
      <tbody>



	  
	  
      <tr>
        <td style="font-type:Arial;font-size:14px" valign="top">
          <b>Ringkasan Resume (Bagian ini tidak akan di tampilkan untuk Perusahaan)</b>
        </td>
      </tr>
      <tr>
        <td valign="top">
          <table border="0" width="100%">
            <tbody>
            <tr>
              <td valign="top" width="25%"> Pendidikan Terakhir</td>
              <td valign="top">:</td>
              <td class="tdRight" valign="top">Sarjana S1</td>
            </tr>
			<tr>
              <td valign="top" width="25%">Pendidikan Tertinggi</td>
              <td valign="top">:</td>
              <td class="tdRight" valign="top">Sekolah Tinggil Ilmu Komputer - Malang</td>
            </tr>
            <tr>
              <td valign="top" width="25%">Nilai / IPK Terakhir</td>
              <td valign="top">:</td>
              <td class="tdRight" valign="top">4.0</td>
            </tr>
            <tr>
              <td valign="top" width="25%">Tempat Dan Penglaman Terakhir</td>
              <td valign="top">:</td>
              <td class="tdRight" valign="top">PT Arahan Mandiri sebagai direktur Utama</td>
            </tr>
		
          </tbody></table>
        </td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
      </tr>
    </tbody></table>
  </td>
</tr>


                    </tbody></table>
                </div>
            </div>
        </div>
        <div id="pageRow">&nbsp;</div>
        <div id="pageRow"><div class="colFRight">[<a href="#">Kembali ke atas</a>]</div></div>
        <div id="pageRow">&nbsp;</div>
    </div>
<!--</form>-->


    	<div class="clear"></div>
	</div>	
</div> 
<div id="footer"> 
	<div id="footer2Wrap">
			<div class="horizontol_grey"></div>
			<div id="term">
			    <a href="#">Tentang Kami</a>
				<a href="#">Bantuan</a>
  </div>
			<div class="clear"></div>
			<div id="copyright">
				Hak Cipta ©&nbsp;2013&nbsp;parapekerja.com

							</div>
	</div>
</div>
        

</body>
</html>