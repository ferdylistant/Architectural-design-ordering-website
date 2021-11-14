<?= $this->extend('Template/template_client') ;?>
<?= $this->section('content') ;?>
<!-- Page header section start -->
	<section class="page-header-section set-bg" data-setbg="assets/img/header-bg.jpg">
		<div class="container">
			<h1 class="header-title">Package<span>.</span></h1>
		</div>
	</section>
	<!-- Page header section end -->



	<!-- Intro section start -->
	<section class="intro-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-5">
					<div class="service-slider">
						<div class="ss-single">
							<img src="assets/img/service/1.jpg" alt="">
						</div>
						<div class="ss-single">
							<img src="assets/img/service/2.jpg" alt="">
						</div>
						<div class="ss-single">
							<img src="assets/img/service/3.jpg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-7 service-text">
					<h1>We offer top quality project <span>services</span></h1>
					<h2>01.Super-fast support.</h2>
					<p>Pellentesque lorem dolor, malesuada eget tortor vitae, tristique lacinia lectus. Pellentesque sed accumsan risus, id aliquam nulla. Integer lorem risus, feugiat at mauris malesuada, accumsan pellentesque ipsum. Nunc dapibus, libero ut pulvinar accumsan, tortor nisl iaculis ligula. </p>
					<ol>
						<li>02.Detailed documentation. </li>
						<li>03.Clean code.</li>
						<li>04.Great themes.</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<!-- Intro section end -->


	<!-- Service box section start -->
	<div class="service-box-section spad set-bg" data-setbg="assets/img/service-bg.jpg">
		<div class="container">
			<?php if (session()->getFlashdata('success') != null) { ?>
                    <div class="alert alert-success fixed-top alert-slide-up">
                        <span><?php echo session()->getFlashdata('success'); ?></span>
                    </div>
                    <?php } ?>
                    <?php if (session()->getFlashdata('error') != null) { ?>
                    <div class="alert alert-danger alert-slide-up fixed-top">
                        <span><?php echo session()->getFlashdata('error'); ?></span>
                    </div>
                    <?php } ?>
			<div class="row row-cols-1 row-cols-md-3 g-4">
			
				<?php foreach ($paket as $value) { ?>
				<div class="col">
					<div class="card h-100 rounded-3">
					<div class="bg-success bg-gradient card-header border-success">
						<h2 class="card-title text-white"><img src="<?= base_url()?>/assets/icons/png/034-ecommerce.png" class="img-fluid float-start" style="width:50px">&nbsp;<?= $value['nama_paket'];?></h2>
					</div>
					<div class="card-body text-start">
												
						<dd class="card-text fs-5 display-6"><i class="fa fa-barcode text-muted"></i>&nbsp;<?= rupiah($value['harga']);?></dd>
						<hr>
						<dd class="card-text fs-5 display-6"><i class="fa fa-home text-muted"></i>&nbsp;<?= $value['tipe']?></dd>
						<hr>
						<dd class="card-text fs-5 display-6"><i class="fa fa-expand text-muted"></i>&nbsp;Ukuran tanah <?= $value['ukuran_tanah'].$value['satuan']?></dd>
						<hr>
						<div class="row align-items-start">
							<div class="col">
								<div class="card border-success">
									<div class="card-header lead">
										<i class="fa fa-bookmark-o text-muted"></i>&nbsp;Fasilitas
									</div>
									<div class="card-body text-muted">
									<?= $value['nama_fasilitas'];?>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card border-success">
									<div class="card-header lead">
									<i class="fa fa-bookmark-o text-muted"></i>&nbsp;Arsitektur
									</div>
									<div class="card-body text-muted">
										<?= $value['ket_arsitektur'];?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<a href="<?= base_url()?>/package/cart/<?= base64_encode($value['id_paket'])?>" class="btn btn-dark bg-gradient form-control">PESAN</a>
					</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<!-- Service box section end -->


	<!-- Service section start -->
	<section class="service-section spad">
		<div class="container">
			<div class="section-title">
				<h1>Services</h1>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="service-box">
						<div class="sb-icon">
							<div class="sb-img-icon">
								<img src="assets/img/icon/dark/1.png" alt="">
							</div>
						</div>
						<h3>Exterior Designs</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed dui eget lorem tincidunt.</p>
						<a href="#" class="readmore">READ MORE</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="service-box">
						<div class="sb-icon">
							<div class="sb-img-icon">
								<img src="assets/img/icon/dark/2.png" alt="">
							</div>
						</div>
						<h3>Interior Design</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed dui eget lorem tincidunt.</p>
						<a href="#" class="readmore">READ MORE</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="service-box">
						<div class="sb-icon">
							<div class="sb-img-icon">
								<img src="assets/img/icon/dark/3.png" alt="">
							</div>
						</div>
						<h3>Buildings</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed dui eget lorem tincidunt.</p>
						<a href="#" class="readmore">READ MORE</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="service-box">
						<div class="sb-icon">
							<div class="sb-img-icon">
								<img src="assets/img/icon/dark/4.png" alt="">
							</div>
						</div>
						<h3>Architecture</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed dui eget lorem tincidunt.</p>
						<a href="#" class="readmore">READ MORE</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="service-box">
						<div class="sb-icon">
							<div class="sb-img-icon">
								<img src="assets/img/icon/dark/5.png" alt="">
							</div>
						</div>
						<h3>Executor</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed dui eget lorem tincidunt.</p>
						<a href="#" class="readmore">READ MORE</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="service-box">
						<div class="sb-icon">
							<div class="sb-img-icon">
								<img src="assets/img/icon/dark/6.png" alt="">
							</div>
						</div>
						<h3>Furniture</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed dui eget lorem tincidunt.</p>
						<a href="#" class="readmore">READ MORE</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Service section end -->



	<section class="promo-section pt-0">
		<div class="promo-box set-bg" data-setbg="assets/img/bg.jpg">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 promo-text">
						<h1>In need of a <span>fabulouse</span> home?</h1>
						<p>Pellentesque lorem dolor, malesuada eget tortor vitae, tristique lacinia lectus. Pellentesque sed accumsan risus.</p>
					</div>
					<div class="col-lg-3 text-lg-right">
						<a href="#" class="site-btn sb-light mt-4">Get in Touch</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
        $this->cart = cart();
        if (!empty($this->cart->contents())) { ?>
			<div class="row justify-content-center fixed-bottom">
				<div class="col-sm-3">
					<div class="card h-100" style="border-left: 5px solid;box-shadow: 0 8px 8px 0 rgba(0,0,0,0.2);">
						<div class="card-body alert alert-dismissible" role="alert">
							<ul class="list-group list-group-flush w-100 h-100">
								<li class="list-group-item text-center w-100 h-100">
									<span class="fs-5 display-1 text-muted">
										<img src="<?= base_url()?>/assets/icons/png/041-barcode.png" class="-webkit-filter: grayscale(100%);filter: grayscale(100%);" width="25px">&nbsp;
										<strong>Total:</strong>
									</span>
									<span class="fs-5 display-5 text-muted"><?= rupiah($this->cart->total())?></span>
								</li>
								<li class="list-group-item text-center w-100 h-100">
									<a href="<?= base_url()?>/package/cart" class="btn btn-warning align-items-center">
										Lihat Keranjang
									</a>
								</li>
							</ul>
							
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
							<?= count($this->cart->contents());?>
							<span class="visually-hidden">New alerts</span>
						</span>
						</div>
						
					</div>
				</div>
			</div>
		<?php } ?>
<?= $this->endSection() ;?>