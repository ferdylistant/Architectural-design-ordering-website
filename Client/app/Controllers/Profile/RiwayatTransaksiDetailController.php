<?php

namespace App\Controllers\Profile;

use App\Models\PembayaranModel;
use App\Models\OrderDetailModel;
use App\Controllers\BaseController;

class RiwayatTransaksiDetailController extends BaseController
{
    public function __construct()
    {
        $this->transaksi = new PembayaranModel();
        $this->order_detail = new OrderDetailModel();
    }
    public function index()
    {
        $idClient = $this->request->getGet('c');
        if (session()->get('id_client') !== base64_decode($idClient)) {
            session()->setFlashdata('error', 'Harap masuk terlebih dahulu!');
            return redirect()->to('/signin');
        }
        $id = $this->request->getGet('o');
        $data['detail'] = $this->order_detail->getOrderDetail(base64_decode($id));
        $data['transaksi'] = $this->transaksi->getPembayaran(base64_decode($id));
        $data['title'] = 'Detail Transaksi';
        $data['idOrder'] = base64_decode($id);
        $data['idClient'] = base64_decode($idClient);
        return view('Pages/detail_transaksi', $data);
    }
}
