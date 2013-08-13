<?php

include 'helper.php';

define('HOST', 'http://localhost:8666/job/trunk/mail');

if (isset($_POST['action']) && $_POST['action'] == 'sent_mail') {
	$mail_param['to'] = $_POST['to'];
	$mail_param['title'] = $_POST['subject'];
	$mail_param['message'] = $_POST['message'];
	sent_mail($mail_param);
	
	$result['status'] = true;
	$result['message'] = 'Email berhasil dikirim.';
	echo json_encode($result);
	exit;
}