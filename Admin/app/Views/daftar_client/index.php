<?= $this->extend('Template/template_admin'); ?>
<?= $this->section('content'); ?>
<div class="row purchace-popup">
	<div class="col-12">
		<span class="d-block d-md-flex align-items-center text-center" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
			<ul class="breadcrumb py-0">
				<li>
					<a href="<?php echo base_url(); ?>/" class="mt-2 text-dark"><i class="mdi mdi-home"></i> Home</a>
					<i class="mdi mdi-arrow-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>/daftar-client" class="mt-2 text-dark"><i class="fa fa-users"></i> Daftar Client</a>
				</li>
			</ul>
		</span>
	</div>
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
				<h4 class="card-title"><i class="fa fa-users"></i> DAFTAR CLIENT</h4>



				<table class="table table-striped table-bordered table-hover" id="table" width="100%">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Nama</th>
							<th class="text-center">Email</th>
							<th class="text-center">Telepon</th>
							<th class="text-center">Alamat</th>
							<th class="text-center">Status Akun</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
                        $no = 1;

                        foreach ($daftarClient as $tampil) { ?>
							<tr>

								<td class="text-center"><?php echo $no; ?></td>
								<td class="text-center"><?php echo $tampil['nama_client']; ?></td>
								<td class="text-center"><?php echo $tampil['email_client']; ?></td>
								<td class="text-center"><?php echo $tampil['telp_client']; ?></td>
								<td class="text-center"><?php echo $tampil['alamat_client']; ?></td>
								<td class="text-center"><?php if ($tampil['is_active'] == 0) { ?>
										<span class="badge badge-danger">Belum aktif</span>
									<?php } else { ?>
										<span class="badge badge-success">Aktif</span>
									<?php } ?>
								</td>
								<td><a class="btn btn-outline-primary" href="<?= base_url('/client/detail?c='.base64_encode($tampil['id_client']))?>"><i class="fa fa-eye"></i></a>
								</td>


							</tr>
						<?php
                            $no++;
                        }
                        ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>