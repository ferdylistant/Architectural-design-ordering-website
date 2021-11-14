<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DaftarClientModel;

class DaftarClient extends BaseController
{
    public function __construct()
    {
        $this->client = new DaftarClientModel();
    }
    public function index()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $data['daftarClient']	= $this->client->getDaftarClient();
        $data['title'] = 'Daftar-Client';
        return view('daftar_client/index', $data);
    }
    public function detail()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');
            return redirect()->to('/login');
        }
        $id = $this->request->getGet('c');
        $data = [
            'detail' => $this->client->detailClient(base64_decode($id)),
            'order' => $this->client->orderDetail(base64_decode($id)),
            'title' => 'Detail Client'
        ];
        // return var_dump($data['order']);
        return view('daftar_client/detail', $data);
    }
}
