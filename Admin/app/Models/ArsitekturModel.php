<?php

namespace App\Models;

use CodeIgniter\Model;

class ArsitekturModel extends Model
{
    protected $table                = 'tbl_arsitektur';
    protected $primaryKey           = 'id_arsitektur';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['ket_arsitektur','paket_id'];
}
