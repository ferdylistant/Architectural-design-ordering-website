<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderDetailModel;
use App\Controllers\BaseController;

class NotaController extends BaseController
{
    public function __construct()
    {
        $this->order = new OrderModel();
        $this->nota = new OrderDetailModel();
    }
    public function index()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $idOrder = base64_decode($this->request->getGet('o'));
        $idClient = base64_decode($this->request->getGet('c'));
        $data['nota'] = $this->nota->getOrderDetail($idOrder);
        $data['tpesan'] = $this->nota->getOrderDetail($idOrder);
        $data['title']	= 'Detail Order';
        return view('nota/index', $data);
    }
    public function status()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        if ($this->request->getPost('status_order') == '') {
            session()->setFlashdata('error', 'Anda belum memilih status!');
            return redirect()->back()->withInput();
        }
        $id = base64_decode($this->request->getPost('id_order'));
        $idClient = base64_decode($this->request->getPost('id_client'));
        $statusVal = $this->request->getPost('status_order');
        if ($statusVal == '5') {
            $this->order->update($id, ['ket_tolak' => $this->request->getPost('ket_tolak')]);
        }
        $arr = [
            'status_order' => $statusVal,
            'update_status'    => date("Y-m-d H:i:s")
        ];
        $this->order->set($arr, false);
        $this->order->where('id_order', $id);
        $this->order->where('client_id', $idClient);
        $this->order->update();
        session()->setFlashdata('success', 'Status pemesanan berhasil diubah!');
        return redirect()->to(base_url('/order/detail?o='.base64_encode($id).'&c='.base64_encode($idClient)));
    }
}
