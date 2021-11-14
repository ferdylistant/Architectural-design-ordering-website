<?php

namespace App\Models;

use CodeIgniter\Model;

class PortfolioModel extends Model
{
	protected $table                = 'tbl_portofolio';
	protected $primaryKey           = 'id_portofolio';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['kategori_portofolio_id','nama_portofolio','keterangan'];

}
