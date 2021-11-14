<?= $this->extend('Template/template_admin') ;?>
<?= $this->section('content') ;?>
<div class="row purchace-popup">
  <div class="col-12">
   <span class="d-block d-md-flex align-items-center text-center " style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
     <ul class="breadcrumb py-0">
      <li>
       <a href="/" class="mt-2 text-dark" ><i class="mdi mdi-home"></i> Home</a>
       <i class="mdi mdi-arrow-right"></i>
     </li>
     <li>
       <a href="/portfolio" class="mt-2 text-dark">Portfolio</a>
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
   <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
     <h4 class="card-title"><i class="fa fa-archive"></i>&nbsp;Portfolio Add</h4>
     <p class="card-description">
      <hr>
    </p>
    <?php
      if (session()->getFlashdata('error')) {
          echo "&nbsp;&nbsp;&nbsp;<div class='alert alert-danger alert-slide-up'>
    <span>".session()->getFlashdata('error')."</span>  
    </div>";
      }
    ?>
  <form method="post" action="<?= base_url(); ?>/portfolio/save" enctype="multipart/form-data" class="form-horizontal">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Nama Portofolio</label>
        <div class="col-sm-9">
          <input tipe="text" name="nama_portofolio" class="form-control" value="<?php echo set_value('nama_portofolio') ?>" required>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Kategori Portofolio</label>
        <div class="col-sm-9">
        <select data-placeholder="Select..." name="id_kategori_portofolio" class="form-control select2me" value="<?php echo set_value('id_kategori_portofolio') ?>" required>
            <option value="">pilih kategori</option>
            <?php foreach ($kategori as $value) { ?>
            <option value="<?= $value['id_kategori_portofolio']?>"><?= $value['nama_kategori_portofolio']?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Keterangan</label>
        <div class="col-sm-12">
          <textarea class="form-control" name="keterangan" required><?php echo set_value('keterangan') ?></textarea>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Ambil Gambar</label>
        <div class="col-sm-12">
        <input type="file" name="userfile[]" id="gallery-photo-add" class="form-control" multiple>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group row">
        <div class="col-sm-12 imageJS">
        
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <ul class="list-group t-center mb-5" style="height: 30px">
            <li class="list-group-item" style="border-left: solid;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
              <span class="txt10 t-center"><b class="text-danger"><i class="fa  fa-exclamation-circle"></i> Perhtian:</b> Harap periksa kembali sebelum menyimpan data              </span>
            </li>
          </ul>
    </div>
  </div>
  <div class="row">
  <div class="col-md-12">
   <input type="submit" name="submit" class="btn btn-success mr-2" value="Save">
   <button class="btn btn-dark" onclick="goBack()">Cancel</button>
 </div>
</div>
    </form>
</div>
</div>
</div>
</div>
<?= $this->endSection() ;?>
