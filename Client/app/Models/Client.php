<?php

namespace App\Models;

use CodeIgniter\Model;

class Client extends Model
{
    protected $table                = 'tbl_client';
    protected $primaryKey           = 'id_client';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['nama_client','email_client','telp_client','alamat_client','password_client','is_active','pict_client'];
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
	protected $updatedField         = 'updated_at';
    protected $createdField         = 'created_at';
    
    
    public function getClientId($id)
    {
        return $this->db->query("SELECT * FROM tbl_client WHERE id_client='$id'")->getRowArray();
    }
}
