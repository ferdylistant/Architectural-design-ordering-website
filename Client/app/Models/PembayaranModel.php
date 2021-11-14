<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table                = 'tbl_pembayaran';
    protected $primaryKey           = 'id_pembayaran';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['atas_nama','bank','tgl_pembayaran','no_rek','nominal','bukti','status_bayar','tgl_konfirmasi','order_id','client_id','rekening_id'];

    public function getPembayaran($id)
    {
        return $this->db->query("SELECT a.*,b.*,c.*,d.* FROM tbl_pembayaran a
			JOIN tbl_client b ON a.client_id=b.id_client
			JOIN tbl_order c ON a.order_id=c.id_order
			JOIN tbl_rekening d ON a.rekening_id=d.id_rekening
			WHERE c.id_order='$id'")->getResultArray();
    }
}
