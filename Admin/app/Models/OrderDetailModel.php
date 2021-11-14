<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetailModel extends Model
{
    protected $table                = 'tbl_order_detail';
    protected $primaryKey           = 'id_order_detail';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['client_id','paket_id','order_id','jumlah_order','sub_harga'];

    public function getOrderDetail($id)
    {
        return $this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,f.* FROM tbl_order_detail a
		JOIN tbl_client b ON a.client_id=b.id_client
		JOIN tbl_order c ON a.order_id=c.id_order
		JOIN tbl_paket d ON a.paket_id=d.id_paket
		JOIN tbl_arsitektur e ON d.id_paket=e.paket_id
		JOIN tbl_fasilitas f ON d.id_paket=f.paket_id
		WHERE c.id_order='$id' ")->getResultArray();
    }
}
