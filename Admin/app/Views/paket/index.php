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
          <span class="mt-2 text-dark text-muted">Paket</span>
        </li>
      </ul>
    </span>                            
  </div>
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body"style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                <h4 class="card-title"><i class="fa fa-list-alt"></i>&nbsp;PAKET</h4>
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
					<p class="card-description">
						<a class="btn btn-success btn-block" href="/paket/add">Add<i class="mdi mdi-plus"></i>
						</a>
						<hr>
					</p>
                  	
				<table class="table table-striped table-bordered table-hover" id="table" style="width: 100%">
					<thead>
						<tr>
							<th class="text-center">No</th>								
							<th class="text-center">Nama Paket</th>
							<th class="text-center">Tipe</th>
							<th class="text-center">Fasilitas</th>
							<th class="text-center">Ukuran Tanah</th>
							<th class="text-center">Satuan</th>
							<th class="text-center">Arsitektur</th>
							<th class="text-center">Harga</th>
							<th class="text-center" >Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1;
                        foreach ($paket as $tampil) { ?>
						<tr >
							<td class="text-center"><?php echo $no;?></td>											
							<td class="text-center"><?php echo $tampil['nama_paket'];?></td>
							<td class="text-center"><?php echo $tampil['tipe'];?></td>
							<td class="text-start"><?php echo $tampil['nama_fasilitas'];?></td>
							<td class="text-center"><?php echo $tampil['ukuran_tanah'];?></td>
							<td class="text-center"><?php echo $tampil['satuan'];?></td>
							<td class="text-start"><?php echo $tampil['ket_arsitektur'];?></td>
							<td class="text-center"><?php echo rupiah($tampil['harga']);?></td>
							<td class="text-center">
								<a class="btn btn-outline-primary" href="/paket/edit/<?php echo base64_encode($tampil['id_paket']);?>">
									<i class="fa fa-edit"></i></a>
								&nbsp;
								<a class="btn btn-outline-danger hapus-paket" href="/paket/delete/<?php echo base64_encode($tampil['id_paket']);?>"> 
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