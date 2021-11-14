<?= $this->extend('Template/template_client') ;?>
<?= $this->section('content') ;?>
<!-- Page header section start -->
	<section class="page-header-section set-bg" data-setbg="assets/img/header-bg.jpg">
		<div class="container">
			<h1 class="header-title">Portofolio<span>.</span></h1>
		</div>
	</section>
	<!-- Page header section end -->


	<!-- Page section start -->
	<div class="page-section spad">
		
		<!-- portfolio items -->
		<div class="portfolio-warp spad">
			<div id="portfolio">
				<div class="grid-sizer"></div>
				<!-- portfolio item -->
				<?php foreach ($gambar as $value) { ?>
				<div class="grid-item set-bg design corp" data-setbg="http://admin.desainrumah.com/uploads/portofolio/<?= $value['gambar_portofolio'];?>">
					<a class="img-popup" href="http://admin.desainrumah.com/uploads/portofolio/<?= $value['gambar_portofolio'];?>">
					<center>
						<h3 class="fw-bold text-white display-6 pt-5"><?= $value['nama_portofolio']?>
						<p class="fs-4"><?= $value['nama_kategori_portofolio']?></p></h3>
						<p class="lead text-white" style="padding-top:30%"><?= $value['keterangan']?></p>
						
					</center>
					</a>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<!-- Page section end -->
<?= $this->endSection() ;?>