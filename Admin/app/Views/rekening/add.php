<?= $this->extend('Template/template_admin') ;?>
<?= $this->section('content') ;?>
<div class="row purchace-popup">
    <div class="col-12">
       <span class="d-block d-md-flex align-items-center text-center "style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
        	<ul class="breadcrumb py-0">
				<li>
					<a href="/home" class="mt-2 text-dark" ><i class="mdi mdi-home"></i> Home</a>
					<i class="mdi mdi-arrow-right"></i>
				</li>
				<li>
					<a href="/rekening" class="mt-2 text-dark">Rekening</a>
          <i class="mdi mdi-arrow-right"></i>
				</li>
				<li>
					<span class="mt-2 text-dark text-muted">Add</span>
				</li>
			</ul>
		</span>
    </div>
    <div class="col-12 grid-margin">
    	<div class="card">
        	<div class="card-body"style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
            	<h4 class="card-title"><i class="fa fa-credit-card"></i> TAMBAH REKENING</h4>                  
                    <p class="card-description">
                      <hr>
                    </p>
                    <?php if (session()->getFlashdata('error')) { ?>
                <div class="alert alert-danger alert-slide-up">
                  <?php echo session()->getFlashdata('error'); ?>
                </div>
                <?php
                }
                ?>
                    <form method="post" action="<?= base_url(); ?>/rekening/save" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Bank</label>
                          <div class="col-sm-9">
                            <input type="text" name="nama_bank" class="form-control" placeholder="Nama Bank">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nomor Rekening</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Nomor Rekening" name="nomor_rekening">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Pemilik</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Atas Nama" name="nama_pemilik">
                          </div>
                        </div>
                      </div>
                    </div>
         			<div class="row">                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Gambar</label>
                          <div class="col-sm-9">
                          	<input type="file" onchange="readURL(this);" name="userfile">
                            <img id="blah" src="" class="rounded" style="width: 220px">
                          </div>                          
                        </div>
                      </div>
                    </div>
                    <div class="row">                   
                    	<div class="col-md-6">
                    		<span class="label label-important"><b>NOTE!</b></span>
							<span>File hanya boleh dalam format gif,jpg,png,jpeg dengan max size 3 MB</span>						
                    	</div>
                    </div>
                    <div class="py-3">
                    	<input type="submit" name="submit" class="btn btn-success mr-2" value="Save">
                    	<button class="btn btn-dark" onclick="goBack()">Cancel</button>
                    </div>
              </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ;?>            
         