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
       <a href="/paket" class="mt-2 text-dark">Paket</a>
       <i class="mdi mdi-arrow-right"></i>
     </li>
     <li>
       <span class="mt-2 text-dark text-muted">Edit</span>
     </li>
   </ul>
 </span>
</div>
<div class="col-12 grid-margin">
 <div class="card">
   <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
     <h4 class="card-title"><i class="fa fa-list-alt"></i>&nbsp;Paket Edit</h4>
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
  <form method="post" action="<?= base_url(); ?>/paket/update" enctype="multipart/form-data" class="form-horizontal">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Nama Paket</label>
        <div class="col-sm-9">
          <input tipe="text" name="nama_paket" class="form-control" value="<?php echo $paket['nama_paket'] ?>">
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Tipe</label>
        <div class="col-sm-9">
        <select data-placeholder="Select..." name="tipe" class="form-control select2me" value="<?php echo $paket['tipe'] ?>">
            <option value=""></option>
            <option value="tipe 21">Tipe 21</option>
            <option value="tipe 24">Tipe 24</option>
            <option value="tipe 36">Tipe 36</option>
            <option value="tipe 54">Tipe 54</option>
            <option value="tipe 60">Tipe 60</option>
            <option value="tipe 70">Tipe 70</option>
            <option value="tipe 120">Tipe 120</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label"> Fasilitas</label>
        <div class="col-sm-9">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <div class="form-check form-check-flat">
                  <label class="form-check-label">
                   
                    <input type="checkbox" name="nama_fasilitas[]" class="form-check-input" value="Ruang Tamu"> Ruang Tamu
                  </label>
                </div>
                <div class="form-check form-check-flat">
                  <label class="form-check-label">
                    <input type="checkbox" name="nama_fasilitas[]" class="form-check-input" value="Kamar Mandi"> Kamar Mandi
                  </label>
                </div>
                <div class="form-check form-check-flat">
                  <label class="form-check-label">
                    <input type="checkbox" name="nama_fasilitas[]" class="form-check-input" value="Kamar Tidur"> Kamar Tidur
                  </label>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <div class="form-check form-check-flat">
                  <label class="form-check-label">
                    <input type="checkbox" name="nama_fasilitas[]" class="form-check-input" value="Ruang Keluarga"> Ruang Keluarga
                  </label>
                </div>
                <div class="form-check form-check-flat">
                  <label class="form-check-label">
                    <input type="checkbox" name="nama_fasilitas[]" class="form-check-input" value="Ruang Makan"> Ruang Makan
                  </label>
                </div>
                <div class="form-check form-check-flat">
                  <label class="form-check-label">
                    <input type="checkbox" name="nama_fasilitas[]" class="form-check-input" value="Ruang Dapur"> Ruang Dapur
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label"> Arsitektur</label>
        <div class="col-sm-9">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <div class="form-check form-check-flat">
                  <label class="form-check-label">
                    <input type="checkbox" name="ket_arsitektur[]" class="form-check-input" value="Gambar Denah"> Gambar Denah
                  </label>
                </div>
                <div class="form-check form-check-flat">
                  <label class="form-check-label">
                    <input type="checkbox" name="ket_arsitektur[]" class="form-check-input" value="Pola Keramik"> Pola Keramik
                  </label>
                </div>
                <div class="form-check form-check-flat">
                  <label class="form-check-label">
                    <input type="checkbox" name="ket_arsitektur[]" class="form-check-input" value="Rencana Atap"> Rencana Atap
                  </label>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <div class="form-check form-check-flat">
                  <label class="form-check-label">
                    <input type="checkbox" name="ket_arsitektur[]" class="form-check-input" value="Denah Jendela"> Denah Jendela
                  </label>
                </div>
                <div class="form-check form-check-flat">
                  <label class="form-check-label">
                    <input type="checkbox" name="ket_arsitektur[]" class="form-check-input" value="Rencana Plafon"> Rencana Plafon
                  </label>
                </div>
                <div class="form-check form-check-flat">
                  <label class="form-check-label">
                    <input type="checkbox" name="ket_arsitektur[]" class="form-check-input" value="Gambar Tampak"> Gambar Tampak
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Ukuran Tanah</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" placeholder="" name="ukuran_tanah" value="<?php echo $paket['ukuran_tanah'] ?>">
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Satuan</label>
        <div class="col-sm-9">
        <select data-placeholder="Select..." name="satuan" class="form-control select2me" value="<?php echo $paket['satuan'] ?>">
            <option value=""></option>
            <option value="m<sup>2</sup>">m<sup>2</sup></option>
          </select>
        </div>
      </div>
    </div>                      
    <div class="col-md-6">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Harga</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" placeholder="" name="harga" value="<?php echo $paket['harga'] ?>">
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
   <input type="submit" name="submit" class="btn btn-success mr-2" value="Update">
   <button class="btn btn-dark" onclick="goBack()">Cancel</button>
 </div>
</div>
    </form>
</div>
</div>
</div>
</div>
<?= $this->endSection() ;?>
