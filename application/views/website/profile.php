<?php
	$seeker_temp = $this->Seeker_model->get_by_id(array( 'alias' => $seeker_alias ));
	$seeker = $this->Seeker_model->get_by_id(array( 'id' => $seeker_temp['id'] ));
	
	// data
//	print_r($seeker);
?>
<!DOCTYPE html>
<html class="csstransforms no-csstransforms3d csstransitions"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

		<title>Flat CV</title>	
		<meta charset="UTF-8">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">

		<link rel="stylesheet" href="http://parapekerja.com/static/css/responsive-profile.css">
		<link rel="stylesheet" href="http://parapekerja.com/static/css/style-profile.css">


		<link rel="stylesheet" href="profil_files/style.css">
		<link rel="stylesheet" href="profil_files/responsive.css">
 	
	
		<!--[if lt IE 9]>
	        <script src="assets/html5shiv.js"></script>
	    <![endif]-->
 	</head>
	<body>
		<div id="page">
			<header id="header">
				<ul id="nav_tabs">
					<li class="splash current">
						<a href="#splash">
							<div id="profile_photo">
								<img src="<?php echo $seeker['photo_link']; ?>" alt="<?php echo $seeker['full_name']; ?>" width="150" height="150">
							</div>
							<div id="profile_name">
								<div id="author_name">
									<div class="profile_inner">
										<!-- You can edit name and lastname -->
										<div class="name"><?php echo $seeker['full_name']; ?></div>
										<div class="pos">Member of Parapekerja.com</div>
									</div>
								</div>
							</div>
						</a>
					</li>
					<li class="profile"><a href="#profile"><span class="icon">a</span></a></li>
					<li class="portfolio"><a href="#portfolio"><span class="icon">b</span></a></li>
					<li class="contacts"><a href="#contacts"><span class="icon">c</span></a></li>
				</ul>
			</header><!-- /Header -->
			<div id="main">
				<div id="tab_section">
					<div style="display: block;" id="splash" class="tab_content"><!-- Main page -->
						<div class="author_info">
							<div class="user_desc"><?php echo $seeker['about_me']; ?></div>
							<div class="phone_num">
								<span class="icon"></span>
								<span class="phone"><?php echo $seeker['phone']; ?></span>
							</div>
							<div class="addition">
								<span class="email"><?php echo $seeker['email']; ?></span>
								<!--	<span class="website"><a href="#">http://www.jjohnson.com</a></span> -->
							</div>
						</div>
						
					</div><!-- /Main Page -->
					
					
					
					
					
					
				</div>
			</div><!-- /Main -->
			<footer id="footer">
				<a style="display: none;" href="#" id="toTop"></a>
				<div class="footer_copyright">
					Copyright © 2013 - <?php echo $seeker['full_name']; ?>. All rights reserved.
				</div>
			</footer>
 
			
		</div><!--/Page-->
	
</body></html>