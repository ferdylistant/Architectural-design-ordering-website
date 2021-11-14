<?php

namespace App\Controllers\Payment;

use App\Models\Client;
use App\Models\OrderModel;
use App\Models\RekeningModel;
use App\Models\PembayaranModel;
use App\Models\PerusahaanModel;
use App\Models\OrderDetailModel;
use App\Models\PaketProdukModel;
use App\Controllers\BaseController;

class IndexController extends BaseController
{
    public function __construct()
    {
        $this->cart = cart();
        $this->package = new PaketProdukModel();
        $this->client = new Client();
        $this->order = new OrderModel();
        $this->order_detail = new OrderDetailModel();
        $this->rekening = new RekeningModel();
        $this->perusahaan = new PerusahaanModel();
        $this->pembayaran = new PembayaranModel();
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
        $id_client = session()->get('id_client');

        date_default_timezone_set('Asia/Jakarta');
        //Deadline Pembayaran
        $tgl_order = date("Y-m-d H:i:s");
        $start_date = date($tgl_order);
        $expires = strtotime('+1 days', strtotime($tgl_order));
        $deadline_pembayaran=date('Y-m-d H:i:s', $expires);
        //status_order
        $status_order = '0';
        $order = array(
            'client_id'	=> $id_client,
            'status_order'	=> $status_order,
            'tgl_order' 		=> $tgl_order,
            'update_status' 		=> $tgl_order,
            'deadline_pembayaran'	=> $deadline_pembayaran,
            'total_order'	=> $this->request->getPost('total_order')
        );
        $this->order->insert($order);
        $idOrder = $this->order->getInsertID();
        $orderId = base64_encode($idOrder);
        //Lanjut ke Order Detail
        $pemesanan = $this->cart->contents();
        foreach ($pemesanan as $cart) {
            $id_paket = $cart['id'];
            $qty = $cart['qty'];
            $subtotal= $cart['subtotal'];
            $this->order_detail->insert(array(
                'order_id' 		=> $idOrder,
                'client_id'	=> $id_client,
                'paket_id'		=> $id_paket,
                'jumlah_order'	=> $qty,
                'sub_harga'		=> $subtotal
            ));
        }
        $this->cart->destroy();
        return redirect()->to(base_url('/package/payment_confirm?o='.$orderId.'&p='.sha1($id_paket).'&c='.base64_encode($id_client)));
    }
    public function payment()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Harap masuk terlebih dahulu!');
            return redirect()->to('/signin');
        }
        $orderId = $this->request->getGet('o');
        $idClient= $this->request->getGet('c');
        if (empty($idClient)) {
            session()->setFlashdata('error', 'Harap masuk terlebih dahulu!');
            return redirect()->to('/signin');
        }
        $id = base64_decode($orderId);
        $idC = base64_decode($idClient);
        $data['title'] = 'Konfirmasi Pembayaran';
        $data['idClient'] = base64_decode($idClient);
        $data['perusahaan'] = $this->perusahaan->getCompany();
        $data['rekening'] = $this->rekening->getRekening();
        $data['transaksi'] = $this->pembayaran->getPembayaran($id);
        $data['order_detail'] = $this->order_detail->getOrderDetail($id);
        $data['idOrder'] = $id;
        $data['idClient'] = $idC;
        return view('Pages/confirm_payment', $data);
    }
    public function payment_action()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Harap masuk terlebih dahulu!');
            return redirect()->to('/signin');
        }
        
        if (!$this->validate([
            'atas_nama' => [
                'rules' => 'required|string',
                'errors' => [
                    'required' => 'Nama pemilik harus diisi',
                    'string' => 'Nama pemilik harus huruf'
                ]
            ],
            'no_rek' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Nomor rekening Harus diisi',
                    'numeric'   => 'Nomor rekening harus angka'
                ]
            ],
            'bank' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama bank harus diisi'
                ]
            ],
            'id_rekening' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Rekening tujuan Harus diisi',
                ]
            ],
            'tgl_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal pembayaran harus diisi',
                ]
            ],
            'nominal' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Nominal harus diisi',
                    'numeric'   => 'Nominal harus angka'
                ]
            ],
            'bukti' => [
                'rules' => 'uploaded[bukti]|mime_in[bukti,image/jpg,image/jpeg,image/gif,image/png]|max_size[bukti,5048]',
                'errors' => [
                    'uploaded' => 'Harus Ada File yang diupload',
                    'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                    'max_size' => 'Ukuran File Maksimal 5 MB'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $hari_ini= date("Y-m-d");
            $order_id = base64_decode($this->request->getPost('id_order'));
            $client_id = base64_decode($this->request->getPost('id_client'));
            // return var_dump($hari_ini);
            $totpesan = $this->order->getOrder($order_id);
            foreach ($totpesan as $tot) {
            }
            // return var_dump($tot);
            //pembayaran DP minimal 70%
            $minimal = $tot['total_order'] * 0.7;
            $nominal = $this->request->getPost('nominal');
            $rekening_id = $this->request->getPost('id_rekening');
            $tgl_pembayaran = $this->request->getPost('tgl_pembayaran');
            // return var_dump($tgl_pembayaran);
            $transaksi = $this->pembayaran->getPembayaran($order_id);

            //Logika Pelunasan
            if (empty($transaksi)) {
                //Pembayaran awal/bukan pelunasan
                if ($nominal > $tot['total_order']) {
                    session()->setFlashdata("error", "Pembayaran salah, cek kembali total pemesanan Anda!");
                    return redirect()->back()->withInput();
                } elseif ($rekening_id == "") {
                    session()->setFlashdata("error", "Silahkan pilih rekening tujuan!");
                    return redirect()->back()->withInput();
                } elseif ($nominal < $minimal) {
                    session()->setFlashdata("error", "Jika ingin pembayaran DP, minimal 70% dari total harga pemesanan!");
                    return redirect()->back()->withInput();
                } elseif ($tgl_pembayaran > $tot['deadline_pembayaran'] || $tgl_pembayaran < $hari_ini) {
                    session()->setFlashdata("error", "Lakukan pembayaran sesuai batas tanggal yang ditentukan!");
                    return redirect()->back()->withInput();
                } elseif ($nominal >= $minimal && $nominal < $tot['total_order']) { //Pembbayaran DP
                    $dataFile = $this->request->getFile('bukti');
                    // return var_dump($dataFile);

                    $fileName = $dataFile->getRandomName();

                    $this->pembayaran->insert([
                        'order_id' => $order_id,
                        'client_id' => $client_id,
                        'rekening_id' => $rekening_id,
                        'atas_nama' => $this->request->getPost('atas_nama'),
                        'no_rek' => $this->request->getPost('no_rek'),
                        'bank' => $this->request->getPost('bank'),
                        'nominal' => $nominal,
                        'status_bayar' => '1',
                        'tgl_pembayaran' => $tgl_pembayaran,
                        'tgl_konfirmasi' => date("Y-m-d H:i:s"),
                        'bukti' => $fileName,
                    ]);
                    $dataFile->move('uploads/pembayaran/', $fileName);

                    $tgl_order_masuk=date("Y-m-d H:i:s");
                    $start_date = date($tgl_order_masuk);
                    $expires = strtotime('+2 days', strtotime($tgl_order_masuk));
                    $arr = [
                        'deadline_pembayaran' => date('Y-m-d H:i:s', $expires),
                        'update_status'    => date("Y-m-d H:i:s"),
                        'status_order'  => '1'
                    ];
                    $this->order->set($arr, false);
                    $this->order->where('id_order', $order_id);
                    $this->order->update();
                    session()->setFlashdata('success', 'Pembayaran DP berhasil, silahkan periksa kembali riwayat transaksi dan notifikasi anda untuk memastikan proses pembuatan desain.');
                    return redirect()->to(base_url('/profile?c='.base64_encode(session()->get('id_client')).'&em='.base64_encode(session()->get('email_client'))));
                } elseif ($nominal == $tot['total_order']) { //Pembayaran Lunas
                    $dataFile = $this->request->getFile('bukti');
                    $fileName = $dataFile->getRandomName();

                    $this->pembayaran->insert([
                        'order_id' => $order_id,
                        'client_id' => $client_id,
                        'rekening_id' => $rekening_id,
                        'atas_nama' => $this->request->getPost('atas_nama'),
                        'no_rek' => $this->request->getPost('no_rek'),
                        'bank' => $this->request->getPost('bank'),
                        'nominal' => $nominal,
                        'status_bayar' => '2',
                        'tgl_pembayaran' => $tgl_pembayaran,
                        'tgl_konfirmasi' => date("Y-m-d H:i:s"),
                        'bukti' => $fileName,
                    ]);
                    $dataFile->move('uploads/pembayaran/', $fileName);
                    $arr = [
                        'update_status'    => date("Y-m-d H:i:s"),
                        'deadline_pembayaran' => null,
                        'status_order'  => '2'
                    ];
                    $this->order->set($arr, false);
                    $this->order->where('id_order', $order_id);
                    $this->order->update();
                    session()->setFlashdata('success', 'Pembayaran lunas, silahkan periksa kembali riwayat transaksi dan notifikasi anda untuk memastikan proses pembuatan desain.');
                    return redirect()->to(base_url('/profile?c='.base64_encode(session()->get('id_client')).'&em='.base64_encode(session()->get('email_client'))));
                }
            } else {
                $lunas = $tot['total_order'] - $transaksi[0]['nominal'];
                //Pelunasan
                if ($nominal > $lunas) {
                    session()->setFlashdata("error", "Pembayaran salah, cek kembali total yang harus Anda bayar!");
                    return redirect()->back()->withInput();
                } elseif ($rekening_id == "") {
                    session()->setFlashdata("error", "Silahkan pilih rekening tujuan!");
                    return redirect()->back()->withInput();
                } elseif ($nominal < $lunas) {
                    session()->setFlashdata("error", "Pembayaran salah, cek kembali total yang harus Anda bayar!");
                    return redirect()->back()->withInput();
                } elseif ($tgl_pembayaran > $tot['deadline_pembayaran'] || $tgl_pembayaran < $hari_ini) {
                    session()->setFlashdata("error", "Lakukan pembayaran sesuai batas tanggal yang ditentukan!");
                    return redirect()->back()->withInput();
                } elseif ($nominal == $lunas) { //Pelunasan
                    $dataFile = $this->request->getFile('bukti');
                    // return var_dump($dataFile);

                    $fileName = $dataFile->getRandomName();

                    $this->pembayaran->insert([
                        'order_id' => $order_id,
                        'client_id' => $client_id,
                        'rekening_id' => $rekening_id,
                        'atas_nama' => $this->request->getPost('atas_nama'),
                        'no_rek' => $this->request->getPost('no_rek'),
                        'bank' => $this->request->getPost('bank'),
                        'nominal' => $nominal,
                        'status_bayar' => '2',
                        'tgl_pembayaran' => $tgl_pembayaran,
                        'tgl_konfirmasi' => date("Y-m-d H:i:s"),
                        'bukti' => $fileName,
                    ]);
                    $dataFile->move('uploads/pembayaran/', $fileName);

                    $arr = [
                        'deadline_pembayaran' => null,
                        'update_status'    => date("Y-m-d H:i:s"),
                        'status_order'  => '2'
                    ];
                    $this->order->set($arr, false);
                    $this->order->where('id_order', $order_id);
                    $this->order->update();
                    session()->setFlashdata('success', 'Pelunasan berhasil, silahkan periksa kembali riwayat transaksi dan notifikasi anda untuk memastikan proses pembuatan desain.');
                    return redirect()->to(base_url('/profile?c='.base64_encode(session()->get('id_client')).'&em='.base64_encode(session()->get('email_client'))));
                }
            }
        }
    }
}
