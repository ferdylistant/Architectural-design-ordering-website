	<?= $this->extend('Template/template_client') ;?>
	<?= $this->section('content') ;?>
	<style>
		.dropdown-toggle::after {
            display: none !important;
        }
	</style>
	<!-- Page header section start -->
	<section class="page-header-section set-bg position-relative" data-setbg="assets/img/header-bg.jpg">
		<div class="container ">
			<h1 class="header-title">Profile<span>.</span></h1>
			
		</div>
		<div class="isotope-item">
			<?php
        if (empty($client['pict_client'])) { ?>
			<a class="btn-show-gallery" href="<?= base_url()?>/assets/img/user.jpg" data-lightbox="menu">
				<img class="img-fluid rounded-circle position-absolute top-100 start-50 translate-middle border border-white border-5" src="<?= base_url()?>/assets/img/user.jpg" alt="" width="200px" height="100px">
			</a>
			
		<?php } else { ?>
			<a class="btn-show-gallery" href="<?= base_url()?>/uploads/profile/<?php echo $client['pict_client'] ?>" data-lightbox="menu">
				<img class="img-fluid rounded-circle position-absolute top-100 start-50 translate-middle border border-white border-5" src="<?= base_url()?>/uploads/profile/<?= $client['pict_client']?>" alt="" width="200px" style="height:200px">
			</a>
			
		<?php } ?>
		</div>
		
	</section>
	<!-- Page header section end -->
	<!-- Intro section start -->
	<section class="intro-section pt100 pb50">
		<div class="container">
		<?php if (session()->getFlashdata('success') != null) { ?>
		<div class="alert alert-success fixed-top alert-slide-up">
			<span><?php echo session()->getFlashdata('success'); ?></span>
		</div>
		<?php }
		elseif (session()->getFlashdata('error') != null) { ?>
		<div class="alert alert-danger alert-slide-up fixed-top">
			<span><?php echo session()->getFlashdata('error'); ?></span>
		</div>
		<?php } ?>
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
							<?= $client['email_client']?> | <?= $client['telp_client']?> | <?= $client['alamat_client']?>
						</figcaption>
					</figure>
				</div>
				<div class="col-12 mt-4 mb-4" id="notif_container">
					<ul class="nav nav-tabs bg-gradient d-flex justify-content-center" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link active link-secondary" id="riwayat-tab" data-bs-toggle="tab" href="#riwayatT" role="tab" aria-controls="riwayatT" aria-selected="true">Riwayat Transaksi</a>
						</li>
						<li class="nav-item" role="presentation"> 
							<a class="nav-link link-secondary btnnotif" id="notifikasi-tab" data-bs-toggle="tab" href="#notifikasi" role="tab" aria-controls="profile" aria-selected="false">Notifikasi
								<?php if (!empty($riwayat)) { ?>
									<span class="count badge bg-danger border border-light rounded-circle font-monospace">
								
								</span>
								<?php } ?>
								
							</a>
						</li>
						<li class="nav-item" role="presentation">
						<a class="nav-link link-secondary" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
						</li>
					</ul>
					<div class=" card-body">
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="riwayatT" role="tabpanel" aria-labelledby="riwayat-tab">
								<?php if (empty($riwayat)) { ?>
								<center>
									<img src="<?= base_url()?>/assets/icons/tidakada.png" class="img-fluid" alt="">
									<br>
									<p class="lead">Belum ada riwayat pemesanan<br><a href="<?= base_url()?>/package" class="btn btn-warning">Belanja yuk!</a></p>
								</center>
								<?php } else { ?>
								<div class="table-responsive">
									<table class="table">
										<thead class="table-light">
											<tr>
												<th class="text-center">No</th>
												<th class="text-center">Tanggal Pesan</th>
												<th class="text-center">Batas Pembayaran</th>
												<th class="text-center">Email Pengiriman</th>
												<th class="text-center">Total Pesan</th>
												<th class="text-center">Status</th>
												<th class="text-center">Penolakan</th>
												<th class="text-center">Detail</th>
											</tr>
										</thead>
										<tbody>
											<?php
                                            $no=1;
                                            foreach ($riwayat as $transaksi) { ?>
											<tr>
												<td class="text-center"><?= $no++ ?></td>
												<td class="text-center"><?= format_hari_tanggal_jam($transaksi['tgl_order']) ?></td>
												<td class="text-center">
													<?php if ($transaksi['status_order'] == '2' || $transaksi['status_order'] == '3' || $transaksi['status_order'] == '4') { ?>
														<img src="<?= base_url()?>/assets/icons/done.png" class="img-fluid" alt="" width="40px">
													<?php } elseif ($transaksi['status_order'] == '5' || $transaksi['status_order'] == '6') { ?>
														<?= $transaksi['deadline_pembayaran'] ?>
													<?php } else { ?>
														<?= format_hari_tanggal_jam($transaksi['deadline_pembayaran']) ?>
													<?php } ?>
												</td>
												<td class="text-center"><?= $transaksi['email_client'] ?></td>
												<td class="text-center"><?= rupiah($transaksi['total_order']) ?></td>
												<td class="text-center">
												<?php
                                                        if ($transaksi['status_order'] == 0) { ?>
                                                            <span class="badge bg-warning bg-gradient text-dark rounded-pill float-end">waiting payment</span>
                                                        <?php } elseif ($transaksi['status_order'] == '1') { ?>
                                                            <span class="badge bg-info bg-gradient text-dark rounded-pill float-end">DP received</span>
                                                        <?php } elseif ($transaksi['status_order'] == '2') { ?>
                                                            <span class="badge bg-success bg-gradient rounded-pill float-end">payment received</span>
                                                        <?php } elseif ($transaksi['status_order'] == '3') { ?>
                                                            <span class="badge bg-primary bg-gradient rounded-pill float-end">in progress</span>
                                                        <?php } elseif ($transaksi['status_order'] == '4') { ?>
                                                            <span class="badge bg-secondary bg-gradient text-dark rounded-pill float-end">completed</span>
                                                        <?php } elseif ($transaksi['status_order'] == '5') { ?>
                                                            <span class="badge bg-danger bg-gradient rounded-pill float-end">rejected</span>
                                                        <?php } elseif ($transaksi['status_order'] == '6') { ?>
                                                            <span class="badge bg-danger bg-gradient rounded-pill float-end">expired</span>
                                                        <?php } ?>
												</td>
												<td class="text-center">
												<?php
                                                    if (!empty($transaksi['ket_tolak'])) { ?>
														<?= $transaksi['ket_tolak'] ?>
													<?php } else { ?>
														<img src="<?= base_url()?>/assets/icons/empty-set.png" alt="" class="img-fluid" width="40px">
													<?php } ?>
												</td>
												<td class="text-center"><a href="<?= base_url('/profile/riwayat/detail?o='.base64_encode($transaksi['id_order']).'&c='.base64_encode($transaksi['id_client']))?>" class="link-secondary"><i class="fa fa-eye"></i></a></td>
											</tr>
											<?php } ?>
											
										</tbody>
									</table>
								</div>
								<?php } ?>
								
							</div>

							<div class="tab-pane fade overflow-auto" id="notifikasi" role="tabpanel" aria-labelledby="notifikasi-tab" style="height:400px">
								<?php if (empty($riwayat)) { ?>
								<center>
									<img src="<?= base_url()?>/assets/icons/tidakada.png" class="img-fluid" alt="">
									<br>
									<p class="lead">Belum ada notifikasi pemesanan<br><a href="<?= base_url()?>/package" class="btn btn-warning">Belanja yuk!</a></p>
								</center>
								<?php }  ?>
							</div>
							<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								<div class="col">
									<div class="card">
										<div class="card-body" style="padding-bottom:100px!important;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
											<div class="row">
												<div class="col-lg-3">
													<div class="list-group list-group-flush mt-5" id="list-tab" role="tablist">
														<a class="list-group-item list-group-item-action list-group-item-light active rounded" id="list-data-diri" data-bs-toggle="list" href="#list-datadiri" role="tab" aria-controls="list-datadiri"><img src="<?= base_url()?>/assets/icons/user-profile.png" alt="" width="30px">&nbsp;&nbsp;Data Diri</a>
														<a class="list-group-item list-group-item-action list-group-item-light rounded" id="list-ubah-pass" data-bs-toggle="list" href="#list-ubahpass" role="tab" aria-controls="list-ubahpass"><img src="<?= base_url()?>/assets/icons/secure.png" alt="" width="30px">&nbsp;&nbsp;Ubah Password</a>
														<a class="list-group-item list-group-item-action list-group-item-light rounded" id="keluar" href="<?php echo base_url()?>/logout"><img src="<?= base_url()?>/assets/icons/arrow.png" alt="" width="30px">&nbsp;&nbsp;Logout</a>
													</div>
												</div>
												<div class="col-lg-9">
													<div class="tab-content" id="nav-tabContent">
														<div class="tab-pane fade show active mt-5" id="list-datadiri" role="tabpanel" aria-labelledby="list-data-diri">
															<h3 class="display-6 fs-4 fw-bold" style="border-bottom:2px solid">Data Diri</h3>
															<form class="row g-3" method="post" action="<?= base_url()?>/profile/update" enctype="multipart/form-data">
																<input type="hidden" name="id_client" value="<?= $_GET['c']?>">
																<input type="hidden" name="email_client" value="<?= $_GET['em']?>">
																<div class="col-md-6">
																	<div class="form-floating">	
																		<input type="text" name="nama_client" class="form-control" id="nama_client" value="<?= ($client['nama_client'])?>">
																		<label for="nama_client" class="form-label">Nama</label>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-floating">
																		<input type="email" class="form-control" id="email_client" value="<?= $client['email_client']?>" disabled readonly>
																		<label for="email_client" class="form-label">Email</label>
																	</div>																		
																</div>
																<div class="col-12">
																	<div class="form-floating">
																		<input type="text" name="telp_client" class="form-control" id="telp_client" value="<?= $client['telp_client']?>">
																		<label for="telp_client" class="form-label">Telepon</label>
																	</div>
																</div>
																<div class="col-12">
																	<div class="form-floating">
																		<input type="text" name="alamat_client" class="form-control" id="alamat_client" value="<?= $client['alamat_client']?>">
																		<label for="alamat_client" class="form-label">Alamat</label>
																	</div>
																</div>
																<div class="col-12">
																	<div class="form-floating">
																		<input type="file" onchange="readURL(this);" class="form-control"  name="userfile">
																		<label for="inputCity" class="form-label">Foto Profil</label>
																	</div>
																</div>
																<div class="col-md-6">
                  													<img id="blah" src="<?= base_url()?>/uploads/profile/<?= $client['pict_client']?>" alt="" class="rounded" style="width: 220px">
																</div>
																<?php if (!empty($client['pict_client'])) { ?>
																	<input type="hidden"  name="pict_client" value="<?= $client['pict_client']?>">
																<?php } ?>
																<div class="col-12">
																	<button type="submit" class="btn btn-primary">Update</button>
																</div>
															</form>
														</div>
														<div class="tab-pane fade mt-5" id="list-ubahpass" role="tabpanel" aria-labelledby="list-ubbah-pass">
															<h3 class="display-6 fs-4 fw-bold" style="border-bottom:2px solid">Ubah Password</h3>	
															<form class="row g-3" method="post" action="<?= base_url()?>/profile/change-password">
																<input type="hidden" name="id_client" value="<?= $_GET['c']?>">
																<input type="hidden" name="email_client" value="<?= $_GET['em']?>">
																<div class="col-12">
																	<div class="form-floating">
																		<input type="password" name="current_password" class="form-control" id="floatingCurrent" placeholder="*************" required>
																		<label for="floatingCurrent">Password saat ini</label>
																	</div>
																</div>
																<div class="col-12">
																	<div class="form-floating">
																		<input type="password" name="new_password" class="form-control" id="floatingNewPassword" placeholder="*************" required>
																		<label for="floatingNewPassword">Password baru</label>
																	</div>
																</div>
																<div class="col-12">
																	<div class="form-floating">
																		<input type="password" name="confirm_password" class="form-control" id="floatingConfirmPassword" placeholder="*************" aria-describedby="passwordHelpBlock" required>
																		<label for="floatingConfirmPassword">Konfirmasi password baru</label>
																	</div>
																	<div id="passwordHelpBlock" class="form-text">
																	<span class="text-danger">*</span> Your password must be 4-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
																	</div>
																</div>
																<div class="col-12">
																	<button type="submit" class="btn btn-primary">Update</button>
																</div>
															</form>
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
				</div>
			</div>
		</div>
	</section>
	<!-- Intro section end -->
	
	<?= $this->endSection() ;?>
