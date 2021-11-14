<?= $this->extend('Template/template_client') ;?>
<?= $this->section('content') ;?>
<!-- Page header section start -->
	<section class="page-header-section set-bg" data-setbg="assets/img/header-bg.jpg">
		<div class="container">
			<h1 class="header-title">Sign-Up<span>.</span></h1>
		</div>
	</section>
	<!-- Page header section end -->


	<!-- Testimonials section start -->
	<section class="testimonials-section spad">
		<div class="testimonials-image-box"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-7 pl-lg-0 offset-lg-5">
					<h1>Sign-<span>Up</span></h1>
                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <h4>Periksa Entrian Form</h4>
                    </hr />
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
                        <?php echo form_open(base_url('/signup/process'))?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama_client" style="color:white">Full Name</label>
                                    <input type="text" class="form-control" placeholder="Your name" id="nama_client" name="nama_client" required>
                                </div>
                                <div class="form-group">
                                    <label for="email_client" style="color:white">Email Address</label>
                                    <input type="email" class="form-control" placeholder="example@mail.com" id="email_client" name="email_client" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_client_client" style="color:white">Address</label>
                                    <textarea class="form-control" id="alamat_client" name="alamat_client"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="telp_client" style="color:white">Phone Number</label>
                                    <input type="text" class="form-control" placeholder="Your phone number" id="telp_client" name="telp_client" required>
                                </div>
                                <div class="form-group">
                                    <label for="password_client" style="color:white">Password</label>
                                    <input type="password" class="form-control" placeholder="*********" id="password_client" name="password_client" required>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirm" style="color:white">Password Confirm</label>
                                    <input type="password" class="form-control" placeholder="*********" id="password_confirm" name="password_confirm" required>
                                </div>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-default login-popup-btn" name="submit" value="1"><i class="fa fa-user-plus"></i>&nbsp;Register</button>
                        <?php echo form_close()?>
                        <div class="form-group">
                        <div class="text-center" style="color:white">Have an account? <a class="pwd-forget" href="<?php echo base_url()?>/login">sign-in</a></div>
                        </div>
                        
                </div>
			</div>
		</div>
	</section>
	<!-- Testimonials section end -->

<?= $this->endSection() ;?>