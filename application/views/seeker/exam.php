<?php
	$apply_id = $_GET['id'];
	$apply = $this->Apply_model->get_by_id(array( 'id' => $apply_id ));
	$vacancy = $this->Vacancy_model->get_by_id(array( 'id' => $apply['vacancy_id'] ));
	$exam = $this->Exam_model->get_by_id(array( 'apply_id' => $apply_id ));
	$total_time = $this->Exam_model->get_total_time($exam['exam_time']);
	
	// is exam already start ?
	$is_start = (empty($exam['exam_time_end'])) ? 0 : 1;
	$is_over = false;
	if ($is_start) {
		$current_time = GetUnixTime($this->config->item('current_datetime'));
		$end_time = GetUnixTime($exam['exam_time_end']);
		
		$total_time = ($end_time + $total_time) - $current_time;
		$is_over = ($total_time <= 0) ? true : $is_over;
	}
	
	// add download time
	$total_time = $total_time + (3 * 60);
?>

<?php $this->load->view( 'panel/common/meta', array( 'title' => $vacancy['nama'] ) ); ?>
<body style="background: #EFE4B0;">
<div style="width: 800px; margin: 0 auto;">
	<div class="hide">
		<input type="hidden" name="total_time" value="<?php echo $total_time; ?>" />
		<input type="hidden" name="exam_id" value="<?php echo $exam['id']; ?>" />
		<input type="hidden" name="is_start" value="<?php echo $is_start; ?>" />
		<iframe name="iframe_exam_file" src="<?php echo base_url('panel/upload?callback=exam_file&filetype=document'); ?>"></iframe>
	</div>
	
	<div style="padding: 0 0 6px 0; text-align: center;">Anda Berada di halaman ujian untuk lowongan <?php echo $vacancy['nama']; ?></div>
	<div style="padding: 0 0 15px 0; text-align: center;">Sebelum mengikuti Ujian ini, Pastikan komputer yang anda gunakan tersedia program Office</div>
	<div style="padding: 0 0 6px 0;">Waktu ujian akan dimulai setelah anda tekan tombol Download Soal, dan proses download tidak akan di hitung, yaitu selama 3 menit.</div>
	<div style="padding: 0 0 25px 0;">Sebelum anda melakukan test ujian ini, kami sarankan anda melihat terlebih dahulu video ujian pada youtube ini, dan pastikan koneksi internet anda stabil</div>
	<div style="padding: 0 0 6px 0;">Untuk memulai silahkan klik Link Download soal berikut ini, dan selamat mengerjakan</div>
	<div style="padding: 30px 0 0 0; text-align: center;">
		<div style="float: left; width: 50%;">
			<div>&nbsp;</div>
			<button class="btn btn-success btn-download">Download Soal</button>
		</div>
		<div style="float: left; width: 50%;">
			<div>Sisa Waktu</div>
			<div style="font-size: 18px;" class="cnt-time">01:10:00</div>
		</div>
		<div style="clear: both;"></div>
		
		<?php if (! $is_over) { ?>
		<div style="padding: 25px 0 0 0;" class="cnt-upload hide">
			<div style="padding: 0 0 10px 0;">Upload file anda setelah menyelesaikan soal ini</div>
			<div><button class="btn btn-success btn-upload">Upload Soal</button></div>
		</div>
		<?php } ?>
	</div>
</div>

<script>
exam_file = function(p) {
	var exam_id = $('[name="exam_id"]').val();
	Func.ajax({ url: web.host + 'seeker/exam/action', param: { action: 'upload-exam', exam_id: exam_id, exam_file : p.file_name }, callback: function(result) {
		Func.show_notice({ text: result.message })
	} });
}

$(document).ready(function() {
	function set_time() {
		var total_time = $('[name="total_time"]').val();
		var hour = Math.floor((total_time / 3600));
		var minute = Math.floor(((total_time % 3600) / 60));
		var second = total_time % 60;
		
		// fix view
		hour = hour.toString().strpad(2, '0', 'STR_PAD_LEFT');
		minute = minute.toString().strpad(2, '0', 'STR_PAD_LEFT');
		second = second.toString().strpad(2, '0', 'STR_PAD_LEFT');
		var time_text = hour + ':' + minute + ':' + second;
		$('.cnt-time').text(time_text);
	}
	
	function countdown() {
		var total_time = $('[name="total_time"]').val() - 1;
		$('[name="total_time"]').val(total_time);
		set_time();
	}
	
	// set time
	set_time();
	
	// download file
	$('.btn-download').click(function() {
		var exam_id = $('[name="exam_id"]').val();
		Func.ajax({ url: web.host + 'seeker/exam/action', param: { action: 'take-exam', exam_id: exam_id }, callback: function(result) {
			$('.cnt-upload').show();
			window.open(result.exam_file_link);
		} });
	});
	
	// is start ?
	var is_start = $('[name="is_start"]').val();
	if (is_start == 1) {
		setInterval(function(){countdown()}, 1000);
		$('.cnt-upload').show();
	}
	
	// upload result
	$('.btn-upload').click(function() { window.iframe_exam_file.browse() });
});
</script>
</body>
</html>