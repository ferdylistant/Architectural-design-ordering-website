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
        <a href="<?php echo base_url();?>/portfolio/category" class="mt-2 text-dark">Kategori Portofolio</a>
        <i class="mdi mdi-arrow-right"></i>
      </li>
      <li>
        <span class="mt-2 text-dark text-muted">Edit</span>
      </li>
    </ul></span>
  </div>


  <div class="col-12 stretch-card">
    <div class="card">
      <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
        <h4 class="card-title"><i class="fa fa-list"></i> EDIT KATEGORI PORTOFOLIO</h4>
        <p class="card-description">
          <hr>
        </p>
        <?php 
				if (session()->getFlashdata('error')){
					echo "<div class='alert alert-danger alert-slide-up'>
					<span>".session()->getFlashdata('error')."</span>  
					</div>";
				} ?>

        <?php echo form_open(base_url('/portfolio/category/update'),'class="form-horizontal"'); ?>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Nama Kategori Portofolio</label>
          <div class="col-sm-9">
            <input type="hidden" class="form-control" name="id_kategori_portofolio" value="<?= $edit['id_kategori_portofolio'];?>">
            <input type="text" class="form-control" name="nama_kategori_portofolio" value="<?= $edit['nama_kategori_portofolio'];?>" required>
          </div>
        </div>                      
        
        <a href="javascript:void(0)" onclick="goBack()" class="btn btn-dark">Cancel</a>
        <input type="submit" name="update" class="btn btn-success mr-2" value="Update">

        <?php echo form_close();?>

      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ;?>