<?php

namespace App\Controllers\Package;

use App\Models\PaketProdukModel;
use App\Controllers\BaseController;

class IndexController extends BaseController
{
    public function __construct()
    {
        $this->paket = new PaketProdukModel();
    }
    public function index()
    {
        $data['paket'] = $this->paket->getPaket();
        $data['title'] = 'Package';
        return view('pages/package', $data);
    }
}
