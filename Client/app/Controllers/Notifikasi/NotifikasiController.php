<?php

namespace App\Controllers\Notifikasi;

use App\Models\OrderModel;
use App\Controllers\BaseController;

class NotifikasiController extends BaseController
{
    public function __construct()
    {
        $this->order = new OrderModel();
    }
    public function index()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Harap masuk terlebih dahulu!');
            return redirect()->to('/signin');
        }
        $id = $this->request->getGet('id_client');
        $data = $this->order->getNotifikasi($id);
            
        echo json_encode($data);
    }
}
