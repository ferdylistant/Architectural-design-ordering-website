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

    public function getRiwayatTransaksi($id)
    {
        return $this->db->query("SELECT a.*,b.* FROM tbl_order a
			JOIN tbl_client b ON a.client_id=b.id_client
			WHERE a.client_id='$id'
			ORDER BY a.tgl_order desc")->getResultArray();
    }
    public function getNotifikasi($id)
    {
        return $this->db->query("SELECT a.*,b.* FROM tbl_order a
			JOIN tbl_client b ON a.client_id=b.id_client
			WHERE a.client_id='$id'
			ORDER BY a.update_status desc")->getResultArray();
    }
    public function getStatusOrder($id)
    {
        return $this->db->query("SELECT a.*,b.* FROM tbl_order a
			JOIN tbl_client b ON a.client_id=b.id_client
			WHERE a.client_id='$id'")->getResultArray();
    }
    public function getOrder($order_id)
    {
        return $this->db->query("SELECT a.*,b.* FROM tbl_order a
			JOIN tbl_client b ON a.client_id=b.id_client
			WHERE a.id_order='$order_id'")->getResultArray();
    }
}
