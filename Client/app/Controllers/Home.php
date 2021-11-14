<?php

namespace App\Controllers;

use App\Models\PerusahaanModel;
use App\Controllers\BaseController;

class Home extends BaseController
{
    public function __construct()
    {
        $this->perusahaan = new PerusahaanModel();
    }
    public function index()
    {
        $data['company'] = $this->perusahaan->getCompany();
        $data['title'] = 'Home';
        return view('pages/index', $data);
    }
}
