<?= $this->extend('Template/template_admin') ;?>
<?= $this->section('content') ;?>
<div class="row purchace-popup">
	<div class="col-12">
	<?php if (!empty(session()->getFlashdata('error'))) { ?>
		<div class="alert alert-danger alert-slide-up" style="border-left: 5px solid" role="alert">
		<i class="fa  fa-exclamation-circle"></i>
			<?php echo session()->getFlashdata('error'); ?>
		</div>
	<?php } elseif (!empty(session()->getFlashdata('success'))) { ?>
		<div class="alert alert-success alert-slide-up" style="border-left: 5px solid" role="alert">
		<i class="fa  fa-exclamation-circle"></i>
			<?php echo session()->getFlashdata('success'); ?>
		</div>
	<?php } ?>
		<span class="d-block d-md-flex align-items-center text-center" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
			<ul class="breadcrumb py-0">
				<li>
					<a href="<?php echo base_url();?>/" class="mt-2 text-dark" ><i class="mdi mdi-home"></i> Home</a>
					<i class="mdi mdi-arrow-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>/payment" class="mt-2 text-dark"><i class="menu-icon fa fa-money"></i> Semua Pembayaran</a>
					<i class="mdi mdi-arrow-right"></i>
				</li>
				<li>
					<span class="mt-2 text-dark text-muted"> Detail Pembayaran</span>
					
				</li>
			</ul>
		</span>
	</div>
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
				<h4 class="card-title"><i class="menu-icon fa fa-money"></i> DETAIL PEMBAYARAN</h4>
				<p class="card-description">
					<hr>
				</p>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Pemesanan</th>
                                <th>Identitas Bank</th>
                                <th>Pembayaran</th>
                                <th>Konfirmasi</th>
                                <th>Bank Tujuan</th>
                                <th>Total</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Bukti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no=1;
                            foreach ($detail as $det) { ?>
                            <tr>
                                <td class="py-1"><?php echo $no;?></td>
                                <td>kd<?= $det['id_order']?>dsn</td>
                                <td>
                                    <?= $det['bank'];?><br>
                                    <?= $det['atas_nama'];?><br>
                                    <?= $det['no_rek'];?>
                                </td>
                                <td><?= format_hari_tanggal($det['tgl_pembayaran']);?></td>
                                <td><?= format_hari_tanggal_jam($det['tgl_konfirmasi'])?></td>
                                <td>
                                    <?= $det['nama_bank'] ?><br>
                                    <?= $det['nama_pemilik'] ?><br>
                                    <?= $det['nomor_rekening'] ?>
                                </td>
                                <td><?= $det['total_order'] ?></td>
                                <td><?= $det['nominal'] ?></td>
                                <td><?php if ($det['status_bayar'] == '1') { ?>
                                    <span class="badge badge-warning text-dark">Down Payment</span>
                                <?php } elseif ($det['status_bayar'] == '2') { ?>
                                    <span class="badge badge-success">Payment Received</span>
                                <?php } ?>
                                </td>
                                <td class="text-center isotope-item">
                                    <div class="item-gallery isotope-item">
                                        <div class="overlay-item-gallery trans-0-4 flex-c-m">
                                        <a class="btn-show-gallery" href="http://web.desainrumah.com/uploads/pembayaran/<?= $det['bukti'] ?>" data-lightbox="menu">
                                        <img src="http://web.desainrumah.com/uploads/pembayaran/<?= $det['bukti'] ?>">
                                        </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $no++;}?>
                        </tbody>
                    </table>
                </div>
                <?php if ($det['status_order'] == '1' || $det['status_order'] == '2') { ?>
                <div class="row">
                    <div class="col-lg-12 mt-4">
                        <ul class="list-group t-center mb-3">
                            <li class="list-group-item" style="border-left: solid;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                                <ul class="list-group">
                                    <li class="list-group-item" style="border:none!important">
                                        <span class="txt10  mb-5"><b class="text-danger"><i class="fa  fa-exclamation-circle"></i> Perhtian:</b> Harap periksa kembali sebelum melakukan penolakan</span>
                                    </li>
                                    <li class="list-group-item" style="border:none!important">
                                        <?php echo form_open(base_url('/payment/status'), 'id="conStatus"') ?>
                                        <div class="form-group">
                                            <input type="hidden" name="id_order" value="<?php echo $_GET['o']?>">
                                            <input type="hidden" name="id_client" value="<?php echo $_GET['c']?>">
                                            <label>Status</label>
                                            <select name="status_order" id="stts" class="form-control">
                                                <option value="">Pilih Status Pemesanan</option>
                                                <option value="5">Tolak</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="tolak" style="display: none;">
                                            <label>Alasan Penolakan</label>
                                            <div>
                                                <textarea name="ket_tolak" class="form-control"></textarea><p class="text-danger fs-7 position-relative">*Harap diisi</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary konfirmasi-status" name="proses">Proses</button>
                                        </div>
                                        <?php echo form_close();?>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        
                    </div>
                </div>
                <?php } ?>                             
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <a href="javascript:void(0)" class="btn btn-warning" onclick="goBack()"><i class="fa fa-money"></i> Lihat Semua Pembayaran</a>
                        <a href="<?= base_url('/order')?>" class="btn btn-primary"><i class="fa fa-table"></i> Lihat Semua Pemesanan</a>
                        <a href="<?= base_url('/order/detail?o='.$_GET['o'].'&c='.$_GET['o'])?>" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Lihat Detail Pemesanan </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ;?>