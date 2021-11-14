<?= $this->extend('Template/template_client') ;?>
<?= $this->section('content') ;?>
<!-- Page header section start -->
	<section class="page-header-section set-bg" data-setbg="assets/img/header-bg.jpg">
		<div class="container">
			<h1 class="header-title">Sign-In<span>.</span></h1>
		</div>
	</section>
	<!-- Page header section end -->


	<!-- Testimonials section start -->
	<section class="testimonials-section spad">
		<div class="testimonials-image-box"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-7 pl-lg-0 offset-lg-5">
					<h1>Sign-<span>In</span></h1>
					<?php if (!empty(session()->getFlashdata('success'))) { ?>
                <div class="alert alert-success alert-slide-up" role="alert">
                    <h4>Notifikasi</h4>
                    </hr />
                    <?php echo session()->getFlashdata('success'); ?>
                </div>
            <?php } elseif (!empty(session()->getFlashdata('error'))) { ?>
				<div class="alert alert-warning alert-slide-up" role="alert">
                    <h4>Notifikasi</h4>
                    </hr />
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
			<?php } ?>
                    <?php echo form_open(base_url('/signin/process'))?>
                            <div class="form-group">
                                <label for="email_client" style="color:white">E-mail</label>
                                <input type="email" class="form-control" placeholder="example@mail.com" name="email_client">
                            </div>
                            <div class="form-group">
                                <label for="password_client" style="color:white">Password</label>
                                <input type="password" class="form-control" placeholder="*********" name="password_client">
                            </div>
                            <button type="submit" class="btn btn-default login-popup-btn" name="submit" value="1"><i class="fa fa-sign-in"></i>&nbsp;Login</button>
                        <?php echo form_close()?>
                        <div class="form-group">
                        <div class="text-center" style="color:white">Forgot password? <a class="pwd-forget" href="#" data-bs-toggle="modal" data-bs-target="#lupaPass">click here</a></div>
                        <div class="text-center" style="color:white">Not registered yet? <a class="pwd-forget" href="<?php echo base_url()?>/signup">click here</a></div>
                        </div>
                        
                </div>
			</div>
		</div>
	</section>
	<!-- Testimonials section end -->
<?= $this->endSection() ;?>