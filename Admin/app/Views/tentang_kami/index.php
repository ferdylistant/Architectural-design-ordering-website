<?= $this->extend('Template/template_admin') ;?>
<?= $this->section('content') ;?>
<div class="row purchace-popup">
  <div class="col-12">
    <span class="d-block d-md-flex align-items-center text-center "style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
      <ul class="breadcrumb py-0">
        <li>
          <a href="/" class="mt-2 text-dark" >
            <i class="mdi mdi-home"></i> Home</a>
			<i class="mdi mdi-arrow-right"></i>
        </li>
        <li>
          <span class="mt-2 text-dark text-muted">Perusahaan</span>
        </li>
      </ul>
    </span>                            
  </div>
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body"style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                <h4 class="card-title"><i class="fa fa-building"></i>&nbsp;PERUSAHAAN</h4>
                <?php
                if (session()->getFlashdata('hapus')) {
                    echo "&nbsp;&nbsp;&nbsp;<div class='alert alert-danger alert-slide-up'>
							<span>".session()->getFlashdata('hapus')."</span>  
							</div>";
                } elseif (session()->getFlashdata('success')) {
                    echo "&nbsp;&nbsp;&nbsp;<div class='alert alert-success alert-slide-up'>
							<span>".session()->getFlashdata('success')."</span>  
							</div>";
                }?>
				<?php if (empty($company)) { ?>
					<p class="card-description">
						<a class="btn btn-success btn-block" href="/company/add">Add<i class="mdi mdi-plus"></i>
						</a>
						<hr>
					</p>
				<?php }?>
                  	
				<table class="table table-striped table-bordered table-hover" id="table" style="width: 100%">
					<thead>
						<tr>
							<th class="text-center">No</th>								
							<th class="text-center">Nama Perusahaan</th>
							<th class="text-center">Email</th>
							<th class="text-center">Telepon</th>
							<th class="text-center">Alamat</th>
							<th class="text-center">Logo</th>
							<th class="text-center">Deskripsi</th>
							<th class="text-center">WhatsApp</th>
							<th class="text-center">Instagram</th>
							<th class="text-center" >Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1;
                        foreach ($company as $tampil) { ?>
						<tr >
							<td class="text-center"><?php echo $no;?></td>											
							<td class="text-center"><?php echo $tampil['nama_perusahaan'];?></td>
							<td class="text-center"><?php echo $tampil['email_perusahaan'];?></td>
							<td class="text-center"><?php echo $tampil['telp_perusahaan'];?></td>
							<td class="text-center"><?php echo $tampil['alamat_perusahaan'];?></td>
							<td class="text-center">
								<img src="uploads/perusahaan/<?php echo $tampil['logo']?>" class="img img-fluid">
							</td>
							<td class="text-center" style="text-overflow: ellipsis;white-space: normal;"><?php echo $tampil['deskripsi']?></td>
							<td class="text-center"><?php echo $tampil['wa']?></td>
							<td class="text-center"><?php echo $tampil['ig']?></td>
							<td class="text-center">
								<a class="btn btn-outline-primary" href="/company/edit/<?php echo base64_encode($tampil['id_perusahaan']);?>">
									<i class="fa fa-edit"></i></a>
								&nbsp;
								<a class="btn btn-outline-danger hapus-perusahaan" href="/company/delete/<?php echo base64_encode($tampil['id_perusahaan']);?>"> 
									<i class="fa fa-times"></i>
								</a>
							</td>
						</tr>
						<?php $no++;}?>
					</tbody>
				</table>
      </div>
    </div>
  </div>        
</div>
<?= $this->endSection() ;?>