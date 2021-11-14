<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryPortfolioModel extends Model
{
	protected $table                = 'tbl_kategori_portofolio';
	protected $primaryKey           = 'id_kategori_portofolio';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['nama_kategori_portofolio'];

	public function getCatPortfolio()
	{
		return $this->db->query("SELECT * FROM tbl_kategori_portofolio")->getResultArray();
	}
	public function getCatPortfolioId($id)
	{
		return $this->db->query("SELECT * FROM tbl_kategori_portofolio WHERE id_kategori_portofolio='$id'")->getRowArray();
	}
}
