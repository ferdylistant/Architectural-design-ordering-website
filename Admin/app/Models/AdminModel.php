<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table                = 'tbl_admin';
    protected $primaryKey           = 'id_admin';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['nama_admin','email_admin','telp_admin','ip_address'];

    public function getAdmin()
    {
        return $this->db->query("SELECT * FROM tbl_admin")->getRowArray();
    }
}
