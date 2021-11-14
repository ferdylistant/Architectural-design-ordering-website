<?= $this->extend('Template/template_admin') ;?>
<?= $this->section('content') ;?>
<div class="row purchace-popup">
  <div class="col-12">
    <span class="d-block d-md-flex align-items-center text-center " style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
      <ul class="breadcrumb py-0">
        <li>

          <a href="<?php echo base_url();?>/" class="mt-2 text-dark" ><i class="mdi mdi-home"></i> Home</a>
          <i class="mdi mdi-arrow-right"></i>
        </li>
        <li>
          <span class="mt-2 text-dark text-muted">Data Pembayaran</span>
        </li>
      </ul></span> 
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
          <h4 class="card-title"><i class="menu-icon fa fa-money"></i> DATA PEMBAYARAN</h4>
          <p class="card-description">

            <hr>
          </p>
          <table class="table table-striped table-bordered table-hover" id="table" style="width:100%">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kode Pemesanan</th>
                <th class="text-center">Pembayaran</th>
                <th class="text-center">Konfirmasi</th>
                <th class="text-center">Bank Tujuan</th>
                <th class="text-center">Total</th>
                <th class="text-center">Detail</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1;
              foreach ($pembayaran as $tampil) { ?>
                <tr>
                  <td class="text-center"><?php echo $no;?></td>
                  <td class="text-center">kd<?php echo $tampil['id_order'];?>dsn</td>
                  <td class="text-center"><?php echo format_hari_tanggal($tampil['tgl_pembayaran']);?></td>
                  <td class="text-center"><?php echo format_hari_tanggal_jam($tampil['tgl_konfirmasi']);?></td>
                  <td class="text-center">
                    <?php echo $tampil['nama_bank'];?><br>
                    <?php echo $tampil['nama_pemilik'];?><br>
                    <?php echo $tampil['nomor_rekening'];?>
                  </td>
                  <td class="text-center"><?php echo rupiah($tampil['total_order']);?></td>
                  <td class="text-center"><a href="<?= base_url('/payment/detail?o='.base64_encode($tampil['id_order']).'&c='.base64_encode($tampil['id_client']))?>" class="btn social-btn btn-rounded btn-social-outline-linkedin"><span class="fa fa-eye"></span></a></td>
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