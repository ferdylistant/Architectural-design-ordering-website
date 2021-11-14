<?php

namespace App\Controllers;

use App\Models\PembayaranModel;
use App\Controllers\BaseController;

class PembayaranController extends BaseController
{
    public function __construct()
    {
        $this->pay = new PembayaranModel();
    }
    public function index()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $data['pembayaran'] = $this->pay->getPembayaran();
        $data['title']	= 'Payment Client';
        return view('pembayaran/index', $data);
    }
    public function detail()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $idO = $this->request->getGet('o');
        $idC = $this->request->getGet('c');
        // return var_dump($idO);
        $data['detail'] = $this->pay->getPembayaranId(base64_decode($idO),base64_decode($idC));
        $data['title'] = 'Payment Detail';
        return view('pembayaran/detail',$data);
    }
}
