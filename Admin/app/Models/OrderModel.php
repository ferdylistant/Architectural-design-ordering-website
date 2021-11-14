<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table                = 'tbl_order';
    protected $primaryKey           = 'id_order';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['client_id','tgl_order','deadline_pembayaran','status_order','ket_tolak','total_order','update_status'];

    public function getOrder()
    {
        return $this->db->query("SELECT * from tbl_order
			join tbl_client on tbl_order.client_id=tbl_client.id_client
			where status_order='0' or status_order='1' or status_order='2' or status_order='3' or status_order='4' or status_order='5' or status_order='6'
			order by tgl_order asc")->getResultArray();
    }
    public function view_by_date($tgl)
    {
        return $this->db->query("SELECT * FROM tbl_order
        JOIN tbl_pembayaran ON tbl_order.id_order=tbl_pembayaran.order_id
        JOIN tbl_client ON tbl_order.client_id=tbl_client.id_client
        JOIN tbl_rekening ON tbl_pembayaran.rekening_id=tbl_rekening.id_rekening
        JOIN tbl_order_detail ON tbl_order.id_order=tbl_order_detail.order_id
        JOIN tbl_paket ON tbl_paket.id_paket=tbl_order_detail.paket_id
        JOIN tbl_arsitektur ON tbl_paket.id_paket=tbl_arsitektur.paket_id
        JOIN tbl_fasilitas ON tbl_paket.id_paket=tbl_fasilitas.paket_id
        WHERE date(tgl_order)='$tgl' AND status_order='4'
        GROUP BY tbl_order.id_order")->getResult();
    }
    public function view_by_month($bulan, $tahun)
    {
        return $this->db->query("SELECT * FROM tbl_order
        JOIN tbl_pembayaran ON tbl_order.id_order=tbl_pembayaran.order_id
        JOIN tbl_client ON tbl_order.client_id=tbl_client.id_client
        JOIN tbl_rekening ON tbl_pembayaran.rekening_id=tbl_rekening.id_rekening
        JOIN tbl_order_detail ON tbl_order.id_order=tbl_order_detail.order_id
        JOIN tbl_paket ON tbl_paket.id_paket=tbl_order_detail.paket_id
        JOIN tbl_arsitektur ON tbl_paket.id_paket=tbl_arsitektur.paket_id
        JOIN tbl_fasilitas ON tbl_paket.id_paket=tbl_fasilitas.paket_id
        WHERE MONTH(tgl_order)='$bulan' AND YEAR(tgl_order)='$tahun' AND status_order='4'
        GROUP BY tbl_order.id_order")->getResult();
    }
    public function view_by_year($tahun)
    {
        return $this->db->query("SELECT * FROM tbl_order
        JOIN tbl_pembayaran ON tbl_order.id_order=tbl_pembayaran.order_id
        JOIN tbl_client ON tbl_order.client_id=tbl_client.id_client
        JOIN tbl_rekening ON tbl_pembayaran.rekening_id=tbl_rekening.id_rekening
        JOIN tbl_order_detail ON tbl_order.id_order=tbl_order_detail.order_id
        JOIN tbl_paket ON tbl_paket.id_paket=tbl_order_detail.paket_id
        JOIN tbl_arsitektur ON tbl_paket.id_paket=tbl_arsitektur.paket_id
        JOIN tbl_fasilitas ON tbl_paket.id_paket=tbl_fasilitas.paket_id
        WHERE YEAR(tgl_order)='$tahun' AND status_order='4'
        GROUP BY tbl_order.id_order")->getResult();
    }
    public function view_all()
    {
        return $this->db->query("SELECT * FROM tbl_order
        JOIN tbl_pembayaran ON tbl_order.id_order=tbl_pembayaran.order_id
        JOIN tbl_client ON tbl_order.client_id=tbl_client.id_client
        JOIN tbl_rekening ON tbl_pembayaran.rekening_id=tbl_rekening.id_rekening
        JOIN tbl_order_detail ON tbl_order.id_order=tbl_order_detail.order_id
        JOIN tbl_paket ON tbl_paket.id_paket=tbl_order_detail.paket_id
        JOIN tbl_arsitektur ON tbl_paket.id_paket=tbl_arsitektur.paket_id
        JOIN tbl_fasilitas ON tbl_paket.id_paket=tbl_fasilitas.paket_id
        WHERE tbl_order.status_order='4'
        GROUP BY tbl_order.id_order")->getResult();
    }
    public function option_tahun()
    {
        return $this->db->query("SELECT YEAR(tgl_order) AS tahun FROM tbl_order GROUP BY YEAR(tgl_order) ORDER BY YEAR(tgl_order)")->getResult();
    }
    public function getNotifikasi()
    {
        return $this->db->query("SELECT * FROM tbl_order
        JOIN tbl_client ON tbl_order.client_id=tbl_client.id_client
        WHERE tbl_order.status_order='0' OR tbl_order.status_order='1' OR tbl_order.status_order='2'
        ORDER BY tbl_order.update_status ASC LIMIT 3")->getResultArray();
    }
}
