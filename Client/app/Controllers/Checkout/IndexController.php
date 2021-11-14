<?php

namespace App\Controllers\Checkout;

use App\Models\Client;
use App\Models\RekeningModel;
use App\Models\PaketProdukModel;
use App\Controllers\BaseController;

class IndexController extends BaseController
{
    public function __construct()
    {
        $this->cart = cart();
        $this->client = new Client();
        $this->product = new PaketProdukModel();
        $this->rekening = new RekeningModel();
    }
    public function index()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Harap masuk terlebih dahulu!');
            return redirect()->to('/signin');
        }
        if (empty($this->cart->contents())) {
            session()->setFlashdata('error', 'Harap lakukan pembelian terlebih dahulu!');
            return redirect()->to('/package');
        }
        // membuat variabel untuk menampung total keranjang belanja
        $data['items'] = $this->cart->contents();
        // menampilkan total belanja dari semua pembelian
        $data['total'] = $this->cart->total();
        $data['rekening'] = $this->rekening->getRekening();
        $data['title'] = 'Checkout';
        return view('Pages/checkout', $data);
    }
}
