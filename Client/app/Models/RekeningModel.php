<?php

namespace App\Models;

use CodeIgniter\Model;

class RekeningModel extends Model
{
    protected $table                = 'tbl_rekening';
    protected $primaryKey           = 'id_rekening';
    protected $useAutoIncrement     = true;
    protected $returnType           = 'array';
    protected $protectFields        = true;
    protected $allowedFields        = [];

    public function getRekening()
    {
        return $this->db->query("SELECT * FROM tbl_rekening")->getResultArray();
    }
}
