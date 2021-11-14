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
					<a href="<?php echo base_url();?>/order" class="mt-2 text-dark"><i class="menu-icon fa fa-shopping-cart"></i> Semua Pesanan</a>
					<i class="mdi mdi-arrow-right"></i>
				</li>
				<li>
					<span class="mt-2 text-dark text-muted"> Nota</span>
					
				</li>
			</ul>
		</span>
	</div>
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
				<h4 class="card-title"><i class="menu-icon fa fa-shopping-cart"></i> NOTA</h4>
				<p class="card-description">
					<hr>
				</p>
				<?php foreach ($nota as $nota) {
}?>
				<div class="row" style="padding-bottom: 30px">
					<div class="col-lg-6">
						<h3>Pemesanan</h3>
						
						<ul class="list-group">
							<li class="list-group-item">
								<label><strong>Kode Pemesanan:</strong></label>
								<span style="float: right;">kd<?php echo $nota['id_order'] ?>dsn</span>
							</li>
							<li class="list-group-item">
								<label><strong>Tanggal Pemesanan:</strong></label>
								<span style="float: right;"><?php echo format_hari_tanggal_jam($nota['tgl_order']) ?></span>
							</li>
							<li class="list-group-item">
								<label><strong>Batas Pembayaran:</strong></label>
								<span style="float: right;">
								<?php if ($nota['status_order'] == '2' || $nota['status_order'] == '3' || $nota['status_order'] == '4') { ?>
									-
								<?php } else { ?>
									<?php echo format_hari_tanggal_jam($nota['deadline_pembayaran']); ?></span>
								<?php } ?>
								
							</li>
							<li class="list-group-item">
								<label><strong>Total Pemesanan:</strong></label>
								<span style="float: right;"><?php echo rupiah($nota['total_order']); ?></span>
							</li>
							<li class="list-group-item">
								<label><strong>Status:</strong></label>
								<span style="float: right;"><?php
                                if ($nota['status_order']=='0') { ?>
								<span  class="badge badge-warning text-dark">waiting payment</span>
								<?php } elseif ($nota['status_order']=="1") { ?>
								<span class="badge badge-info">DP received</span>
								<?php } elseif ($nota['status_order']=="2") { ?>
								<span class="badge badge-success">payment received</span>
								<?php } elseif ($nota['status_order']=="3") { ?>
								<span class="badge badge-primary">in progress</span>
								<?php } elseif ($nota['status_order']=="4") {?>
								<span class="badge badge-secondary text-dark">completed</span>
								<?php } elseif ($nota['status_order']=="5") { ?>
								<span class="badge badge-dark">rejected</span>
								<?php } elseif ($nota['status_order']=="6") { ?>
								<span class="badge badge-dark">expired</span>
								<?php } ?>
							</span>
						</li>
						<?php if ($nota['status_order'] == '1' || $nota['status_order'] == '2' || $nota['status_order'] == '3') { ?>
						<li class="list-group-item">
							
							<form action="<?= base_url()?>/order/status" method="post" id="conStatus">
							<div class="form-group">
								<label><strong>Ubah Status</strong></label>
								<?php if ($nota['status_order']=='1' || $nota['status_order']=='2') { ?>
								<input type="hidden" name="id_order" value="<?php echo $_GET['o']?>">
								<input type="hidden" name="id_client" value="<?php echo $_GET['c']?>">
								<select name="status_order" id="stts" class="form-control">
									<option value="">Pilih Status</option>
									<option value="3">In Progress</option>
									<option value="5">Reject</option>
								</select>
								<?php } elseif ($nota['status_order']=='3') { ?>
								<input type="hidden" name="id_order" value="<?php echo $_GET['o']?>">
								<input type="hidden" name="id_client" value="<?php echo $_GET['c']?>">
								<select name="status_order" class="form-control">
									<option value="">Pilih Status</option>
									<option value="4">Completed</option>
								</select>
								<?php } ?>
							</div>
							<div class="form-group" id="tolak" style="display: none;">
								<label>Alasan Penolakan</label>
								<div>
									<textarea name="ket_tolak" class="form-control"></textarea><p class="text-danger fs-7 position-relative">*Harap diisi</p>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary konfirmasi-status" name="proses">Proses</button>
							</div>
						</form>
						</li>
						<?php } ?>
					</ul>

				</div>
				<div class="col-lg-6">
					<h3>Pelanggan</h3>
					<ul class="list-group">
						<li class="list-group-item">
							<label><strong>Nama:</strong></label>
							<span style="float: right;"><?php echo $nota['nama_client']?></span>
						</li>
						<li class="list-group-item">
							<label><strong>Email:</strong></label>
							<span></span>
							<span style="float: right;"><?php echo $nota['email_client']?></span>
						</li>
						<li class="list-group-item">
							<label><strong>Nomor Telepon:</strong></label>
							<span style="float: right;"><?php echo $nota['telp_client']?></span>
						</li>
						<li class="list-group-item">
							<label><strong>Alamat:</strong></label>
							<span style="float: right;"><?php echo $nota['alamat_client']?></span>
						</li>
					</ul>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table" style="width:100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Produk</th>
							<th>Kuantitas</th>
							<th>Tipe</th>
							<th>Ukuran Tanah</th>
							<th>Fasilitas</th>
							<th>Arsitektur</th>
							<th>Harga</th>
							<th>Sub-Total</th>
						</tr>
					</thead>
					<tbody>
						<?php
                        $no=1;
                        foreach ($tpesan as $det) { ?>
						<tr>
							<td class="py-1"><?php echo $no;?></td>
							<td><?= $det['nama_paket']?></td>
							<td><?= $det['jumlah_order'];?></td>
							<td><?= $det['tipe'];?></td>
							<td><?= $det['ukuran_tanah'].$det['satuan'] ?></td>
							<td><?= $det['nama_fasilitas'] ?></td>
							<td><?= $det['ket_arsitektur'] ?></td>
							<td><?= $det['harga'] ?></td>
							<td><?= $det['sub_harga'] ?></td>
						</tr>
						<?php $no++;}?>
					</tbody>
				</table>
			</div>
			<br>
			<a href="javascript:void(0)" class="btn btn-primary" onclick="goBack()"><i class="fa fa-table"></i> Lihat Semua Pemesanan</a>&nbsp;
			<?php if ($nota['status_order'] == '1' || $nota['status_order'] == '2' || $nota['status_order'] == '3' || $nota['status_order'] == '4'): ?>
				<a href="<?php echo base_url('/payment/detail?o='.$_GET['o'].'&c='.$_GET['c'])?>" class="btn btn-success"><i class="fa fa-money"></i> Lihat Pembayaran</a>
			<?php endif ?>
		</div>
	</div>
</div>
</div>
<?= $this->endSection() ;?>