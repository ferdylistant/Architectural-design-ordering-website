<?= $this->extend('Template/template_client') ;?>
	<?= $this->section('content') ;?>
	<style>
		.dropdown-toggle::after {
            display: none !important;
        }
	</style>
	<!-- Page header section start -->
	<section class="page-header-section set-bg position-relative" data-setbg="<?= base_url()?>/assets/img/header-bg.jpg">
		<div class="container ">
			<h1 class="header-title">Detail Transaksi<span>.</span></h1>
			
		</div>
		<?php
        if (empty($client['pict_client'])) { ?>
			<img class="img-fluid rounded-circle position-absolute top-100 start-50 translate-middle border border-white border-5" src="<?= base_url()?>/assets/img/user.jpg" alt="" width="200px" height="100px">
		<?php } else { ?>
			<img class="img-fluid rounded-circle position-absolute top-100 start-50 translate-middle border border-white border-5" src="<?= base_url()?>/uploads/profile/<?= $client['pict_client']?>" alt="" width="200px" height="100px">
		<?php } ?>
	</section>
	<!-- Page header section end -->

	<!-- Intro section start -->
	<section class="intro-section pt100 pb50">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<figure class="text-center">
						<blockquote class="blockquote">
						
						<h2 class="mt-4 fs-3 fw-bold text-muted display-1 dropend">
						<?php echo session()->get('nama_client')?>&nbsp;
							<a href="#" class="dropdown-toggle fw-normal fs-5 text-dark" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								<span class="fa fa-ellipsis-v"></span>
								<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									<li><a class="dropdown-item" href="<?php echo base_url()?>/logout"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
								</ul>
							</a>
							
						
					</h2>
						</blockquote>
						<figcaption class="blockquote-footer">
							<?php echo session()->get('email_client')?> | <?php echo session()->get('telp_client')?> | <?php echo session()->get('alamat_client')?>
						</figcaption>
					</figure>
				</div>
				<div class="col-12 mt-4 mb-4">
					<ul class="nav nav-tabs bg-gradient justify-content-start">
                        <li class="">
                            <a href="javascript:void(0)" onclick="goBack()" class="nav-link link-secondary start-0"><span class="fa fa-arrow-left"></span>&nbsp;back</a></li>
						<li class="nav-item ">
							<a class="nav-link active link-secondary start-50 position-absolute translate-middle-x fw-bold"><img src="<?= base_url()?>/assets/icons/order.png" alt="" width="20px">&nbsp;Detail Transaksi</a>
						</li>
					</ul>
					<div class="card-body">
						<div class="row mt-3">
							<div class="col">
                                <div class="row">
                                    <div class="col-4">
                                    <h6 class="p-2 lead fs-4 fw-bolder">Pemesanan</h6>
                                    <div class="justify-content-between" style="overflow-x: hidden;overflow-y: auto;height:500px">
                                    <?php $no = 1;
                                    foreach ($detail as $rinci) { ?>
                                        <span class="start-0 position-relative lead fw-bolder" style="color: #495057"><?= '#'.$no++ ?></span>
                                    <ul class="list-group mb-3 " style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                                        
                                        <li class="list-group-item align-items-center w-100">
                                            <span class="fw-bolder text-muted">Kode Pemesanan</span> 
                                            <span class="fs-6 display-6 float-end">kd<?= ($rinci['id_order'])?>dsn</span>
                                            <input type="hidden" id="idClient" value="<?= $idClient ?>">
                                            <input type="hidden" id="idOrder" value="<?= $idOrder ?>">
                                        </li>
                                        <li class="list-group-item align-items-center w-100">
                                            <span class="fw-bolder text-muted">Produk</span> 
                                            <span class="fs-6 display-6 float-end"><?= ($rinci['nama_paket'])?></span>
                                        </li>
                                        <li class="list-group-item align-items-center w-100">
                                            <span class="fw-bolder text-muted">Tipe Bangunan</span> 
                                            <span class="fs-6 display-6 float-end"><?= ($rinci['tipe'])?></span>
                                        </li>
                                        <li class="list-group-item align-items-center w-100 h-100">
                                            <span class="fw-bolder text-muted">Ukuran Tanah</span> 
                                            <span class="fs-6 display-6 float-end"><?= ($rinci['ukuran_tanah'].$rinci['satuan'])?></span>
                                        </li>
                                        
                                        <li class="list-group-item ">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="w-100" style="margin-left:20%!important">
                                                        <span class="fw-bolder text-muted">Arsitektur</span> 
                                                        <span class="fs-6 display-6">&nbsp;&nbsp;&nbsp;<?= ($rinci['ket_arsitektur'])?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="w-100" style="margin-left:25%!important">
                                                        <span class="fw-bolder text-muted">Fasilitas</span> 
                                                        <span class="fs-6 display-6"><?= ($rinci['nama_fasilitas'])?></span>
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item align-items-center w-100">
                                            <span class="fw-bolder text-muted">Harga</span> 
                                            <span class="fs-6 display-6 float-end"><?= ($rinci['harga'])?></span>
                                        </li>
                                        <li class="list-group-item align-items-center w-100">
                                            <span class="fw-bolder text-muted">Jumlah Order</span> 
                                            <span class="fs-6 display-6 float-end"><?= ($rinci['jumlah_order'])?></span>
                                        </li>
                                        <li class="list-group-item align-items-center w-100">
                                            <span class="fw-bolder text-muted">Sub Harga</span> 
                                            <span class="fs-6 display-6 float-end"><?= ($rinci['sub_harga'])?></span>
                                        </li>
                                    </ul>
                                    <?php } ?>
                                    </div>
                                    
                                </div>
								<div class="col-8">
                                    <h6 class="p-2 lead fs-4 fw-bolder">Pembayaran</h6>
                                    <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                                        <div class="card-body">
                                        <?php
                                            if ($rinci['status_order']=='6') { ?>
                                            <div class="alert alert-danger" style="border-left: solid"><b><i class="fa  fa-exclamation-circle text-danger"></i> Penolakan:</b> 
                                                <span>Pemesanan anda kami batalkan, karena waktu pembayaran anda telah melewati batas yang ada pada sistem.</span>
                                                <button type="button" class="btn-close fs-6 position-absolute top-0 end-0" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            <?php } elseif ($rinci['status_order']=='0') { ?>
                                            <div class="alert alert-danger" style="border-left: solid"><b><i class="fa  fa-exclamation-circle text-danger"></i> Peringatan:</b> 
                                                <span>Silakan lakukan konfirmasi pembayaran pada portal website kami, lalu melakukan transaksi pembayaran melalui Bank Transfer yang tertera.</span>
                                                <button type="button" class="btn-close fs-6 position-absolute top-0 end-0" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            <?php } elseif ($rinci['status_order']=='3') { ?>
                                            <div class="alert alert-primary" style="border-left: solid"><b><i class="fa  fa-exclamation-circle text-primary"></i> Pemberitahuan:</b> 
                                                <span>Pesanan Anda sedang dalam pembuatan, silahkan ditunggu .</span>
                                                <button type="button" class="btn-close fs-6 position-absolute top-0 end-0" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            <?php } elseif ($rinci['status_order']=='1') { ?>
                                            <div class="alert alert-warning" style="border-left: solid"><b><i class="fa  fa-exclamation-circle text-warning"></i> Pemberitahuan:</b>
                                             Pembayaran DP anda telah terkonfirmasi, silahkan melakukan pelunasan sebelum batas pembayaran pelunasan berakhir.</span>
                                                <button type="button" class="btn-close fs-6 position-absolute top-0 end-0" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            <?php } elseif ($rinci['status_order']=='2') { ?>
                                            <div class="alert alert-success" style="border-left: solid"><b><i class="fa  fa-exclamation-circle text-success"></i></b> Pembayaran terkonfirmasi lunas.</span>
                                                <button type="button" class="btn-close fs-6 position-absolute top-0 end-0" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            <?php } elseif ($rinci['status_order']=='4') { ?>
                                            <div class="alert alert-secondary" style="border-left: solid"><b><i class="fa  fa-exclamation-circle text-secondary"></i></b> Terimakasih telah melakukan pemesanan di Kampung Jawa Resto. Kami berharap Anda senang dan kembali</span>
                                                <button type="button" class="btn-close fs-6 position-absolute top-0 end-0" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            <?php } elseif ($rinci['status_order']=='5') { ?>
                                            <div class="alert alert-danger" style="border-left: solid"><b><i class="fa  fa-exclamation-circle text-danger"></i></b> <?= $rinci['ket_tolak']?></span>
                                                <button type="button" class="btn-close fs-6 position-absolute top-0 end-0" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            <?php } ?>


                                            <div class="table-responsive">
                                                <table class="table" id="table" style="width:100%">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Identitas Rekening</th>
                                                            <th>Nominal Bayar</th>
                                                            <th>Rekening Tujuan</th>
                                                            <th class="text-center">Status</th>
                                                            <th>Tanggal Bayar</th>
                                                            <th>Tanggal Konfirmasi</th>
                                                            <th>Bukti Pembayaran</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if (empty($transaksi)) { ?>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="text-center w-100">
                                                                <img src="<?= base_url()?>/assets/icons/png/018-auction.png" alt="" width="90px">
                                                                <br>
                                                                <p class="lead fs-6 w-100">Belum ada pembayaran</p>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    <?php } else { ?>
                                                        <?php $no = 1;
                                                            foreach ($transaksi as $bayar) { ?>
                                                        <tr>
                                                            <td><?= $no++ ?></td>
                                                            <td><?= $bayar['bank']?><br><?= $bayar['atas_nama'] ?><br><?= $bayar['no_rek']?></td>
                                                            <td><?= rupiah($bayar['nominal'])?></td>
                                                            <td><img src="http://admin.desainrumah.com/uploads/rekening/<?= $bayar['gambar_rekening']?>" alt="" width="100px"><br><?= $bayar['nama_pemilik']." (".$bayar['nomor_rekening'].")"?></td>
                                                            
                                                            <td class="text-center"><?php if ($bayar['status_bayar'] == '1') { ?>
                                                                <span class="badge bg-warning bg-gradient text-dark rounded-pill float-end">down payment</span>
                                                                <?php } elseif ($bayar['status_bayar'] == '2') { ?>
                                                                    <span class="badge bg-success bg-gradient rounded-pill float-end">payment received</span>
                                                                <?php } ?>
                                                            </td>
                                                            <td><?= format_hari_tanggal($bayar['tgl_pembayaran'])?></td>
                                                            <td><?= format_hari_tanggal_jam($bayar['tgl_konfirmasi'])?></td>
                                                            <td class="text-center isotope-item">
                                                                <div class="item-gallery isotope-item">
                                                                    <div class="overlay-item-gallery trans-0-4 flex-c-m">
                                                                    <a class="btn-show-gallery" href="<?= base_url()?>/uploads/pembayaran/<?= $bayar['bukti'] ?>" data-lightbox="menu">
                                                                    <img src="<?= base_url()?>/uploads/pembayaran/<?= $bayar['bukti'] ?>" class="img-fluid img-thumbnail" width="100px">
                                                                    </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <?php if ($rinci['status_order'] == '2' || $rinci['status_order'] == '3' || $rinci['status_order'] == '4' || $rinci['status_order'] == '5' || $rinci['status_order'] == '6') { ?>
                                                <div class="d-grid gap-2 d-md-block">
                                                    <a class="btn btn-warning bg-gradient" href="<?php echo base_url('/profile?c='.base64_encode($rinci['id_client']).'&em='.base64_encode($rinci['email_client']))?>">Riwayat Transaksi</a>
                                                </div>
                                            <?php } elseif ($rinci['status_order'] == '0') { ?>
                                                <div class="d-grid gap-2 d-md-block">
                                                <a class="btn btn-warning bg-gradient" href="<?php echo base_url('/profile?c='.base64_encode($rinci['id_client']).'&em='.base64_encode($rinci['email_client']))?>">Riwayat Transaksi</a>
                                                <a class="btn btn-success bg-gradient" type="button" 
                                                href="<?= base_url('/package/payment_confirm?o='.base64_encode($rinci['id_order']).'&p='.sha1($rinci['id_paket']).'&c='.base64_encode($rinci['id_client']))?>">Konfirmasi Pembayaran</a>
                                                
                                            </div>
                                            <?php } elseif ($rinci['status_order'] == '1') { ?> 
                                                 <div class="d-grid gap-2 d-md-block">
                                                <a class="btn btn-warning bg-gradient" href="<?php echo base_url('/profile?c='.base64_encode($rinci['id_client']).'&em='.base64_encode($rinci['email_client']))?>">Riwayat Transaksi</a>
                                                <a class="btn btn-success bg-gradient" type="button" 
                                                href="<?= base_url('/package/payment_confirm?o='.$_GET['o'].'&p='.sha1($rinci['id_paket']).'&c='.$_GET['c'])?>">Pelunasan Pembayaran</a>
                                                
                                            </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                                </div>
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Intro section end -->
	
	<?= $this->endSection() ;?>
