<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Controllers\BaseController;

class OrderController extends BaseController
{
    public function __construct()
    {
        $this->order = new OrderModel();
    }
    public function index()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $data['order'] = $this->order->getOrder();
        $data['title']	= 'Order Client';
        return view('order/index', $data);
    }
}
