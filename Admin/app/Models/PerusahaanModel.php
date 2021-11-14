<?php

namespace App\Models;

use CodeIgniter\Model;

class PerusahaanModel extends Model
{
    protected $table                = 'tbl_perusahaan';
    protected $primaryKey           = 'id_perusahaan';
    protected $returnType           = 'array';
    protected $allowedFields        = ['nama_perusahaan','email_perusahaan','alamat_perusahaan','telp_perusahaan','deskripsi','logo','wa','ig'];

    public function getCompany()
    {
        return $this->db->query("SELECT * FROM tbl_perusahaan")->getResultArray();
    }
    public function getCompanyId($id)
    {
        return $this->db->query("SELECT * FROM tbl_perusahaan WHERE id_perusahaan='$id' ")->getRowArray();
    }
    public function deleteCompany($id)
    {
        return $this->db->query("DELETE FROM tbl_perusahaan WHERE id_perusahaan='$id' ");
    }
}
