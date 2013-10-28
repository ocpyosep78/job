<?php
	$seeker = $this->Seeker_model->get_session();
	$is_login = $this->Seeker_model->is_login();
	
	// company
	$company = $this->Company_model->get_by_id(array( 'id' => $vacancy['company_id'] ));
	
	// add view
	$this->Vacancy_model->update_view($vacancy);
	$is_expired = $this->Vacancy_model->is_expired(array( 'id' => $vacancy['id'] ));
	$string_jenjang = $this->Vacancy_model->get_string_jenjang(array( 'id' => $vacancy['id'] ));
	
	// page property
	$is_apply = false;
	if ($is_login) {
		$is_apply = $this->Apply_model->is_apply(array( 'seeker_id' => $seeker['id'], 'vacancy_id' => $vacancy['id'] ));
	}
?>
<html><head>

 
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->  <!--<![endif]-->

	<title><?php echo $vacancy['nama'].' - '.$vacancy['company_nama']; ?></title>
        <meta name="Title" content="<?php echo $vacancy['nama'].' - '.$vacancy['company_nama']; ?>" />
        <meta name="Description" content="Kami adalah perusahaan yang bergerak di bidang <?php echo $vacancy['industri_nama']; ?>, saat ini kami sedang berkembang dengan pesat dan membutuhkan Anda sebagai profesional untuk maju berkembang bersama kami, sebagai :" />
        <meta name="Keywords" content="<?php echo $vacancy['company_nama']; ?>, <?php echo $vacancy['industri_nama']; ?> "/> 
        <link rel="canonical" href="Lowongan kerja terbaru"/> 
        <link rel="image_src" href="<?php echo $vacancy['company_logo_link']; ?>" />
        <meta name="author" content="<?php echo $vacancy['company_nama']; ?>" />
        <meta http-equiv="Content-Language" content="id_ID"/>
        <meta name="robots" content="index,follow"/>


	<script type="text/javascript">var web = { host: '<?php echo base_url(); ?>' };</script>
		<script type="text/javascript" src="<?php echo base_url('static/js/jquery-1.8.2.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('static/js/common.js'); ?>"></script>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, 
initial-scale=1.0">
 
<link rel="stylesheet" id="bootstrap-css" 
href="<?php echo base_url('static/detail/bootstrap.css'); ?>" type="text/css" media="all">
<link rel="stylesheet" id="theme-css" href="<?php echo base_url('static/detail/getCss.css'); ?>" 
type="text/css" media="all">   
 
<script type="text/javascript" src="<?php echo base_url('static/detail/jquery_007.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('static/detail/site.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('static/detail/bootstrap.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('static/detail/jquery_006.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('static/detail/jquery.js'); ?>"></script>
  

 
 

    

    </head><body> 
<input type="hidden" name="vacancy_id" value="<?php echo $vacancy['id']; ?>" />
<input type="hidden" name="is_login" value="<?php echo ($is_login) ? 1 : 0; ?>" />
 

    <div class="container header-wrap">
	<!--
<div class="author-wrap">
                        <h5><?php echo $vacancy['company_nama']; ?></h5>


                        <img class="avatar avatar-106 photo grav-hashed 
grav-hijack" src="<?php echo $vacancy['company_logo_link']; ?>" 
alt="" id="grav-7de416ec7d636a929b5e0abb9b2dbffe-0" width="106" 
height="106">                        <div class="desc">
 <div><a rel="author" title="Posts by Barney Cornel" href="#">a</a></div>   
                            Aliquam eget est justo. Morbi gravida velit 
ut enim aliquet mattis. Nulla ac quam quam, ut vestibulum dolor. Ut 
fringilla, arcu quis facilisis sagittis, tellus nulla pulvinar neque, 
eget eleifend odio tortor id eros. Nulla lacus odio, dictum vel 
vestibulum vel, egestas ac ipsum.                       </div>
                        <div class="author-more">
                            <a href="#">More About PT Arahan Mandiri</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
    </div> -->
 
 
	 
	
                <div class="container page-wrapper">
                    <div class="row page-sidebar-right 
