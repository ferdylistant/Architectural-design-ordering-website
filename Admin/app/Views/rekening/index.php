<?= $this->extend('Template/template_admin') ;?>
<?= $this->section('content') ;?>
<div class="row purchace-popup">
            <div class="col-lg-12">
              <span class="d-block d-md-flex align-items-center text-center "style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                  <ul class="breadcrumb py-0">
					<li>
						
						<a href="/" class="mt-2 text-dark" ><i class="mdi mdi-home"></i> Home</a>
						<i class="mdi mdi-arrow-right"></i>
					</li>
					<li>
						<span class="mt-2 text-dark text-muted">Rekening</span>
					</li>
				</ul></span>
            </div>
			
			<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                  <h4 class="card-title"><i class="fa fa-credit-card"></i> DATA REKENING</h4>
                  <?php
                if (session()->getFlashdata('hapus')) {
                    echo "&nbsp;&nbsp;&nbsp;<div class='alert alert-danger alert-slide-up'>
							<span>".session()->getFlashdata('hapus')."</span>  
							</div>";
                } elseif (session()->getFlashdata('success')) {
                    echo "&nbsp;&nbsp;&nbsp;<div class='alert alert-success alert-slide-up'>
							<span>".session()->getFlashdata('success')."</span>  
							</div>";
                }
            ?>
                  <p class="card-description">
                    <a class="btn btn-success btn-block" href="/rekening/add">Add<i class="mdi mdi-plus"></i></a>
                    <hr>
                  </p>
							<table class="table table-striped table-bordered table-hover" id="table" >
							<thead>
							<tr>
								<th class="text-center">No</th>								
								<th class="text-center">Nama Bank</th>
								<th class="text-center">Nomor Rekening</th>
								<th class="text-center">Nama Pemilik</th>
								<th class="text-center">Gambar</th>
								<th class="text-center">Aksi</th>
							</tr>
							</thead>
							<tbody>
											<?php
                                        $no=1;
                                        
                                            foreach ($rekening as $tampil) { ?>
										<tr >

											<td class="py-1"><?php echo $no;?></td>											
											<td class="text-center"><?php echo $tampil['nama_bank'];?></td>
											<td class="text-center"><?php echo $tampil['nomor_rekening'];?></td>
											<td class="text-center"><?php echo $tampil['nama_pemilik'];?></td>
											<td class="text-center"><img src="uploads/rekening/<?php echo $tampil['gambar_rekening']?>" ></td>
											<td><a class="btn btn-outline-primary" href="/rekening/edit/<?php echo base64_encode($tampil['id_rekening']);?>"><i class="fa fa-edit"></i></a> &nbsp;
												<a class="btn btn-outline-danger hapus-rekening" href="/rekening/delete/<?php echo base64_encode($tampil['id_rekening']);?>"><i class="fa fa-times"></i></a>
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
<?= $this->endSection() ;?>