<?php
	$company = $this->Company_model->get_session();
	$array_vacancy = $this->Vacancy_model->get_array(array( 'company_id' => $company['id'] ));
	
	$array_apply = array();
	if (!empty($_POST['vacancy_id'])) {
		$array_apply = $this->Apply_model->get_array_seeker(array( 'vacancy_id' => $_POST['vacancy_id'], 'is_delete' => 0, 'limit' => 1000 ));
	}
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => 'Download' ) ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<style>
.dataTables_wrapper .clear { clear: none; }
</style>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main"><div class="container-fluid"><div class="row-fluid"><div class="span12"><div class="box">
		<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Download', 'class' => 'icon-reorder' ) ); ?>
		
		<div class="box-content">
			<div class="hide">
				<form method="post" id="form-download">
					<input type="hidden" name="vacancy_id" value="0" />
				</form>
			</div>
			
			<div>
				<div style="float: left; width: 140px; padding: 3px 0 0 0;">Sort by jobs Position :</div>
				<div style="float: left; width: 200px;">
					<select class="select-position">
						<?php echo ShowOption(array( 'Array' => $array_vacancy, 'ArrayID' => 'id', 'ArrayTitle' => 'nama', 'Selected' => @$_POST['vacancy_id'] )); ?>
					</select>
				</div>
				<?php if (count($array_apply) > 0) { ?>
				<div style="float: right; width: 200px; text-align: right;">
					<button class="btn btn-small btn-slide">View Photo In Slide</button>
				</div>
				<?php } ?>
				<div class="clear"></div>
			</div>
			
			<?php if (count($array_apply) > 0) { ?>
			<div class="row-fluid"><div class="span12"><div class="box"><div class="box-content nopadding">
				<table class="table table-hover table-nomargin dataTable dataTable-tools table-bordered">
					<thead><tr>
						<th>No Pelamar</th>
						<th>Nama</th>
						<th>Usia</th>
						<th>Nilai</th>
						<th>Jenjang</th>
						<th>Nama Sekolah</th>
						<th>Kota</th>
						<th>Status</th>
						<th>Pengalaman</th>
						<th>&nbsp;</th>
					</tr></thead>
					<tbody>
						<?php foreach ($array_apply as $seeker) { ?>
							<tr>
								<td><?php echo $seeker['seeker_no']; ?></td>
								<td><?php echo $seeker['full_name']; ?></td>
								<td><?php echo $seeker['usia']; ?></td>
								<td><?php echo $seeker['score']; ?></td>
								<td><?php echo $seeker['jenjang_nama']; ?></td>
								<td><?php echo $seeker['school']; ?></td>
								<td><?php echo $seeker['kota_nama']; ?></td>
								<td><?php echo $seeker['marital_nama']; ?></td>
								<td><?php echo $seeker['experience']; ?></td>
								<td>
									View | Interview | Reject
									
									<img src="http://localhost/job/trunk/static/img/button_edit.png" class="button-cursor edit">
									<img src="http://localhost/job/trunk/static/img/button_delete.png" class="button-cursor delete">
									<span class="hide">{"id":"1","vacancy_status_name":"Approve"}</span>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div></div></div></div>
			<?php } ?>
		</div>
	</div></div></div></div></div>
</div>
<script>
	$(document).ready(function() {
		$('.select-position').chosen({ disable_search_threshold: 9999999 }).change(function() {
			$('[name="vacancy_id"]').val($(this).val());
			$('#form-download').submit();
		});
	});
</script>
</body>
</html>