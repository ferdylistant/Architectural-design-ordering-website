<?php

namespace App\Controllers\AboutUs;

use App\Models\PerusahaanModel;
use App\Controllers\BaseController;

class IndexController extends BaseController
{
    public function __construct()
    {
        $this->perusahaan = new PerusahaanModel();
    }
    public function index()
    {
        $data['title'] = 'About Us';
        $data['company'] = $this->perusahaan->getCompany();
        return view('pages/about', $data);
    }
}