page-content-height">

                       

                        <!-- #content -->
                        <div id="content" class="span8 content-left">
                            <div class="content-left-wrap">
                                
    
    
    

        


        <!-- .post -->
        <article id="post-830" class="post-830 page type-page 
status-publish hentry post">

            

            
            <!--
            <h1>  <div class="job-ad-client-name coName">            
          <span itemprop="hiringOrganization"><a href="<?php echo $vacancy['company_link']; ?>"><?php echo $vacancy['company_nama']; ?></a>
		  </span>  
                             </div>  </h1> -->
<div class="job-ad-contents">                                   <div 
class="job-ad-client-logo jobLogo">                                   <img
 src="<?php echo $vacancy['company_banner_link']; ?>" style="display: inline; width: 
560px;">                               </div>                  <div 
class="job-ad-client-info coDesc">  
<br/><br/><br/><center>
	<div style="text-decoration: none; font-size: 22px; font-weight: bold;">
		<a href="<?php echo $vacancy['company_link']; ?>"><?php echo $vacancy['company_nama']; ?></a>
	</div>
	<div><?php echo $vacancy['job_reff']; ?></div>
</center>




<br/>
<br/>
<br/>

	<!-- <div>Kami adalah perusahaan yang bergerak di bidang <?php echo $vacancy['industri_nama']; ?>, saat ini kami sedang berkembang dengan pesat dan membutuhkan Anda sebagai profesional untuk maju berkembang bersama kami, sebagai :</div>
<br/><br/> -->	
<div style="text-align: center;">
	<div style="font-size: 24px; font-weight: bold;"><?php echo $vacancy['nama']; ?></div>
	<div style="font-size: 13px;"><?php echo $vacancy['kota_nama']; ?></div>
</div>


<div style="font-size: 13px;"><?php echo $vacancy['content']; ?></div>

 <!--
	<div style="text-align: center;">Pelamar Tertarik dapat mengirimkan CV dan Foto Terbaru ke email :</div>
	<div style="text-align: center;">&nbsp;</div>
	<div style="text-align: center;"><?php echo $vacancy['email_apply']; ?></div>
	<div style="text-align: center;">&nbsp;</div>
	<div style="text-align: center;">" Hanya kandidat yang memenuhi persaratan yang akan di panggil untuk interview "</div>
	<div style="text-align: center;">&nbsp;</div>
	<div style="text-align: center;"><?php echo $vacancy['company_website']; ?></div>
 -->

 
    </div>       


   </div>
            
            <br> <br><!--
            		<center>
				<a style="background-color: rgb(14, 112, 168);" href="#" class="btn 
btn-large ">Apply</a>
		
		</center> -->
            
					<div class="cnt-apply" style="padding: 30px 0 30px 0; text-align: center;">
			<?php if ($is_apply) { ?>
			Anda sudah melamar lowongan ini.
			<?php } else if ($is_expired) { ?>
			Iklan lowongan ini sudah berakhir.
			<?php } else { ?>
			<div style="width: 300px; margin: 0 auto; font-size: 12px;">
				<div style="float: left; width: 50%;">
					<div>&nbsp;</div>
					<div><input type="button" class="apply" style="font-weight: bold; width: 100px" value="Apply" /></div>
				</div>
				<div style="float: left; width: 50%;">
					<?php if ($vacancy['vacancy_submit_via'] == VACANCY_SUBMIT_VIA_LINK) { ?>
					<div style="padding: 19px 0 0 0;">Quick Apply tidak tersedia</div>
					<?php } else { ?>
					<div>Non Member</div>
					<div><input type="button" class="quick" style="font-weight: bold; width: 100px" value="Quick Apply" data-quick-link="<?php echo $vacancy['vacancy_quick_apply_link']; ?>" /></div>
					<?php } ?>
				</div>
				<div style="clear: both;"></div>
			</div>
			<?php } ?>
		</div>
			
			
			
			
        </article> <!-- /.post -->
    
    


                                
                            </div>
                            
                                        <!-- the footer -->
            <div id="footer" class="footer-left">
         <!--       <div class="footer-main">
                    <div class="footer-logo">
                        			<div class="textwidget"><img 
