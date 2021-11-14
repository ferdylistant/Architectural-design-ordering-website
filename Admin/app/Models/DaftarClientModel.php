<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarClientModel extends Model
{
    protected $table                = 'tbl_client';
    protected $primaryKey           = 'id_client';
    protected $returnType           = 'array';

    public function getDaftarClient()
    {
        return $this->db->query("SELECT * FROM tbl_client ORDER BY id_client ASC")->getResultArray();
    }
    public function detailClient($id)
    {
        return $this->db->query("SELECT * FROM tbl_client WHERE id_client='$id' ")->getRowArray();
    }
    public function orderDetail($id)
    {
        return $this->db->query("SELECT a.*,b.* FROM tbl_order a
			JOIN tbl_client b ON a.client_id=b.id_client
			WHERE a.client_id='$id'")->getResultArray();
    }
}
