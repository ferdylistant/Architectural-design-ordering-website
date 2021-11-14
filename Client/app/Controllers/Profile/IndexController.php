<?php

namespace App\Controllers\Profile;

use App\Models\Client;
use App\Models\OrderModel;
use App\Controllers\BaseController;

class IndexController extends BaseController
{
    public function __construct()
    {
        $this->client = new Client();
        $this->riwayat = new OrderModel();
    }
    public function index()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Harap masuk terlebih dahulu!');
            return redirect()->to('/signin');
        }
        $id = base64_decode($this->request->getGet('c'));
        $data['client'] = $this->client->getClientId($id);
        $data['riwayat'] = $this->riwayat->getRiwayatTransaksi($id);
        $data['title'] = 'Profile';
        $data['idClient'] = $id;
        return view('Pages/profile', $data);
    }
}
