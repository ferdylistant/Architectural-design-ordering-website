<?php

namespace App\Models;

use CodeIgniter\Model;

class GambarPortofolioModel extends Model
{
    protected $table                = 'tbl_gambar_portofolio';
    protected $primaryKey           = 'id_gambar_portofolio';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['portofolio_id','gambar_portofolio'];

    public function getImage()
    {
        return $this->db->query("SELECT a.*,b.*,c.* FROM tbl_gambar_portofolio a
		JOIN tbl_portofolio b ON a.portofolio_id=b.id_portofolio
		JOIN tbl_kategori_portofolio c ON b.kategori_portofolio_id=c.id_kategori_portofolio
		GROUP BY a.id_gambar_portofolio
		ORDER BY b.id_portofolio ASC")->getResultArray();
    }
}
