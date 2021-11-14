<?php

namespace App\Controllers\Portofolio;

use App\Controllers\BaseController;
use App\Models\GambarPortofolioModel;

class IndexController extends BaseController
{
    public function __construct()
    {
        $this->gambar = new GambarPortofolioModel();
    }
    public function index()
    {
        $data['title'] = 'Portofolio';
        $data['gambar'] = $this->gambar->getImage();
        return view('pages/portofolio', $data);
    }
}
