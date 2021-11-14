<?php

namespace App\Controllers\Contact;

use App\Models\PerusahaanModel;
use App\Controllers\BaseController;

class IndexController extends BaseController
{
    public function __construct()
    {
        $this->contact = new PerusahaanModel();
    }
    public function index()
    {
        $data['contact'] = $this->contact->getCompany();
        $data['title'] = 'Contact';
        return view('pages/contact', $data);
    }
}
