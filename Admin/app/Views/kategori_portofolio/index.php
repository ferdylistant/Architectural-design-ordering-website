<?= $this->extend('Template/template_admin') ;?>
<?= $this->section('content') ;?>
<div class="row purchace-popup">
	<div class="col-12">
		<span class="d-block d-md-flex align-items-center text-center" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
			<ul class="breadcrumb py-0">
				<li>
					<a href="<?php echo base_url();?>/" class="mt-2 text-dark" ><i class="mdi mdi-home"></i> Home</a>
					<i class="mdi mdi-arrow-right"></i>
				</li>
				<li>
					<span class="mt-2 text-dark text-muted">Kategori Portofolio</span>
				</li>
			</ul>
		</span>           					
	</div>					
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
				<h4 class="card-title"><i class="fa fa-list"></i> KATEGORI PORTOFOLIO</h4>
				<?php 
				if (session()->getFlashdata('success')){
					echo "<div class='alert alert-success alert-slide-up'>
					<span>".session()->getFlashdata('success')."</span>  
					</div>";
				} ?>
				<p class="card-description">
					<a class="btn btn-success btn-block" href="<?php echo base_url();?>/portfolio/category/add">Add<i class="mdi mdi-plus"></i></a>
					<hr>
				</p>
				<table class="table table-striped table-bordered table-hover" id="table" style="width:100%">
					<thead>
						<tr>
							<th class="text-center">No</th>								
							<th class="text-center">Kategori Galeri</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no=1;
						foreach ($kategori as $tampil) { ?>
							<tr>
								<td class="text-center"><?php echo $no;?></td>
								<td class="text-center"><?php echo $tampil['nama_kategori_portofolio'];?></td>
								<td class="text-center">
									<a class="btn btn-outline-primary" href="<?php echo base_url();?>/portfolio/category/edit/<?= base64_encode($tampil['id_kategori_portofolio']);?>"><i class="fa fa-edit"></i>
									</a>
									&nbsp;
									<a class="btn btn-outline-danger hapus-kategori-galeri" href="<?php echo base_url();?>/portfolio/category/delete/<?= base64_encode($tampil['id_kategori_portofolio']);?>"> <i class="fa fa-times"></i>
									</a>
								</td>
							</tr>
							<?php $no++; }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?= $this->endSection() ;?>