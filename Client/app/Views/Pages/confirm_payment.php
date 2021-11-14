
<?= $this->extend('Template/template_client') ;?>
<?= $this->section('content') ;?>
<!-- Page header section start -->
	<section class="page-header-section set-bg" data-setbg="<?= base_url()?>/assets/img/header-bg.jpg">
		<div class="container">
			<h1 class="header-title">Payment Confirm<span>.</span></h1>
		</div>
	</section>
	<!-- Page header section end -->



	<!-- Intro section start -->
    
    <?php
    foreach ($order_detail as $rinci) {
    }
    date_default_timezone_set('Asia/Jakarta');
        //Estimasi Progress Desain
        $tgl_order = date($rinci['tgl_order']);
        $start_date = date($tgl_order);
        $estimate = strtotime('+6 days', strtotime($tgl_order));
        $estimasi=date('Y-m-d H:i:s', $estimate);?>
    
	<section class="intro-section spad">
		<div class="container mb-3">
			<div class="row">
                <div class="col">
                    <center class="pb-5">
                        <?php if ($rinci['status_order'] == '6') { ?>
                            <p class="pb-3">Pemesanan anda telah dibatalkan</p>
                        <?php } else { ?>
                            <p>Pembayaran berakhir pada:</p>
                        <?php } ?>
                        <p id="countDown" class="display-5"></p></center>
                    <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="mb-3">
                                                <img src="<?= base_url()?>/assets/icons/png/030-calculator.png" width="25px">&nbsp;Konfirmasi Pemesanan
                                            </h5>
                                            <ul class="list-group mb-3">
                                                <li class="list-group-item align-items-center w-100">
                                                    <span class="fw-bolder text-muted">Kode Pemesanan</span> 
                                                    <span class="fs-6 display-6 float-end">kd<?= ($rinci['id_order'])?>dsn</span>
                                                    <input type="hidden" id="idOrder" value="<?= $idOrder ?>">
                                                    <input type="hidden" id="idClient" value="<?= $idClient ?>">
                                                </li>
                                                <li class="list-group-item align-items-center w-100">
                                                    <span class="fw-bolder text-muted">Nama Pemesan</span> 
                                                    <span class="fs-6 display-6 float-end"><?= ($rinci['nama_client'])?></span>
                                                </li>
                                                <li class="list-group-item align-items-center w-100">
                                                    <span class="fw-bolder text-muted">Telepon Pemesan</span> 
                                                    <span class="fs-6 display-6 float-end"><?= ($rinci['telp_client'])?></span>
                                                </li>
                                                <li class="list-group-item align-items-center w-100">
                                                    <span class="fw-bolder text-muted">Tujuan Pengiriman</span> 
                                                    <span class="fs-6 display-6 float-end"><?= ($rinci['email_client'])?></span>
                                                </li>
                                                <li class="list-group-item align-items-center w-100">
                                                    <span class="fw-bolder text-muted">Tanggal Pemesanan</span> 
                                                    <span class="fs-6 display-6 float-end"><?= format_hari_tanggal_jam($rinci['tgl_order'])?></span>
                                                    <input type="hidden" id="tglPesan" value="<?= $rinci['tgl_order']?>">
                                                </li>
                                                <li class="list-group-item align-items-center w-100">
                                                    <span class="fw-bolder text-muted">Batas Pembayaran</span> 
                                                    <span class="fs-6 display-6 float-end"><?= format_hari_tanggal_jam($rinci['deadline_pembayaran'])?></span>
                                                    <input type="hidden" id="deadlinePembayaran" value="<?= $rinci['deadline_pembayaran']?>">
                                                </li>
                                                <li class="list-group-item align-items-center w-100">
                                                    <span class="fw-bolder text-muted">Estimasi Selesai</span> 
                                                    <span class="fs-6 display-6 float-end"><?= format_hari_tanggal($estimasi)?></span>
                                                </li>
                                                <li class="list-group-item align-items-center w-100">
                                                    <span class="fw-bolder text-muted">Total Pemesanan</span> 
                                                    <span class="fs-6 display-6 float-end"><?= rupiah($rinci['total_order'])?></span>
                                                </li>
                                                <li class="list-group-item align-items-center w-100">
                                                    <span class="fw-bolder text-muted">Status Pemesanan</span> 
                                                    
                                                        <?php
                                                        if ($rinci['status_order'] == 0) { ?>
                                                            <span class="badge bg-warning bg-gradient text-dark rounded-pill float-end">waiting payment</span>
                                                        <?php } elseif ($rinci['status_order'] == '1') { ?>
                                                            <span class="badge bg-info bg-gradient text-dark rounded-pill float-end">DP received</span>
                                                        <?php } elseif ($rinci['status_order'] == '2') { ?>
                                                            <span class="badge bg-success bg-gradient rounded-pill float-end">waiting payment</span>
                                                        <?php } elseif ($rinci['status_order'] == '3') { ?>
                                                            <span class="badge bg-primary bg-gradient rounded-pill float-end">in progress</span>
                                                        <?php } elseif ($rinci['status_order'] == '4') { ?>
                                                            <span class="badge bg-secondary bg-gradient rounded-pill float-end">completed</span>
                                                        <?php } elseif ($rinci['status_order'] == '5') { ?>
                                                            <span class="badge bg-danger bg-gradient rounded-pill float-end">rejected</span>
                                                        <?php } elseif ($rinci['status_order'] == '6') { ?>
                                                            <span class="badge bg-danger bg-gradient rounded-pill float-end">expired</span>
                                                        <?php } ?>
                                                </li>
                                            </ul>
                                            <div class="col-12">
                                                <ul class="list-group">
                                                    <li class="list-group-item" style="border-left: solid;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);text-align:justify">
                                                        <b class="text-danger fs-6 txt5"><i class="fa  fa-exclamation-circle"></i> Perhatian:</b>
                                                        <p class="fw-normal text-justify lh-sm">Terimakasih telah melakukan pemesanan di <?php echo $perusahaan['nama_perusahaan']?>. Untuk menyelesaikan proses pemesanan anda, silahkan tekan tombol <b>'Konfirmasi Pembayaran'</b> untuk melakukan pembayaran.
                                                        Metode Pembayaran melalui bank transfer:
                                                        </p>
                                                        <div class="col mb-3">
                                                            <img class="img-fluid mx-auto d-block" src="<?= base_url()?>/assets/img/va.png" alt="" width="250px">
                                                        </div>
                                                        <p class="fw-normal text-justify lh-sm"><strong> Waktu pembayaran anda berahir pada:&nbsp;<?php echo format_hari_tanggal_jam($rinci["deadline_pembayaran"]) ; ?>, jika tidak melakukan pembayaran maka pemesanan akan kami batalkan. </strong>
                                                        <a href="<?php echo base_url()?>syarat_dan_ketentuan" class="btn-link text-primary">Syarat & Ketentuan</a>
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="mb-3">
                                                <img src="<?= base_url()?>/assets/icons/png/013-tap.png" width="25px">&nbsp;Formulir Pembayaran
                                            </h5>
                                            <form class="row g-3" method="post" action="<?= base_url()?>/package/payment_action" enctype="multipart/form-data">
                                            <?php if (!empty(session()->getFlashdata('error'))) { ?>
                                            <div class="alert alert-danger alert-slide-up" role="alert">
                                                <?php echo session()->getFlashdata('error'); ?>
                                            </div>
                                            <?php } ?>
                                                <input type="hidden" name="id_order" value="<?= $_GET['o'] ?>">
                                                <input type="hidden" name="id_client" value="<?= $_GET['c'] ?>">
                                                <div class="col-md-6">
                                                    <label for="atas_nama" class="form-label">Atas Nama <span class="fs-6 display-1 text-muted">(<span class="text-danger">*</span>identitas bank Anda)</span></label>
                                                    <div class="pos-relative size12 bo2 bo-rad-10">
                                                        <input type="text" class="form-control bo-rad-10 sizefull fs-6 display-6 p-l-20" name="atas_nama" id="atas_nama" required>
                                                    </div>        
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="no_rek" class="form-label">Nomor Rekening</label>
                                                    <div class="pos-relative size12 bo2 bo-rad-10">
                                                        <input type="text" class="form-control bo-rad-10 sizefull fs-6 display-6 p-l-20" name="no_rek" id="no_rek" required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="bank" class="form-label">Dari Bank</label>
                                                    <div class="pos-relative size12 bo2 bo-rad-10">
                                                        <input type="text" class="form-control bo-rad-10 sizefull fs-6 display-6 p-l-20" name="bank" id="bank" placeholder="BRI/BNI/Mandiri/etc.." required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="rekening" class="form-label">Rekening Tujuan</label>
                                                    <div class="pos-relative size12 bo2 bo-rad-10">
                                                        <select class="form-control bo-rad-10 sizefull fs-6 display-6 p-l-20" name="id_rekening" id="rekening" aria-label="Default select example" required>
                                                            <option selected="selected" class="text-muted">Pilih Rekening Tujuan</option>
                                                            <?php foreach ($rekening as $rekening) { ?>
                                                                <option value="<?= $rekening['id_rekening'];?>"><?= $rekening['nama_bank']?>&nbsp;(<?php echo $rekening['nomor_rekening']?> A.N <?php echo $rekening['nama_pemilik']?>)
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="tgl_pembayaran" class="form-label">Tanggal Pembayaran</label>
                                                    <div class="pos-relative size12 bo2 bo-rad-10">
                                                        <input class="form-control bo-rad-10 sizefull fs-6 display-6 text-muted p-l-20" type="date" name="tgl_pembayaran" id="tgl_pembayaran" required>
                                                    <i class="btn-calendar fa fa-calendar ab-r-m  m-r-18" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="nominal" class="form-label">Nominal Pembayaran</label>
                                                    <div class="wrap-inputtime pos-relative size12 bo2 bo-rad-10">
                                                    
                                                        <?php if (!empty($transaksi)) { ?>
                                                            <?php foreach ($transaksi as $bayar) { }
                                                            $yangharusdibayar = $rinci['total_order'] - $bayar['nominal'];
                                                            ?>
                                                            <input class="form-control bo-rad-10 sizefull fs-6 display-6 p-l-20" type="number" name="nominal" min="<?= $yangharusdibayar ?>" id="nominal" placeholder="Nominal Pembayaran" value="<?= $yangharusdibayar?>" required>
                                                        <?php }
                                                        else { ?>
                                                            <input class="form-control bo-rad-10 sizefull fs-6 display-6 p-l-20" type="number" name="nominal" min="<?= $rinci['total_order'] * 0.7 ?>" id="nominal" placeholder="Nominal Pembayaran" value="<?= $rinci['total_order'] * 0.7 ?>" required>
                                                        <?php } ?>

                                                        
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="bukti" class="form-label">Bukti Pembayaran</label>
                                                    <div class="pos-relative bo2 bo-rad-10">
                                                        <input class="form-control form-control-lg bo-rad-10 sizefull fs-6 display-6 " type="file" onchange="readURL(this);" name="bukti" id="bukti" required   >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <img id="blah" src="" class="img-fluid rounded float-start" style="width: 100%">
                                                </div>
                                                <div class="col-12">
                                                <p class="lead fs-6"><span class="text-danger">*</span>Periksa kembali sebelum melakukan konfirmasi pembayaran</p>
                                                    <ul class="list-group">
                                                        <li class="list-group-item align-items-center w-100 lead fs-6"><img src="<?= base_url()?>/assets/icons/check.png" class="img-fluid" width="15px">&nbsp;Total Pemesanan<span class="fs-4 display-5 float-end"><?= rupiah($rinci['total_order'])?></span></li>
                                                        <?php if (!empty($transaksi)) { ?>
                                                            
                                                        <li class="list-group-item align-items-center w-100 lead fs-6"><img src="<?= base_url()?>/assets/icons/check.png" class="img-fluid" width="15px">&nbsp;Sudah Dibayar<span class="fs-4 display-5 float-end text-muted">-<?= rupiah($bayar['nominal'])?></span></li>
                                                        <li class="list-group-item align-items-center w-100 lead fs-6"><img src="<?= base_url()?>/assets/icons/check.png" class="img-fluid" width="15px">&nbsp;Yang Harus Dibayar<span class="fs-4 display-5 float-end"><?= rupiah($yangharusdibayar)?></span></li>
                                                       <?php } ?>
                                                        <li class="list-group-item align-items-center w-100 lead fs-6"><img src="<?= base_url()?>/assets/icons/dollars.png" class="img-fluid" width="15px">&nbsp;Total Bayar<span class="fs-4 display-5 float-end">Rp.<span id="totBayar"><?= number_format(0)?></span></span></li>

                                                        <li class="list-group-item">
                                                            <a class="btn btn-warning bg-gradient" href="<?php echo base_url('/profile?c='.base64_encode($idClient).'&em='.base64_encode($rinci['email_client']))?>">Lihat Riwayat Transaksi</a>
                                                            <button class="btn btn-success bg-gradient" type="submit" style="float: right">Konfirmasi Pembayaran</button></li>
                                                    </ul>       
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
	</section>
    
	<!-- Intro section end -->

<?= $this->endSection() ;?>
