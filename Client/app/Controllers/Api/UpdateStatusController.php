<?php

namespace App\Controllers\Api;

use App\Models\OrderModel;
use App\Controllers\BaseController;

class UpdateStatusController extends BaseController
{
    public function __construct()
    {
        $this->builder = new OrderModel();
    }
    public function index()
    {
        $id = $this->request->getPost('id_client');
        $idO = $this->request->getPost('id_order');
        $arr = [
            'deadline_pembayaran' => null,
            'update_status'    => date("Y-m-d H:i:s"),
            'status_order' => '6'
        ];
        $this->builder->set($arr, false);
        $this->builder->where('client_id', $id);
        $this->builder->where('id_order', $idO);
        $this->builder->update();
        echo json_encode($id);
    }
}
