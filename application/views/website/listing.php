<?php $this->load->view( 'website/common/meta' ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<section id='main'>
	<div class='container'><div class='row'>
		<div class='span9 content grey'>
			<h1>New Albums</h1>
			<div class='options-line'>
				<div class='breadcrumb-container'>
					<ul class="breadcrumb">
						<li><a href="index.html">Index</a> <span class="divider">&raquo;</span></li>
						<li class="active">Listing</li>
					</ul>
				</div>
				<div class='buttons'>
					<div class="btn-group">
						<button class="btn dropdown-toggle" data-toggle="dropdown">Sort By Region <span class="caret"></span></button>
					</div>
					<div class="btn-group">
						<button class="btn dropdown-toggle" data-toggle="dropdown">Clasic <span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
					</div>
					<a href="#" class='btn-view list'>List</a>
				   
				</div>
			</div>
			<div class='new-albums list'>

				<div class='new-album-box'>
				<div style="margin-left:15px;">Kategori Accounting - Sub kategori Finance </div>
					<div class='inner'>
					
						<figure>
							<img src='<?php echo base_url(); ?>static/upload/artwork01.png' alt='' />
						</figure>
						<div class='details'>
							<h2><a href='#'>Office Boy Rangkap Manager</a></h2>
							<p>
							   PT Garuda Indonesa (Persero) Tbk - Lokasi kerja
								
							</p>
							<div class="extra-field">
<ul>
	<li id="m_tipe"><strong>Tipe Pekerjaan</strong> : Magang</li>
		<li id="m_fuel"><strong>Lokasi</strong> : Seluruh Indonesia</li>
	   
</ul>

</div>


						</div>
						<div class='options'>
							<div class='star-rating'>
							   11-05-2013
							</div>
							<span class='price'> </span>

						</div>
					</div>
				</div>
				 <div class='new-album-box'>
				<div style="margin-left:15px;">Kategori Accounting - Sub kategori Finance </div>
					<div class='inner'>
					
						<figure>
							<img src='<?php echo base_url(); ?>static/upload/artwork01.png' alt='' />
						</figure>
						<div class='details'>
							<h2><a href='#'>Office Boy Rangkap Manager</a></h2>
							<p>
							   PT Garuda Indonesa (Persero) Tbk - Lokasi kerja
								
							</p>
							<div class="extra-field">
<ul>
	<li id="m_tipe"><strong>Tipe Pekerjaan</strong> : Magang</li>
		<li id="m_fuel"><strong>Lokasi</strong> : Seluruh Indonesia</li>
	   
</ul>

</div>
						</div>
						<div class='options'>
							<div class='star-rating'>
							   11-05-2013
							</div>
							<span class='price'>  </span>

						</div>
					</div>
				</div>                          
			</div>

			<div class='standard-pagination'>
				<ul>
					<li class='active'><a href='#' class='btn'>1</a></li>
					<li><a href='#' class='btn'>2</a></li>
					<li><a href='#' class='btn'>3</a></li>
					<li><a href='#' class='btn'>4</a></li>
					<li><a href='#' class='btn'>5</a></li>
					<li><a href='#' class='btn'>6</a></li>
					<li><a href='#' class='btn'>7</a></li>
					<li><a href='#' class='btn'>8</a></li>
					<li><a href='#' class='btn'>9</a></li>
					<li><a href='#' class='btn'>10</a></li>
				</ul>
			</div>
		</div>
		
		<aside class='span3'>
			<div class='inner'>
				<?php $this->load->view( 'website/common/register' ); ?>
				<?php $this->load->view( 'website/common/category_list' ); ?>
				<?php $this->load->view( 'website/common/site_banner' ); ?>
			</div>
		</aside>
	</div></div>
</section>

<?php $this->load->view( 'website/common/footer' ); ?>