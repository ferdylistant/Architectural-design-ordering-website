<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketProdukModel extends Model
{
    protected $table                = 'tbl_paket';
    protected $primaryKey           = 'id_paket';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['nama_paket','tipe','ukuran_tanah','satuan','harga'];

    public function getPaket()
    {
        return $this->db->query("SELECT a.*,b.*,c.* FROM tbl_paket a
        	JOIN tbl_fasilitas b ON a.id_paket=b.paket_id
        	JOIN tbl_arsitektur c ON a.id_paket=c.paket_id
        	ORDER BY a.id_paket ASC")->getResultArray();
        // return $this->db->query("SELECT * FROM tbl_paket")->getResultArray();
    }
    public function getPaketId($id)
    {
        return $this->db->query("SELECT a.*,b.*,c.* FROM tbl_paket a
			JOIN tbl_fasilitas b ON a.id_paket=b.paket_id
			JOIN tbl_arsitektur c ON a.id_paket=c.paket_id
			WHERE a.id_paket='$id'")->getRowArray();
    }
    public function deletePaket($id)
    {
        return $this->db->query("DELETE tbl_paket,tbl_arsitektur,tbl_fasilitas 
        FROM tbl_paket
        INNER JOIN tbl_arsitektur ON tbl_arsitektur.paket_id=tbl_paket.id_paket
        INNER JOIN tbl_fasilitas ON tbl_fasilitas.paket_id=tbl_paket.id_paket
        WHERE tbl_paket.id_paket='$id' ");
    }
}
