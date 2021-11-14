var notif = $('#notif_container');
var notif_count = notif.find('.count');
var notif_ul = notif.find('#notifikasi');

var last_notif_id = 0;
// memastikan mengirim AJAX hanya jika ada notif baru ketika menekan dropdown button notifikasi
var is_new_notif = false;

function notificationStream(id) {
	$.ajax({
		url: baseurl+"Notifikasi/NotifikasiController",
		dataType: 'json',
		data: {'id_client': id}
    }).done(function (data) {
    	if (0 == notif_ul.children().length) {
    		if (0 != data.length) {
    			is_new_notif = true;
				  last_notif_id = data[0].id_order;
		    	append_li(data);
    		}
    	} else {
    		// ada notifikasi baru
    		if (0 != data.length && last_notif_id < data[0].id_order) {
    			is_new_notif = true;
    			last_notif_id = data[0].id_order;
    			append_li(data);
    		}
    	}
	});    	
}

// menambahkan li notif baru dengan mengiterasi variabel data
function append_li(data) {
	if (1 < data.length)
		notif_ul.empty();

	var new_nodes = '';
	$.each(data, function(index, obj) {
    if (obj.status_order == 0) {
      new_nodes += '' +
    `<div class="card mb-3" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
      <div class="card-header bg-warning bg-gradient">
      <h5 class="card-title text-dark">
        <img src="`+baseurl+"assets/icons/png/018-auction.png"+`" class="img-fluid" alt="" width="50px">&nbsp;
        Menunggu Pembayaran</h5>
      </div>
      <div class="card-body">
      <p class="card-text">
	  	Pemesanan berhasil, silahkan lakukan pembayaran sebelum batas pembayaran berakhir. Batas pembayaran sampai dengan <span class="fw-bold">`+obj.deadline_pembayaran+`</span>
	  </p>
      <p class="card-text">
		<a href="`+baseurl+"package/payment_confirm?o="+btoa(obj.id_order)+"&c="+btoa(obj.id_client)+`" class="btn btn-warning bg-gradient">
		Konfirmasi Pembayaran
		</a>
	  </p>
        </div>
        <div class="card-footer">
          <p class="card-text"><small class="text-muted fw-lighter">`+timeSince(obj.tgl_order)+`</small></p>
        </div>
      </div>`;
    }
	else if(obj.status_order == 1){
		new_nodes += '' +
		`<div class="card mb-3" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
		  <div class="card-header bg-info bg-gradient">
		  <h5 class="card-title text-dark">
			<img src="`+baseurl+"assets/icons/png/018-auction.png"+`" class="img-fluid" alt="" width="50px">&nbsp;
			Pembayaran DP</h5>
		  </div>
		  <div class="card-body">
		  <p class="card-text">Pembayaran DP berhasil, silahkan lakukan pelunasan sesuai rincian pemesanan sebelum batas pembayaran berakhir. Batas pelunasan sampai dengan <span class="fw-bold">`+obj.deadline_pembayaran+`</span></p>
		  <p class="card-text">
			<a href="`+baseurl+"package/payment_confirm?o="+btoa(obj.id_order)+"&c="+btoa(obj.id_client)+`" class="btn btn-info bg-gradient">
			Konfirmasi Pelunasan
			</a>
			</p>
			</div>
			<div class="card-footer">
			  <p class="card-text"><small class="text-muted fw-lighter">`+timeSince(obj.update_status)+`</small></p>
			</div>
		  </div>`;
	}
	else if(obj.status_order == 2){
		new_nodes += '' +
		`<div class="card mb-3" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
		  <div class="card-header bg-success bg-gradient">
		  <h5 class="card-title text-white">
			<img src="`+baseurl+"assets/icons/png/017-auction.png"+`" class="img-fluid" alt="" width="50px">&nbsp;
			Pembayaran Lunas</h5>
		  </div>
		  <div class="card-body">
		  <p class="card-text">Pembayaran selesai, silahkan menunggu konfirmasi validasi bukti pembayaran oleh admin.</p>
		  
			</div>
			<div class="card-footer">
			  <p class="card-text"><small class="text-muted fw-lighter">`+timeSince(obj.update_status)+`</small></p>
			</div>
		  </div>`;
	}
	else if(obj.status_order == 3){
		new_nodes += '' +
		`<div class="card mb-3" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
		  <div class="card-header bg-primary bg-gradient">
		  <h5 class="card-title text-white">
			<img src="`+baseurl+"assets/icons/work-in-progress.png"+`" class="img-fluid" alt="" width="50px">&nbsp;
			Sedang Dalam Proses</h5>
		  </div>
		  <div class="card-body">
		  <p class="card-text">Pesanan desain anda sedang dalam proses pembuatan, selalu cek notifikasi secara berkala. Hasil dikirim melalui email yang telah Anda daftarkan.</p>
		  
			</div>
			<div class="card-footer">
			  <p class="card-text"><small class="text-muted fw-lighter">`+timeSince(obj.update_status)+`</small></p>
			</div>
		  </div>`;
	}
	else if(obj.status_order == 4){
		new_nodes += '' +
		`<div class="card mb-3" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
		  <div class="card-header bg-secondary bg-gradient">
		  <h5 class="card-title text-white">
			<img src="`+baseurl+"assets/icons/check.png"+`" class="img-fluid" alt="" width="40px">&nbsp;
			Pemesanan Selesai</h5>
		  </div>
		  <div class="card-body">
		  <p class="card-text">Terimakasih telah melakukan pemesanan desain di Karina Property & Consultant, kami berharap anda puas dengan pelayanan kami.</p>
		  
			</div>
			<div class="card-footer">
			  <p class="card-text"><small class="text-muted fw-lighter">`+timeSince(obj.update_status)+`</small></p>
			</div>
		  </div>`;
	}
	else if(obj.status_order == 5){
		new_nodes += '' +
		`<div class="card mb-3" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
		  <div class="card-header bg-danger bg-gradient">
		  <h5 class="card-title text-white">
			<img src="`+baseurl+"assets/icons/empty-set.png"+`" class="img-fluid" alt="" width="40px">&nbsp;
			Pembayaran Ditolak</h5>
		  </div>
		  <div class="card-body">
		  <p class="card-text">`+obj.ket_tolak+`</p>
		  
			</div>
			<div class="card-footer">
			  <p class="card-text"><small class="text-muted fw-lighter">`+timeSince(obj.update_status)+`</small></p>
			</div>
		  </div>`;
	}
	else if(obj.status_order == 6){
		new_nodes += '' +
		`<div class="card mb-3" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
		  <div class="card-header bg-danger bg-gradient">
		  <h5 class="card-title text-white">
			<img src="`+baseurl+"assets/icons/png/018-auction.png"+`" class="img-fluid" alt="" width="50px">&nbsp;
			Pemesanan Dibatalkan</h5>
		  </div>
		  <div class="card-body">
		  <p class="card-text">Pemesanan berhasil, silahkan lakukan pembayaran sebelum batas pembayaran berakhir. Batas pembayaran sampai dengan <span class="fw-bold">`+obj.deadline_pembayaran+`</span></p>
		  
			</div>
			<div class="card-footer">
			  <p class="card-text"><small class="text-muted fw-lighter">`+timeSince(obj.update_status)+`</small></p>
			</div>
		  </div>`;
	}
	});

	notif_ul.prepend(new_nodes);
	notif_count.text(data.length);
	
	// notif dropdown hanya memuat maks 8
	if (8 < notif_ul.children().length) {
		// hitung selisih
		var deleted_elements = notif_ul.children().length - 8;
		// hapus selisih
		for (var i = 0; i < deleted_elements; i++) {
			notif_ul.children().last().remove();
		}
	}
}

// perbarui last_notif di tabel user ketika menekan notifikasi
$('.btnnotif').click(function(event) {
	// ubah jumlah notifikasi menjadi 0
	notif_count.empty();
	if (is_new_notif) {
		is_new_notif = false;
	}

});