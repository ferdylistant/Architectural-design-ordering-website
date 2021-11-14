<?php

namespace App\Controllers\Package;

use Wildanfuady\WFcart\WFcart;
use App\Models\PaketProdukModel;
use App\Controllers\BaseController;

class CartController extends BaseController
{
    public function __construct()
    {
 
        // memanggil product model
        $this->product = new PaketProdukModel();
        // membuat variabel untuk menampung class WFcart
        $this->cart = cart();
        // memanggil form helper
        helper('form');
    }
 
    public function index()
    {
        // return var_dump($this->cart->total());
        // membuat variabel untuk menampung total keranjang belanja
        $data['items'] = $this->cart->contents();
        // menampilkan total belanja dari semua pembelian
        $data['total'] = $this->cart->total();
        $data['title'] = 'Cart';
        // menampilkan halaman view cart
        return view('Pages/cart', $data);
    }
 
    public function beli($id = null)
    {
        // cari product berdasarkan id
        $product = $this->product->getPaketId(base64_decode($id));
       
        // cek data product
        if ($product != null) { // jika product tidak kosong
 
            // buat variabel array untuk menampung data product
            $item = [
                'id'        => $product['id_paket'],
                'name'      => $product['nama_paket'],
                'price'     => $product['harga'],
                'qty'  => 1
            ];
            // tambahkan product ke dalam cart
            $this->cart->insert($item);
            
            // tampilkan nama product yang ditambahkan
            $product = $item['name'];
            // success flashdata
            session()->setFlashdata('success', "Berhasil memasukan {$product} ke karanjang belanja");
        } else {
            // error flashdata
            session()->setFlashdata('error', "Tidak dapat menemukan data product");
        }
        return redirect()->to('/package');
    }
 
    // function untuk update cart berdasarkan id dan quantity
    public function update()
    {
        $data['rowid'] = $this->request->getPost('rowid');
        $data['qty'] = $this->request->getPost('qty');
        $data['price'] = $this->request->getPost('price');
        
        // update cart
        $this->cart->update($data);
        $data = $data['price'] * $data['qty'];
        // $data['total'] = $this->cart->total();
        echo json_encode(rupiah($data));
    }
 
    // function untuk menghapus cart berdasarkan id
    public function remove($rowid = null)
    {
        $this->cart->remove($rowid);
        // success flashdata
        session()->setFlashdata('success', "Berhasil menghapus paket dari keranjang belanja");
        
        return redirect()->to('/package/cart');
    }
    // function untuk menghapus cart checkout berdasarkan id
    public function remove_checkout($rowid = null)
    {
        $this->cart->remove($rowid);
        
        return redirect()->to('/package/checkout');
    }
    public function destroy()
    {
        $this->cart->destroy();
        session()->setFlashdata('success', 'Berhasil mengosongkan paket dari keranjang belanja');
        return redirect()->to('/package');
    }
}