src="Newses3/logo-footer.png" alt=""></div>
		                    </div>
                    
                    <div class="footer-menu">
                        			<div class="textwidget"><span><a 
href="http://tagdiv.com/tagdiv.com/theme/newses/category/politics">Politics</a></span>
<span><a 
href="http://tagdiv.com/tagdiv.com/theme/newses/category/gadget">Gadget</a></span>
<span><a href="<?php echo base_url(); ?>">Tech</a></span>
 </div>
		                    </div>
                </div> -->
                <div class="clearfix"></div>
                
                
                
                <div class="row footer-bottom">
                    <div class="half-grid footer-copy">			<div 
class="textwidget">© Copyright 2013 - <a href="<?php echo base_url(); ?>" target="new" title="Lowongan kerja <?php echo $vacancy['company_nama']; ?>" alt="Lowongan kerja <?php echo $vacancy['company_nama']; ?>">Parapekerja.com</a></div>
		</div>
                     
                </div>
            </div> 
            <!-- /#footer -->                        </div>
                        
                        
                        <!-- #sidebar -->
						
  <div style="height: 1598px;" id="sidebar" class="span4 widget-area">
                            <aside class="widget ScrollInfoWidget">     
   <div class="side-scroll-affix sidebar-scroll-widget affix-top" 
data-offset-top="10">
            <div id="content-scroll-header">
<div style="text-align: center; color: #000000; font-size: 12px;">
		Advertised: <?php echo $vacancy['publish_date']; ?> | 
		Closing Date: <?php echo $vacancy['close_date']; ?>
	</div> <br/>
            </div>
           
        <table class="job-ad-data-table jobSum">    <tbody><tr><th 
class="label">Career Level</th><td>Entry Level</td></tr>     <tr><th 
class="label">Yr(s) of Exp</th><td itemprop="experienceRequirements"><?php echo ''.$vacancy['pengalaman_nama']; ?></td></tr>     <tr><th class="label">Qualification</th><td 
itemprop="educationRequirements"><?php echo ''.$string_jenjang; ?></td></tr>     <tr><th 
class="label">Industry</th><td itemprop="industry"><?php echo ''.$vacancy['subkategori_nama']; ?><br /></td></tr><br />
    
		<tr> <th class="label">Location</th>      <td><span 
itemprop="jobLocation"><?php echo ''.$vacancy['propinsi_nama']; ?>,<br />
			<?php echo ''.$vacancy['kota_nama']; ?><br /></span>     <br>      </td>     </tr> 
    <tr><th class="label">Salary</th><td itemprop="baseSalary"><?php echo ''.(empty($vacancy['gaji']) ? 'Not Specified' : $vacancy['gaji']); ?></td></tr>
	<tr><th class="label">Employment Type</th><td itemprop="employmentType"><?php echo ''.$vacancy['jenis_pekerjaan_nama']; ?></td></tr>
	<tr><th class="label">Company Code</th><td><?php echo $company['code_random']; ?></td></tr>
	
                      </tbody></table>
 

        </div>  
          
        </aside>                            
                   
                        </div>
                    </div>
                </div>

	
      

  			
<script>
	var is_login = ($('[name="is_login"]').val() == 1) ? true : false;
	
	$('.cnt-apply .apply').click(function() {
		if (!is_login) {
			alert('Silahkan Login Untuk Melamar.');
			return false;
		}
		
		var param = { action: 'apply', vacancy_id: $('[name="vacancy_id"]').val() }
		Func.ajax({ url: web.host + 'ajax', param: param, callback: function(result) {
			if (result.redirect != null && result.redirect) {
				window.open(result.redirect_link);
				return;
			}
			
			$('.cnt-apply').text(result.message);
		} });
	});
	
	$('.cnt-apply .quick').click(function() {
		window.location = $(this).data('quick-link');
	});
</script>

      
  
  </body></html>