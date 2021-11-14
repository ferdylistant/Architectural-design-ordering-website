
<?= $this->extend('Template/template_client') ;?>
<?= $this->section('content') ;?>
<!-- Page header section start -->
	<section class="page-header-section set-bg" data-setbg="<?= base_url()?>/assets/img/header-bg.jpg">
		<div class="container">
			<h1 class="header-title">Keranjang<span>.</span></h1>
		</div>
	</section>
	<!-- Page header section end -->



	<!-- Intro section start -->
	<section class="intro-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
                    <div class="card" style="border-left: 5px solid;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                            <div class="card-body">
                                <!-- tampilkan pesan success -->
                                <?php if (session()->getFlashdata('success') != null) { ?>
                                <div class="alert alert-success alert-slide-up">
                                    <?php echo session()->getFlashdata('success'); ?>
                                </div>
                                <?php } ?>
                                <!-- selesai menampilkan pesan success -->
                                <?php if (count($items) != 0) { // cek apakan keranjang belanja lebih dari 0, jika iya maka tampilkan list dalam bentuk table di bawah ini:?>
                                <div class="table-responsive">
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
                                                
                                                <td class="text-center"><?php echo $item['qty']; ?></td>
                                                <td class="text-center"><?php echo $rinci['tipe']; ?></td>
                                                <td class="text-center"><?php echo $rinci['ukuran_tanah'].$rinci['satuan']; ?></td>
                                                <td class="text-start"><?php echo $rinci['nama_fasilitas']; ?></td>
                                                <td class="text-start"><?php echo $rinci['ket_arsitektur']; ?></td>
                                                <td class="text-center"><?php echo rupiah($item['price']); ?></td>
                                                <td class="text-center"><?php echo rupiah($item['subtotal']); ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        
                                                        <a href="<?php echo base_url('package/remove/'.($item['rowid'])); ?>" class="btn btn-outline-danger hapus-cart-item"><i class="fa fa-times"></i>&nbsp;Cancel</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $no++; } } ?>
                                            <tr>
                                                <td colspan="9" class="text-right fw-bolder fs-4 display-6">Jumlah</td>
                                                <td class="text-center fw-bolder fs-4 display-6"><?php echo rupiah($total); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                
                                </div>
                                <?php } // selesai menampilkan list cart dalam bentuk table?>
            
                                <?php if (count($items) == 0) { // jika cart kosong, maka tampilkan:?>
                                    <div class="row">
                                        <div class="col text-center">
                                        <img style="width: 100px;" src="<?= base_url()?>/assets/icons/tidakada.png"><br>
                                        <p class="fs-3 display-6">Keranjang belanja Anda sedang kosong...</p> 
                                        <a href="<?php echo base_url('/package'); ?>" class="btn btn-warning">
                                        <i class="fa fa-th-list"></i>&nbsp;Belanja Yuk</a>
                                        </div>
                                    </div>
                                    
                                <?php } else { // jika cart tidak kosong, tampilkan:?>
                                    <div class="row g-5">
                                        <div class="col-sm-6 col-md-8">
                                            <a href="<?php echo base_url('/package/destroy'); ?>" class="kosongkan-keranjang btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Kosongkan Keranjang</a>
                                            <a href="<?php echo base_url('/package'); ?>" class="btn btn-warning"><i class="fa fa-th-list"></i>&nbsp;Lanjut Belanja</a>
                                        </div>
                                        <div class="col-6 col-md-4 text-end">
                                            <a href="<?php echo base_url('/package/checkout'); ?>" class="btn btn-success"><i class="fa fa-shopping-cart"></i>&nbsp;Checkout</a>
                                        </div>
                                    </div>
                                    
                                    
                                <?php } ?>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</section>
	<!-- Intro section end -->

<?= $this->endSection() ;?>
