<?php
	$company = $this->Company_model->get_session();
	$news_company = $this->News_model->get_company();
	$is_member = $this->Company_model->get_membership_status(array( 'id' => $company['id'] ));
	$membership = $this->Company_model->get_membership_detail(array( 'id' => $company['id'] ));
?>

<?php $this->load->view( 'panel/common/meta', array('title' => 'Dashboard' )); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Dashboard', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="row-fluid">
				<?php if (!empty($news_company)) { ?>
				<div class="alert alert-success">
					<strong>News</strong> : <?php echo $news_company; ?>
				</div>
				<?php } ?>
				
				<div class="alert alert-info">
					Paket Keanggotaan Anda saat ini: <?php echo $membership['status_text']; ?>.<br />
					Anda saat ini memiliki <?php echo $membership['vacancy_left']; ?> kredit iklan lowongan.<br />
					Jumlah lowongan yang aktif diiklankan saat ini: <?php echo $membership['vacancy_count']; ?><br />
					
					<?php if ($is_member) { ?>
					Paket Keanggotaan Anda saat ini berakhir pada: <?php echo GetFormatDate($membership['membership_date'], array( 'FormatDate' => "m/d/Y" )); ?>
					<?php } else if (!empty($membership['membership_date'])) { ?>
					Paket Keanggotaan Anda saat ini sudah berakhir pada: <?php echo GetFormatDate($membership['membership_date'], array( 'FormatDate' => "m/d/Y" )); ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div></div></div></div></div>
</div>
</body>
</html>