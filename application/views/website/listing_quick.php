<?php
	$array_jenjang = $this->Jenjang_model->get_array();
	$default_resume = $this->Widget_model->get_by_id(array( 'alias' => 'default-resume' ));
	
	$string_date = GetFormatDate($vacancy['publish_date'], array( 'FormatDate' => "d F Y" ));
	$default_resume['content'] = str_replace('[DD FF YYYY]', $string_date, $default_resume['content']);
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Para Pekerja - Sent Resume</title>
	<link href="<?php echo base_url('static/css/oa.css'); ?>" type="text/css" rel="stylesheet" />
	
	<script>var web = { host: '<?php echo base_url(); ?>' };</script>
	<script src="<?php echo base_url('static/theme/flat/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/js/common.js'); ?>"></script>
	<style>
		.CntWarning { color: #FF0000; }
	</style>
</head>
<body bgcolor="#ffffff">

<div style="display: none;">
	<iframe name="iframe_upload_resume" src="<?php echo base_url('panel/upload?callback=upload_resume&filetype=document'); ?>"></iframe>
</div>

<table cellspacing="0" cellpadding="0" width="100%" border="0"><tbody><tr>
	<td>&nbsp;</td>
	<td align="right"><a class="closeWin" href="javascript:window.close();">Close This Window</a>&nbsp;&nbsp;</td>
</tr></tbody></table>

<img height="8" src="<?php echo base_url('static/img/space.gif'); ?>" width="1"><br clear="all">
<form id="form-apply" method="post">
<table cellspacing="0" cellpadding="1" width="100%" align="center" bgcolor="#00428D" border="0"><tbody>
<tr><td colspan="2" height="1"><img height="1" src="<?php echo base_url('static/img/space.gif'); ?>" width="1"></td></tr>
<tr>
	<td class="title"><font color="white">&nbsp;&nbsp;Non Member - Apply via Email</font></td>
	<td>&nbsp;</td></tr>
<tr>
	<td colspan="2">
		<table cellspacing="1" cellpadding="2" width="100%" align="center" bgcolor="#ffffff" border="0"><tbody>
		<tr>
			<td>
				<table align="center" border="0"><tbody>
				<tr>
					<td>
						<table cellspacing="8" cellpadding="2" width="100%" align="center" border="0"><tbody>
						<tr>
							<td colspan="2"><br />
								<table id="table3" class="tblForm" cellpadding="2" width="500" align="center" border="0"><tbody>
								<tr><td>
										<img alt="Warning" src="<?php echo base_url('static/img/warn.gif'); ?>"> <b>IMPORTANT:</b>
										<a href="#">Please read the application guidelines</a> before you apply.<br /><br />
										<b><a href="#">Please read our safe job searching guide.</a> Be alert for advertisements that require you to make any payment for application or processing, or are too good to be true.</b>
								</td></tr>
								</tbody></table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table id="table4" cellpadding="2" width="560" align="center" border="0"><tbody>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td></tr>
								<tr>
									<td align="left" colspan="2">
										You are applying for <b><font size="2"><?php echo $vacancy['nama']; ?></font></b>, posted by <b><font size="2"><?php echo $vacancy['company_nama']; ?></font></b>.<br /><br />
										Fill up the form below to apply as non-member. Alternatively, <a href="#"> click here to sign up and apply as member</a>
									</td>
								</tr>
								<tr><td colspan="2" height="15">&nbsp;</td></tr>
								<tr>
									<td colspan="2">
										<table id="table5" cellpadding="0" width="100%" align="center" border="0"><tbody>
										<tr>
											<td>&nbsp;</td>
											<td>
												<table id="table6" cellpadding="0" width="100%" align="center" border="0"><tbody>
												<tr>
													<td valign="top" align="left" nowrap=""><font color="red">*</font>Name</td>
													<td width="5"></td>
													<td valign="top">:</td>
													<td align="left">
														<input type="hidden" name="action" value="sent_vacancy" />
														<input type="hidden" name="vacancy_id" value="<?php echo $vacancy['id']; ?>" />
														
														<input name="first_name" type="text" maxlength="40" style="width: 49%;" class="required text" alt="Field empty"  />
														<input name="last_name" type="text" maxlength="40" style="float: right; width: 49%;" class="text"  />
													</td></tr>
												<tr>
													<td valign="top" align="left" nowrap=""><font color="red">*</font>Email</td>
													<td width="5"></td>
													<td valign="top">:</td>
													<td align="left"><input name="email" type="text" maxlength="80" size="63" class="required email text" alt="Field invalid" /></td></tr>
												<tr>
													<td valign="top" align="left" nowrap=""><font color="red">*</font>Re-enter Email</td>
													<td width="5"></td>
													<td valign="top">:</td>
													<td align="left"><input name="email_confirm" type="text" maxlength="80" size="63" class="required email text" alt="Field invalid" /></td></tr>
												<tr>
													<td valign="top" align="left" nowrap=""><font color="red">*</font>Mobile No.</td>
													<td width="5"></td>
													<td valign="top">:</td>
													<td align="left"><input name="mobile_no" type="text" maxlength="15" size="63" class="required text integer" alt="Field empty" ></td></tr>
												<tr>
													<td valign="top" align="left" nowrap="true"><font color="red">*</font>Nationality</td>
													<td width="5"></td>
													<td valign="top">:</td>
													<td align="left"><input name="kebangsaan" type="text" maxlength="30" size="63" class="required text" alt="Field empty" ></td></tr>
												<tr>
													<td valign="top" align="left" nowrap="true"><font color="red">*</font><span>Upload Resume</span></td>
													<td width="5"></td>
													<td valign="top">:</td>
													<td align="left">
														<input type="hidden" name="file_resume" value="" />
														<input type="button" class="upload_resume" value="Upload" />
														<span class="file-resume-info">Tidak ada file yang dipilih.</span><br />
														<span style="color:Navy;font-family:Verdana;">Only files with extension<b>*.doc, *.docx, *.pdf</b> are allowed.</span><br />
														<span style="color:Navy;font-family:Verdana;">Your file size should not exceed <b>250</b> KB.</span>
													</td>
												</tr>
												<tr>
													<td colspan="4">
														<table style="BORDER-TOP: #cccccc 0.5pt solid; PADDING-BOTTOM: 4px; PADDING-TOP: 4px; BORDER-BOTTOM: #cccccc 0.5pt solid; BACKGROUND-COLOR: #eeeeee" cellpadding="0" cellspacing="0" width="100%" align="center" border="0"><tbody>
														<tr valign="center"><td valign="top" align="left" nowrap=""><font color="blue"><u>Increase your chances of getting selected by providing more information</u></font></td></tr>
														<tr>
															<td colspan="2">
																<table id="tblExtraInfo" cellpadding="0" cellspacing="0" width="100%" align="center" border="0"><tbody>
																<tr><td colspan="5" height="4"></td></tr>
																<tr>
																	<td width="5"></td>
																	<td valign="top" align="left" nowrap="">Total Years of Experience</td>
																	<td valign="top">:</td>
																	<td align="left"><input name="year_of_experience" type="text" maxlength="2" class="text" style="width:100px" /></td>
																	<td width="100%"></td></tr>
																<tr>
																	<td width="5"></td>
																	<td valign="top" align="left" nowrap="">Current Position Title</td>
																	<td valign="top">:</td>
																	<td align="left"><input name="current_position" type="text" maxlength="50" class="text" style="width:350px" /></td>
																	<td width="100%"></td></tr>
																<tr>
																	<td width="5"></td>
																	<td valign="top" align="left" nowrap="">Company Name</td>
																	<td valign="top">:</td>
																	<td align="left"><input name="company_name" type="text" maxlength="50" class="text" style="width:350px" /></td>
																	<td width="100%"></td></tr>
																<tr>
																	<td width="5"></td>
																	<td valign="top" align="left" nowrap="">Monthly Salary</td>
																	<td valign="top">:</td>
																	<td align="left"><input name="monthly_salary" type="text" maxlength="50" class="text" style="width:350px" /></td>
																	<td width="100%"></td></tr>
																<tr>
																	<td width="5"></td>
																	<td valign="top" align="left" nowrap="">Expected Monthly Salary</td>
																	<td valign="top">:</td>
																	<td align="left"><input name="expected_monthly_salary" type="text" maxlength="50" class="text" style="width:350px" /></td>
																	<td width="100%"></td></tr>
																<tr>
																	<td width="5"></td>
																	<td valign="top" align="left" nowrap="">Highest Qualification</td>
																	<td valign="top">:</td>
																	<td align="left">
																		<select name="qualification" class="select" style="width:350px">
																			<?php echo ShowOption(array( 'Array' => $array_jenjang, 'ArrayID' => 'nama', 'ArrayTitle' => 'nama' )); ?>
																		</select>																																
																	</td>
																	<td width="100%"></td></tr>
																<tr>
																	<td width="5"></td>
																	<td valign="top" align="left" nowrap="">Field of Study</td>
																	<td valign="top">:</td>
																	<td align="left"><input name="field_of_study" type="text" maxlength="50" class="text" style="width:350px" /></td>
																	<td width="100%"></td></tr>
																<tr>
																	<td width="5"></td>
																	<td valign="top" align="left" nowrap="">Institute/University</td>
																	<td valign="top">:</td>
																	<td align="left"><input name="university" type="text" maxlength="100" class="text" style="width:350px" /></td>
																	<td width="100%"></td></tr>
																<tr><td colspan="5" height="4"></td></tr>
																</tbody></table>
															</td>
														</tr>
														</tbody></table>
													</td>
												</tr>	
												<tr><td colspan="4"></td></tr>
												<tr><td valign="top" align="left" colspan="4"><font color="red">*</font>Cover Letter</td></tr>
												<tr>
													<td valign="top" align="left" colspan="4">
														<table cellspacing="0" cellpadding="0" width="0" align="left" border="0"><tbody>
														<tr><td colspan="2">
															<textarea name="message" rows="20" cols="20" class="text" style="width:510px;" maxlength="4000"><?php echo $default_resume['content']; ?></textarea>
														</td></tr>
														<tr>
															<td nowrap="true" align="left"><font color="red">Maximum 3500 characters.</font></td>
															<td nowrap="true" align="right">Number of characters now: <span class="count_char">180</span></td></tr>
														</tbody></table>
													</td>
												</tr>
												<tr><td align="center" colspan="4"><input type="button" name="btnSend" value="Send My Application" /></td></tr>
												</tbody></table>
											</td>
										</tr>
										</tbody></table>
									</td>
								</tr>
								</tbody></table>
							</td>
						</tr>
						<tr><td class="normal" colspan="2"><hr /></td></tr>
						</tbody></table>
					</td>
				</tr>
				</tbody></table>
			</td>
		</tr>
		</tbody></table>
	</td>
</tr>
</tbody></table>
</form>

<table cellspacing="0" cellpadding="0" width="100%" align="center" border="0"><tbody>
<tr><td height="5"><img height="5" src="<?php echo base_url('static/img/space.gif'); ?>" width="1"></td></tr>
<tr>
	<td align="center"><font face="verdana" size="1">
		Copyright © 2013 <a href="http://www.parapekerja.com/" style="color: #666666">Duniakarir.com </a>
	</font></td>
</tr>
</tbody></table>

<script>
$( document ).ready(function() {
	upload_resume = function(p) {
		if (p.message != null && p.message.length > 0) {
			$('.file-resume-info').text(p.message);
		} else {
			$('#form-apply [name="file_resume"]').val(p.file_name);
			$('.file-resume-info').html('<a href="' + p.file_link + '" target="_blank">Resume</a>');
		}
	}
	
	// form
	$('#form-apply .upload_resume').click(function() { window.iframe_upload_resume.browse() });
	$('#form-apply [name="message"]').keyup(function() {
		// validation
		var message = $(this).val();
		if (message.length > 3500) {
			message = message.substr(0, 3500);
			$(this).val(message);
			return false;
		}
		
		$('.count_char').text(message.length);
	});
	$('#form-apply [name="btnSend"]').click(function() {
		var param = Site.Form.GetValue('form-apply');
		
		// validation
		var message = '';
		var valid = Site.Form.Validation('form-apply', { Inline: true });
		if (valid.length > 0) {
			message = 'Please fill all required field';
		}
		if (param.email != param.email_confirm) {
			message = 'Email must same';
		}
		if (param.file_resume.length == 0) {
			message = (message == '') ? 'Please upload resume' : message;
			valid.push(message);
		}
		if (param.message.length == 0) {
			message = (message == '') ? 'Cover Letter is empty' : message;
			valid.push(message);
		}
		if (valid.length > 0) {
			alert(message);
			return false;
		}
		
		Func.ajax({ url: web.host + 'ajax', param: param, callback: function(result) {
			alert (result.message);
		} });
	});
	
	// trigger
	$('#form-apply [name="message"]').keyup();
	Site.Form.Start('form-apply');
});
</script>

</body></html>