<?php $this->load->view( 'website/common/meta' ); ?>
<?php $this->load->view( 'website/common/header' ); ?>

<section id='main'>
	<div class='container'><div class='row'>
		<div class='span9 content'>
			<div class='main-top span9'>
				<div class='span9 no-margin'>
					<div class='options-line'>
						<div class='breadcrumb-container'>
							<ul class="breadcrumb">
								<li><a href="index.html">Index</a> <span class="divider">&raquo;</span></li>
								<li><a href="new-albums.html">Company</a> <span class="divider">&raquo;</span></li>
								<li class="active">PT Garuda Indonesa (Persero) Tbk</li>
							</ul>
						</div>
					</div>
					<h1>PT Garuda Indonesa (Persero) Tbk</h1>
				</div>
			</div>
			<div class='span9 no-margin album-article'>
				<figure>
					<img src="<?php echo base_url(); ?>static/upload/big-artwork.jpg" alt="" />
				</figure>
				
				<div class='info-line'><span>Industry : </span> BioTechnology / Pharmaceutical / Clinical research </div>
				<div class='info-line'><span>Company Address : </span> Jl. Limo No. 40 Permata Hijau Senayan Jakarta Selatan 10015 </div>
				<div class='info-line'><span>Country: </span> Indonesia </div>
				<div class='info-line'><span>Sales: </span> 1 214 324 </div>
				<div class='buy'>
					<span class='price'>Lihat Peta</span> <span class='price'>Laporkan</span>
					<a href="#" title='Buy' class='btn btn-blue buy-album'> Subscribe</a>
				</div>
				
				<p class='description'>PT PLN Indonesia adalah merupakan satu dari lima perusahaan farmasi terbesar di Indonesia. Berdiri sejak tahun 1971 dan telah memiliki cabang-cabang yang tersebar di kota-kota besar di seluruh Indonesia dan telah memiliki lebih dari 6000 karyawan. Kami ingin memberikan kesempatan kepada profesional muda untuk bergabung menjadi bagian dari Pharos Group serta mengembangkan kemampuan di bidang masing-masing. </p>
			</div>
			<div class='span9 album-files no-margin'>
				<h1>Lowongan Yang Tersedia</h1>
				<hr />
				
				<div class="jp-audio custom">Saat Ini tidak ada lowongan yang tersedia</div>
				
				<div class="jp-audio custom"><a>J. Lanng - In Peace, The Love & Happiness Mix</a></div>
				<div class="jp-audio custom"><a>J. Lanng - In Peace, The Love & Happiness Mix</a></div>
				<div class="jp-audio custom"><a>J. Lanng - In Peace, The Love & Happiness Mix</a></div>
			</div>
		</div>
		
		<aside class='span3'>
			<div class='inner'>
				<?php $this->load->view( 'website/common/register' ); ?>
				<?php $this->load->view( 'website/common/site_banner' ); ?>
			</div>
		</aside>
	</div></div>
</section>

<?php $this->load->view( 'website/common/footer' ); ?>