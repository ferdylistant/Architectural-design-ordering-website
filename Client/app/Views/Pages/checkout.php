
<?= $this->extend('Template/template_client') ;?>
<?= $this->section('content') ;?>
<!-- Page header section start -->
	<section class="page-header-section set-bg" data-setbg="<?= base_url()?>/assets/img/header-bg.jpg">
		<div class="container">
			<h1 class="header-title">Checkout<span>.</span></h1>
		</div>
	</section>
	<!-- Page header section end -->



	<!-- Intro section start -->
    
	<section class="intro-section spad">
		<div class="container mb-3">
			<div class="row">
				<div class="col-lg-12">
                    <div class="card" style="border-left: 5px solid;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                        <div class="card-body">
                            <h5><img src="<?= base_url()?>/assets/icons/png/043-email.png" width="25px">&nbsp;Identitas Pemesanan</h5>
                                <!-- tampilkan pesan success -->
                                <?php if (session()->getFlashdata('success') != null) { ?>
                                <div class="alert alert-success alert-slide-up">
                                    <?php echo session()->getFlashdata('success'); ?>
                                </div>
                                <?php } ?>
                                <!-- selesai menampilkan pesan success -->
                                
                                <div class="table-responsive">
                                    <table class="table" style="border-bottom: 5px dashed #F18D9B">
                                        <tr>
                                            <td class="text-start"><span class="fs-5 display-6 fst-normal text-muted"><i class="fa fa-user"></i>&nbsp;<?= session()->get('nama_client'); ?></span></td>
                                            
                                            <td class="text-center"><span class="fs-5 display-6 fst-normal text-muted"><i class="fa fa-envelope-o"></i>&nbsp;<?= session()->get('email_client'); ?></span><br>(<span class="text-danger">*</span>&nbsp;Paket desain akan dikirimkan ke alamat email)</td class="text-center">
                                            <td class="text-start"><span class="fs-5 display-6 fst-normal text-muted"><i class="fa fa-phone"></i>&nbsp;<?= session()->get('telp_client'); ?></span></td>
                                            <td class="text-start"><span class="fs-5 display-6 fst-normal text-muted"><i class="fa fa-map-marker"></i>&nbsp;<?= session()->get('alamat_client'); ?></span></td>
                                        </tr>
                                    </table>
                                
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
		<div class="container mb-3">
			<div class="row">
				<div class="col-lg-12">
                    <div class="card" style="border-left: 5px solid;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                        <div class="card-body">
                            <h5><img src="<?= base_url()?>/assets/icons/png/010-paymentmethod.png" width="25px">&nbsp;Metode Pembayaran</h5>
                                <!-- tampilkan pesan success -->
                                <?php if (session()->getFlashdata('success') != null) { ?>
                                <div class="alert alert-success alert-slide-up">
                                    <?php echo session()->getFlashdata('success'); ?>
                                </div>
                                <?php } ?>
                                <!-- selesai menampilkan pesan success -->
                                
                                <div class="table-responsive">
                                    <table class="table" style="border-bottom: 5px dashed #F18D9B">
                                        <tr>
                                            <?php foreach ($rekening as $rek) { ?>
                                            <td class="text-center">
                                                <img src="http://admin.desainrumah.com/uploads/rekening/<?= $rek['gambar_rekening']?>" alt="error" width="100px" height="35px"><br>
                                               
                                                <span class="fs-5 display-6 text-muted"><?= $rek['nama_pemilik']?><br><?= $rek['nomor_rekening'];?></span>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                    </table>
                                
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
                    <div class="card" style="border-left: 5px solid;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                        <div class="card-body">
                            <h5><img src="<?= base_url()?>/assets/icons/png/019-shopping basket.png" width="25px">&nbsp;Paket Dipesan</h5>
                                <!-- tampilkan pesan success -->
                                <?php if (session()->getFlashdata('success') != null) { ?>
                                <div class="alert alert-success alert-slide-up">
                                    <?php echo session()->getFlashdata('success'); ?>
                                </div>
                                <?php } ?>
                                <!-- selesai menampilkan pesan success -->
                                <?php if (count($items) != 0) { // cek apakan keranjang belanja lebih dari 0, jika iya maka tampilkan list dalam bentuk table di bawah ini:?>
                                <div class="table-responsive">
                                <form action="<?= base_url()?>/package/confirm" method="post">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Kuantitas</th>
                                                <th class="text-center">Tipe</th>
                                                <th class="text-center">Ukuran Tanah</th>
                                                <th class="text-start">Fasilitas</th>
                                                <th class="text-start">Arsitektur</th>
                                                <th class="text-center">Harga</th>
                                                <th class="text-center">Sub Total</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $krj = $items;
                                            foreach ($krj as $item) { ?>
                                            <?php $id = $item['id'];
                                            $this->paket = new \App\Models\PaketProdukModel();
                                            $detail = $this->paket->getPaketIdCart($id);
                                            foreach ($detail as $rinci) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $no; ?></td>
                                                <td class="text-center"><?php echo $item['name']; ?></td>
                                                
                                                <td class="text-center">
                                                    <?php echo $item['qty']; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $rinci['tipe']; ?>
                                                </td>
                                                <td class="text-center" style="min-width:150px">
                                                    <?php echo $rinci['ukuran_tanah'].$rinci['satuan']; ?>
                                                </td>
                                                <td class="text-start" style="min-width:150px">
                                                    <?php echo $rinci['nama_fasilitas']; ?>
                                                </td>
                                                <td class="text-start" style="min-width:150px"><?php echo $rinci['ket_arsitektur']; ?></td>
                                                <td class="text-center"><?php echo rupiah($item['price']); ?></td>
                                                <td class="text-center"><?php echo rupiah($item['subtotal']); ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        
                                                        <a href="<?php echo base_url('package/remove/'.($item['rowid'])); ?>" class="btn btn-outline-danger hapus-cart-item"><i class="fa fa-times"></i>&nbsp;Cancel</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $no++; } } ?>
                                            <tr style="border-top: 5px dashed #F18D9B">
                                                <td colspan="9" class="fw-bolder fs-5 display-6 text-muted"><img src="<?= base_url()?>/assets/icons/check.png" width="20px">&nbsp;Total Pemesanan:</td>
                                                <td class="fw-bolder fs-4 display-6 text-muted w-100"><?php echo rupiah($total); ?></td>
                                                <input type="hidden" name="total_order" value="<?= $total ?>">
                                            </tr>
                                            <tr style="border-top: 5px dashed #F18D9B">
                                                <td colspan="9"></td>
                                                <td class="text-start"><button type="submit" class="btn btn-success">Buat Pesanan</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                                </div>
                                <?php } // selesai menampilkan list cart dalam bentuk table?>
            
                                
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</section>
    
	<!-- Intro section end -->

<?= $this->endSection() ;?>
