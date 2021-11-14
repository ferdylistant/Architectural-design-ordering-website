<!DOCTYPE html>
<html lang="en">
<head>
	<title>Karina - <?php echo $title?></title>
	<meta charset="UTF-8">
	<meta name="description" content="Karina - Creative Design">
	<meta name="keywords" content="karina, architecture, design, creative">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="<?= base_url()?>/logo.png" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

	<!-- Stylesheets -->
	<!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css"/> -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
  <!--===============================================================================================-->
  <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css"/>
  <!--===============================================================================================-->
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"/>
	<link rel="stylesheet" href="<?= base_url()?>/assets/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="<?= base_url()?>/assets/css/animate.css"/>
	<link rel="stylesheet" href="<?= base_url()?>/assets/css/owl.carousel.css"/>
	<link rel="stylesheet" href="<?= base_url()?>/assets/css/style.css"/>
	<link rel="stylesheet" href="<?= base_url()?>/assets/css/util.css"/>
	<link rel="stylesheet" href="<?php echo base_url()?>/assets/alert/css/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="http://admin.desainrumah.com/assets/vendor/lightbox2/css/lightbox.min.css">
	<script>
		var id = "<?= session()->get('id_client') ?>";
		var baseurl = "<?php echo base_url();?>/"; // Buat variabel baseurl untuk nanti di akses pada file config.js
	</script>
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
		.glow {
			font-family: cursive;
			font-size: 50px;
			color: #fff;
			text-align: center;
			animation: glow 1s ease-in-out infinite alternate;
			}

			@-webkit-keyframes glow {
			from {
				text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;
			}
			
			to {
				text-shadow: 0 0 20px #fff, 0 0 30px #ff4da6, 0 0 40px #ff4da6, 0 0 50px #ff4da6, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6;
			}
		}
	</style>

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	
	<!-- Header section start -->   
	<header class="header-area">
		<a href="<?php echo base_url()?>/" class="logo-area">
			<img src="<?= base_url()?>/logo.png" alt="" style="width:150px;height:80px">
		</a>
		<div class="nav-switch">
			<i class="fa fa-bars"></i>
		</div>
		
            <?php if (session()->get('logged_in')) { ?>
				<div class="dropdown" id="dropdownMenuLink">
				<div class="phone-number fw-light lead">
					<?php
                    $client = new \App\Models\Client();
                    $dataUser = $client->where([
            'email_client' => session()->get('email_client')])->first();
                    ?>
					Hello,&nbsp;<?php echo session()->get('nama_client')?>&nbsp;
					<a class="dropdown-toggle" href="#" style="color: #121212; text-decoration: none" role="button"  data-bs-toggle="dropdown" aria-expanded="false">
					
					<?php if (!empty($dataUser['pict_client'])) { ?>
						<img class="rounded-circle" src="<?= base_url()?>/uploads/profile/<?php echo $dataUser['pict_client']?>" alt="" width="40px" style="height:40px">
					<?php } else { ?>
						<img class="rounded-circle" src="<?= base_url()?>/assets/img/user.jpg" alt="" width="40px">
					<?php } ?>
					</a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
						<li><a class="dropdown-item" href="<?php echo base_url('/profile?c='.base64_encode(session()->get('id_client')).'&em='.base64_encode(session()->get('email_client')))?>"><i class="fa fa-user-circle-o"></i>&nbsp;Profile</a></li>
						<li><a class="dropdown-item" href="#"><i class="fa fa-gears"></i>&nbsp;Setting</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url()?>/logout"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
					</ul>
					</div>
			</div>
			<?php } else { ?>
			<div class="autentikasi">
				<a href="<?php echo base_url('/signup')?>" type="button" class=" btn--border btn-read btn--animated" style="text-decoration: none"><i class="fa fa-user-plus"></i>&nbsp;Sign-up</a>
            <a href="<?php echo base_url('/signin')?>" type="button" class=" btn--border btn-read btn--animated" style="text-decoration: none"><i class="fa fa-sign-in"></i>&nbsp;Sign-in</a>
			</div>
			<?php } ?>
            
            

        
		<nav class="nav-menu">
			<ul id="aa-header">
				<li><a href="<?php echo base_url()?>" style="text-decoration: none">Home</a></li>
				<li><a href="<?php echo base_url('/package')?>" style="text-decoration: none">Package</a></li>
				<li><a href="<?php echo base_url();?>/portofolio" style="text-decoration: none">Portofolio</a></li>
				<li><a href="<?php echo base_url();?>/about-us" style="text-decoration: none">About us</a></li>
				<li><a href="<?php echo base_url();?>/contact" style="text-decoration: none">Contact</a></li>
				<li class="aa-header-bottom" id="awal_badge">
					<a href="#" class="aa-cartbox" aria-expanded="false">
					<span class="fa fa-shopping-cart aa-cart-link position-relative" aria-expanded="false"></span>
					<?php
                    $this->cart = cart();
                    $output = '';
                    if (!empty($this->cart->contents())) {
                        $output .='<span class="position-absolute start-100 translate-middle badge rounded-pill text-dark" style="top:39px; background-color: #baff00">'.
                            count($this->cart->contents()).'
							<span class="visually-hidden">unread messages</span>
						</span>	
						<ul class="dropdown-menu aa-cartbox-summary">
							<li id="cart" style="overflow-x: hidden;overflow-y: scroll;height: 330px">';
                        foreach ($this->cart->contents() as $value) {
                            $id = $value['id'];
                            $this->paket = new \App\Models\PaketProdukModel();
                            $detail = $this->paket->getPaketId($id);
                            foreach ($detail as $krj) {
                                $output .= '<div class="cart-food">
									<div class="item col-lg-12 p-t-10">
										<div class="text p-t-10" style="float: left; margin: 0 0 0 ;">
											<span class="tit10">'.$value['name'].'</span>
											<p>'.$value['qty'].' x '.rupiah($value['price']).'</p>
										</div>
										<div class="sub-total p-b-15" style="margin: 0 0 0 0; float: left; width: 100%;border-bottom: dashed;" >
											<span>SUBTOTAL: <strong>'.rupiah($value['subtotal']).'</strong></span>
										</div>
									</div>
								</div>';
                            }
                        }
                        $output .= '</li>
							<li class="divider"></li>
							<li>
								<div style="margin: 0 0 0 0; float: right; width: 100%;" >
								<span>TOTAL: <strong><?= $this->cart->total()?></strong></span>
								<div class="m-l-3 m-t-10">
									<a href="'.base_url('cart').'" style="font-size:13px; width: 48%; float: left; border-radius: 5px; text-align: center; color: #fff; text-transform: uppercase; padding: 11px 0;" class="btn3">view cart</a>
									<a href="'.base_url('checkout').'"  style="padding-right: auto; font-size:13px; width: 48%; float: left; border-radius: 5px; text-align: center; color: #fff; text-transform: uppercase; padding: 11px 0;" class="btn7">Check Out</a>
								</div>
							</div>
							</li>';
                        echo $output;
                    } else {
                        $output .= '<ul class="dropdown-menu aa-cartbox-summary" role="button">
							<li id="cart" style="height: 160px;align-items: center;">
								<div class="col-lg-12 m-t-40" align="center">
									<img style="width: 70px;" src="'.base_url('/assets/icons/tidakada.png').'">
									<br>
									<span class="fs-6 display-6">Belum Ada Pemesanan</span>
								</div>
							</li>';
                        echo $output;
                    } ?>
						</ul>
					</a>
				</li>
			</ul>
		</nav>
	</header>
    
	<!-- Header section end -->   
    <?= $this->renderSection('content') ;?>
	<!-- Footer section start -->
	<footer class="footer-section">
		<div class="footer-social">
			<div class="social-links">
				<a href="#"><i class="fa fa-pinterest"></i></a>
				<a href="#"><i class="fa fa-linkedin"></i></a>
				<a href="#"><i class="fa fa-instagram"></i></a>
				<a href="#"><i class="fa fa-facebook"></i></a>
				<a href="#"><i class="fa fa-twitter"></i></a>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-9 offset-lg-3">
					<div class="row">
						<div class="col-md-4">
							<div class="footer-item">
								<ul>
									<li><a href="<?= base_url()?>/">Home</a></li>
									<li><a href="<?= base_url()?>/package">Package</a></li>
									<li><a href="<?= base_url()?>/portofolio">Portofolio</a></li>
									<li><a href="<?= base_url()?>/about-us">Portfolio</a></li>
									<li><a href="<?= base_url()?>/contact">Contact</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-4">
							<div class="footer-item">
								<ul>
									<li><a href="#">Terms & Conditions</a></li>
									<li><a href="#">FAQ</a></li>
									<li><a href="#">Help Desk</a></li>
									<li><a href="#">Job Aplications</a></li>
									<li><a href="#">Site Map</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-4">
							<div class="footer-item">
								<ul>
									<li><a href="#">Privacy</a></li>
									<li><a href="#">Contact us</a></li>
									<li><a href="#">Newsletter</a></li>
									<li><a href="#">Clients Testimonials</a></li>
									<li><a href="#">FAQ</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		

		<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
     <div class="copyright">Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved.  <br>This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></div>
    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

	</footer>
	<!-- Footer section end -->
	<div class="modal fade" id="lupaPass" tabindex="-1" aria-labelledby="LabelLupa" aria-hidden="true">

	<div class="modal-dialog modal-dialog-centered">
		<div class="close-mo-video-01 trans-0-4" data-bs-dismiss="modal" aria-label="Close">&times;</div>

		<div class="wrap-model-lupa modal-content">
			
			<div class="modal-body">
				<div class="panel-body">
					<!-- <div class="w-full wrap-pic-w op-0-0"> -->
                <!-- <img src="assets/img/video-16-9.jpg" alt="IMG"> -->
            <!-- </div> -->
					<div class="text-center" style="padding: 40px!important">
						<img src="https://usa.afsglobal.org/SSO/SelfPasswordRecovery/images/send_reset_password.svg?v=3" style="width:25%;margin-bottom:5%;padding-top:5%" alt="" border="0">
						<h2 class="text-center" id="LabelLupa">Lupa Password?</h2>
						<p style="margin-bottom: 10px">You can reset your password here.</p>
						<form action="<?php echo base_url()?>lupa_password" class="form" method="post">
							<div id='valdas'></div>
							<div class="form-group bo3 mb-3">
								
								<div class="input-group">
									<input type="email" name="email" id="email" placeholder="Masukkan email Anda..." class="form-control bo1">
								</div>
							</div>
							<!-- <div class="form-group w-full"> -->
								<button class="btn btn-outline-dark" id="reset" style="width:100%!important" type="submit"><i class="fa fa-refresh"></i>&nbsp;Reset Password</button>
							<!-- </div> -->
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<!--====== Javascripts & Jquery ======-->
	<script src="<?= base_url()?>/assets/js/jquery-2.1.4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
	<script>
		$(document).ready(function() {
				var table = $('#table').DataTable({
			rowReorder:{
				selector: 'td:nth-child(2)'
			},
			responsive: true
			});	
		} );
	</script>
	<script>$(".alert-slide-up").delay(3000).slideUp('slow');</script>
		<script type="text/javascript">
		function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
			$('#blah')
				.attr('src', e.target.result)
				.width(150)
				.height(200);
			};

			reader.readAsDataURL(input.files[0]);
		}
		}
	</script>
	<script>
	jQuery(function($) {
	$('#totBayar').text($('#nominal').val());

	$('#nominal').on('input', function() {
		$('#totBayar').text($('#nominal').val());
	});
	});
	</script>
	<!-- <script src="assets/js/bootstrap.min.js"></script> -->
	<script src="<?= base_url()?>/assets/js/isotope.pkgd.min.js"></script>
	<script>
		var timeSince = function(date) {
			if (typeof date !== 'object') {
				date = new Date(date);
			}

			var seconds = Math.floor((new Date() - date) / 1000);
			var intervalType;

			var interval = Math.floor(seconds / 31536000);
			if (interval >= 1) {
				intervalType = 'tahun yang lalu';
			} else {
				interval = Math.floor(seconds / 2592000);
				if (interval >= 1) {
				intervalType = 'bulan yang lalu';
				} else {
				interval = Math.floor(seconds / 86400);
				if (interval >= 1) {
					intervalType = 'hari yang lalu';
				} else {
					interval = Math.floor(seconds / 3600);
					if (interval >= 1) {
					intervalType = "jam yang lalu";
					} else {
					interval = Math.floor(seconds / 60);
					if (interval >= 1) {
						intervalType = "menit yang lalu";
					} else {
						interval = seconds;
						intervalType = "detik yang lalu";
					}
					}
				}
				}
			}

			return interval + ' ' + intervalType;
			};
			
	</script>
	<script src="<?= base_url()?>/js/notifikasi.js"></script>
	<script type="text/javascript">
    $(document).ready(function () {
        window.setInterval(function () {
            notificationStream(
                id // id user yang sedang login
            );
        }, 1000);
    });
	</script>
	<script type="text/javascript">
		// Set the date we're counting down to
		var deadlinePembayaran = document.getElementById("deadlinePembayaran").value;
		var countDownDate = new Date(deadlinePembayaran).getTime();

		// Update the count down every 1 second
		var x = setInterval(function() {

		// Get today's date and time
		var now = new Date().getTime();
		
		// Find the distance between now and the count down date
		var distance =  countDownDate - now;
		var id_client = document.getElementById("idClient").value;
		var id_order = document.getElementById("idOrder").value;
		// Time calculations for days, hours, minutes and seconds
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			
		// Output the result in an element with id="demo"
		document.getElementById("countDown").innerHTML = hours + "j "
		+ minutes + "m " + seconds + "d ";
		console.log(distance);
		// If the count down is over, write some text 
		if (distance < 0) {
			clearInterval(x);
			document.getElementById("countDown").innerHTML = "Expired";
			document.getElementById("countDown").classList.toggle("glow"); 
			document.getElementById("countDown").classList.toggle("fw-bolder");
			
			//this is where you update the database:
			$.post( baseurl + "Api/UpdateStatusController", { 
				id_client: id_client,
				id_order: id_order
			})
          .done(function( data ) {
            console.log(data);
          }).fail(function( data ) {
            console.log(data);
          }); 
			}
		}, 1000);
	</script>
	<script src="<?= base_url()?>/assets/js/owl.carousel.min.js"></script>
	<script src="<?= base_url()?>/assets/js/jquery.owl-filter.js"></script>
	<script src="<?= base_url()?>/assets/js/magnific-popup.min.js"></script>
	<script src="<?= base_url()?>/assets/js/circle-progress.min.js"></script>
	<script type="text/javascript" src="http://admin.desainrumah.com/assets/vendor/lightbox2/js/lightbox.min.js"></script>
	<script src="<?= base_url()?>/assets/js/main.js"></script>
	<script src="<?php echo base_url()?>/assets/alert/js/sweetalert.min.js"></script>
	<script src="<?= base_url()?>/js/panggil_sweetalert.js"></script>
	<script>
    function goBack() {
      window.history.back()
    }
  	</script>
	
</body>
</html>