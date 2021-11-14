<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $db      = \Config\Database::connect();
        $client = $db->table('tbl_client');
        $order = $db->table('tbl_order');
        $orderTerjual = $db->table('tbl_order');
        $orderTerjual->where('status_order', 4);
        $paket = $db->table('tbl_paket');
        $data = [
            'total_client' => $client->countAllResults(),
            'total_order' => $order->countAllResults(),
            'total_paket' => $paket->countAllResults(),
            'total_terjual' => $orderTerjual->countAllResults(),
            'title' => 'Dashboard'
        ];
        return view('dashboard/index', $data);
    }
}
