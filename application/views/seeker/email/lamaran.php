<?php
	$summary = $this->Seeker_Summary_model->get_by_id(array( 'seeker_id' => $seeker['id'] ));
?>

<div style="width: 600px; margin: 0 auto; border: 1px solid #82BB0B; font-family: arial; font-size: 12px;">
	<div style="background: #82BB0B; padding: 15px 30px; font-size: 16px; font-weight: bold; color: #454545;">
		<div style="float: right;">
			<div style="padding: 10px 0 0 0;">
				<a href="<?php echo base_url(); ?>" style="text-decoration: none; color: #454545; padding: 5px 25px; background: #FFFFFF;">Visi Website</a>
			</div>
		</div>
		<div>
			DuniaKarir.com - Lowongan Kerja<br />
			Seluruh Indonesia
		</div>
	</div>
	<div style="padding: 20px;">
		<div style="border-bottom: 1px solid #CCCCCC; padding: 0 0 8px 0; font-size: 16px;">Permohonan Lowongan Kerja dari <?php echo $seeker['full_name']; ?></div>
		<div style="border-bottom: 1px solid #CCCCCC; padding: 10px 0;">
			<?php echo $content; ?>
		</div>
		<div style="padding: 15px 0 0 0;">
			<div style="padding: 0 0 15px 0; color: #00A2E8;">Duniakarir.Com memiliki data dari pelamar atas nama <?php echo $seeker['full_name']; ?> Sebagai berikut :</div>
			<div style="padding: 0 0 50px 0;">
				Nama Lengkap : <?php echo $seeker['full_name']; ?><br />
				Usia : <?php echo $seeker['usia']; ?> Tahun<br />
				Status : <?php echo $seeker['marital_nama']; ?><br />
				Kota : <?php echo $seeker['kota_nama']; ?><br />
				IPK / Danem : <?php echo $summary['score']; ?><br />
				Pendidikan Terakhir : <?php echo $summary['school']; ?><br />
				Pengalaman dan Tempat Kerja Terakhir : <?php echo $summary['experience']; ?><br />
				Alamat Email : <?php echo $seeker['email']; ?>
			</div>
			<div>Profile : <a style="color: #00A2E8; text-decoration: none;" href="<?php echo $seeker['seeker_link']; ?>"><?php echo $seeker['seeker_link']; ?></a></div>
		</div>
	</div>
</div>