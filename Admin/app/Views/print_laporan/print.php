<html>
<head>
	<title>Cetak PDF</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?= base_url()?>/assets/admin/images/auth/Administrator.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/table/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/table/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/table/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/table/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/table/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/table/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/table/css/main.css">
</head>
<body>
	<?php foreach ($tentang as $value) {} ?>
			<div class="row" style="margin-top: 30px">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-md-3 text-center">
							<img style="width: 32%" src="<?php echo base_url()?>/assets/logo.png">
						</div>
						<div class="col-md-8 text-right">
							<h6 class="text-muted"><span style="border-bottom:2px solid #FF6600">Laporan Transaksi</span></h6>
							
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<h3 class="text-center"><?php echo $value['nama_perusahaan']?></h3>
							<p class="text-center text-muted"><?php echo $value['alamat_perusahaan']?></p>
							<p class="text-center" style="color: #119c98;text-decoration: underline;"><?php echo $value['email_perusahaan']?></p>
						</div>
					</div>
				</div>
			</div>
			<hr>

		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="text-center"><b><u><?php echo $ket; ?></u></b></div>
					<br /><br />
						<div class="row">
								<div class="wrap-table100 p-r-0">
									<div class="table100 ver5 m-b-110">
										<div class="table100-head">
											<center>
												<table>
												<thead>
													<tr class="row100 head">
														<th class="cell100" style="width: 10%;padding-left:40px">Kode Pemesanan</th>
														<th class="cell100" style="width: 20%;padding-left:40px">Nama</th>
														<th class="cell100" style="width: 20%;padding-left:40px">Telepon</th>
														<th class="cell100" style="width: 20%;padding-left:40px">Email</th>
														<th class="cell100" style="width: 30%;padding-left:40px">Alamat</th>
														<th class="cell100" style="width: 25%;padding-right:50px">Tanggal Pemesanan</th>
														<th class="cell100" style="width: 30%;padding-right:40px">Total Pemesanan</th>
													</tr>
												</thead>
											</table>
											</center>
											
										</div>
										<div class="table100-body js-pscroll">
											<table>
												<tbody>
													<?php
													if( ! empty($transaksi)){
														$no = 1;
														$total = 0;
														foreach($transaksi as $data){
															$tgl_order_masuk = date('d-m-Y', strtotime($data->tgl_order)); ?>
															<tr class="row100 body">
																<td class="cell100" style="width: 10%;padding-left:40px">kd<?php echo $data->id_order ?>dsn</td>
																<td class="cell100" style="width: 20%;padding-left:40px"><?php echo $data->nama_client ?></td>
																<td class="cell100" style="width: 20%;padding-left:30px"><?php echo $data->telp_client ?></td>
																<td class="cell100 column2"><?php echo $data->email_client ?></td>
																<td class="cell100" style="width: 20%;padding-left:40px"><?php echo $data->alamat_client ?></td>
																<td class="cell100" style="width: 40%;padding-left:30px"><?php echo format_hari_tanggal_jam($data->tgl_order)?></td>
																<td class="cell100" style="width: 20%;padding-right:10px"><?php echo rupiah($data->total_order) ?></td>
															</tr>
															<?php $no++; $total += $data->total_order; ?>
														<?php } ?>
													<?php } ?>
												</tbody>
												<tfoot>

													<tr class="row100 foot">
														<td colspan="6" class="cell100 column1"><strong><h3>Total Pemesanan Client </h3></strong></td>
														<td class="cell100 p-r-10"><strong><h3 style="word-wrap:break-word;"><?php echo rupiah($total)?></h3></strong></td>
													</tr>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
							
							
						</div>
					</div>
						
				</div>
			</div>
		
	
	<!--===============================================================================================-->	
	<script src="<?= base_url()?>/table/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
		<script src="<?= base_url()?>/table/vendor/bootstrap/js/popper.js"></script>
		<script src="<?= base_url()?>/table/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
		<script src="<?= base_url()?>/table/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
		<script src="<?= base_url()?>/table/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script>
			$('.js-pscroll').each(function(){
				var ps = new PerfectScrollbar(this);

				$(window).on('resize', function(){
					ps.update();
				})
			});
				
			
		</script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>/table/js/main.js"></script>
	<script>
		window.load=print_d();
		function print_d(){
			window.print();
		}
	</script>
</body>

</html>