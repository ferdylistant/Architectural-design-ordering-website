<?php

namespace App\Models;

use CodeIgniter\Model;

class RekeningModel extends Model
{
    protected $table                = 'tbl_rekening';
    protected $primaryKey           = 'id_rekening';
    protected $useAutoIncrement     = true;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['nama_bank','nomor_rekening','nama_pemilik','gambar_rekening'];

    public function getRekening()
    {
        return $this->db->query("SELECT * FROM tbl_rekening ORDER BY id_rekening DESC")->getResultArray();
    }
    public function getRekeningId($id)
    {
        return $this->db->query("SELECT * FROM tbl_rekening WHERE id_rekening='$id'")->getRowArray();
    }
    public function deleteRekening($id)
    {
        return $this->db->query("DELETE FROM tbl_rekening WHERE id_rekening='$id' ");
    }
}
