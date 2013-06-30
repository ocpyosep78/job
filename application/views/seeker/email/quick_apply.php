<div style="width: 600px; margin: 0 auto; border: 1px solid #82BB0B; font-family: arial; font-size: 12px;">
	<div style="background: #82BB0B; padding: 15px 30px; font-size: 16px; font-weight: bold; color: #454545;">
		<div style="float: right;">
			<div style="padding: 10px 0 0 0;">
				<a href="<?php echo base_url(); ?>" style="text-decoration: none; color: #454545; padding: 5px 25px; background: #FFFFFF;">Visit Website</a>
			</div>
		</div>
		<div>
			DuniaKarir.com - Lowongan Kerja<br />
			Seluruh Indonesia
		</div>
	</div>
	<div style="padding: 20px;">
		<div style="border-bottom: 1px solid #CCCCCC; padding: 0 0 8px 0; font-size: 16px;">Permohonan Lowongan Kerja dari <?php echo $post['first_name'].' '.$post['last_name']; ?></div>
		<div style="border-bottom: 1px solid #CCCCCC; padding: 10px 0;"><?php echo nl2br($post['message']); ?></div>
		<div style="padding: 15px 0 0 0;">
			<div style="padding: 0 0 15px 0; color: #00A2E8;">Pelamar telah melamar pekerjaan dengan data sebagai berikut :</div>
			<div style="padding: 0 0 25px 0;">
				Nama Lengkap : <?php echo $post['first_name'].' '.$post['last_name']; ?><br />
				Email : <?php echo $post['email']; ?> Tahun<br />
				No HP : <?php echo $post['mobile_no']; ?><br />
				Kebangsaan : <?php echo $post['kebangsaan']; ?><br /><br />
				
				Informasi Tambahan<br />
				Posisi : <?php echo $post['current_position']; ?><br />
				Lama Pengalaman : <?php echo $post['year_of_experience']; ?><br />
				Nama Perusahaan : <?php echo $post['company_name']; ?><br />
				Gaji tiap Bulan : <?php echo $post['monthly_salary']; ?><br />
				Gaji yang diharapkan : <?php echo $post['expected_monthly_salary']; ?><br />
				Jenjang : <?php echo $post['qualification']; ?><br />
				Bidang Studi : <?php echo $post['field_of_study']; ?><br />
				Universitas : <?php echo $post['university']; ?>
			</div>
		</div>
	</div>
</div>