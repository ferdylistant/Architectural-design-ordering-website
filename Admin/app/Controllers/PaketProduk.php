<?php

namespace App\Controllers;

use App\Models\FasilitasModel;
use App\Models\ArsitekturModel;
use App\Models\PaketProdukModel;
use App\Controllers\BaseController;

class PaketProduk extends BaseController
{
    public function __construct()
    {
        $this->paket = new PaketProdukModel();
        $this->arsitektur = new ArsitekturModel();
        $this->fasilitas = new FasilitasModel();
    }
    public function index()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $data['paket'] = $this->paket->getPaket();
        $data['title'] = 'Paket';
        return view('paket/index', $data);
    }
    public function create()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $data = [
            'paket' => $this->paket->getPaket(),
            'title' => 'Tambah Paket'
        ];
        return view('paket/add', $data);
    }
    public function save()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $postData = $this->request->getPost();
        if (!$this->validate([
            'nama_paket' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama paket tidak boleh kosong'
                ]
            ],
            'tipe' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tipe tidak boleh kosong',
                ]
            ],
            'ukuran_tanah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Ukuran tanah tidak boleh kosong',
                    'numeric' => 'Ukuran tanah hanya dapat diinput dengan angka',
                ]
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan tidak boleh kosong',
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga paket tidak boleh kosong',
                    'numeric' => 'Harga paket hanya dapat diinput dengan angka',
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $this->paket->insert([
            'nama_paket' => $postData['nama_paket'],
            'tipe' => $postData['tipe'],
            'ukuran_tanah' => $postData['ukuran_tanah'],
            'satuan' => $postData['satuan'],
            'harga' => $postData['harga']
        ]);
        $paketID = $this->paket->getInsertID();
        $arrFasilitas = $postData['nama_fasilitas'];
        $this->fasilitas->insert([
            'nama_fasilitas'=>"<ul><li>".implode("</li><li>", $arrFasilitas). "</li></ul>",
            'paket_id' => $paketID
        ]);
        // if (is_array($arrFasilitas) && !empty($arrFasilitas)) {
        //     foreach ($arrFasilitas as $lan) {
        //         $this->fasilitas->insert([
        //             'nama_fasilitas' => $lan,
        //             'paket_id' => $paketID
        //         ]);
        //     }
        // }
        $arrArsitektur = $postData['ket_arsitektur'];
        $this->arsitektur->insert([
            'ket_arsitektur'=>"<ul><li>".implode("</li><li>", $arrArsitektur). "</li></ul>",
            'paket_id' => $paketID
        ]);
        session()->setFlashdata('success', 'Data paket berhasil ditambahkan');
        return redirect()->to('/paket');
    }
    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $data = array(
            'paket' => $this->paket->getPaketId(base64_decode($id)),
            'title' => 'Edit Paket'
        );
        if (empty($data['paket'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        return view("paket/edit", $data);
    }

    public function update()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $postData = $this->request->getPost();

        if (!$this->validate([
            'nama_bank' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Bank Tidak boleh kosong'
                ]
            ],
            'nomor_paket' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Nomor Tidak boleh kosong',
                    'numeric' => 'Nomor paket harus menggunakan angka'
                ]
            ],
            'nama_pemilik' => [
                'rules' => 'required|string',
                'errors' => [
                    'required' => 'Nama Pemilik Tidak boleh kosong',
                    'string' => 'Nama Pemilik harus menggunakan huruf'
                ]
            ],
            'userfile' => [
                'rules' => 'uploaded[userfile]|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png]|max_size[userfile,2048]',
                'errors' => [
                    'uploaded' => 'Harus Ada File yang diupload',
                    'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                    'max_size' => 'Ukuran File Maksimal 2 MB'
                ]
 
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $dataFile = $this->request->getFile('userfile');
        $fileName = $dataFile->getRandomName();
        $update = $this->paket->update($postData['id_paket'], [
              'nama_bank' => $postData['nama_bank'],
              'nomor_paket' => $postData['nomor_paket'],
              'nama_pemilik' => $postData['nama_pemilik'],
              'gambar_paket' => $fileName,
           ]);
        if ($update == true) {
            @unlink('uploads/paket/'.$postData['gambar_paket']);
            $dataFile->move('uploads/paket/', $fileName);
            session()->setFlashdata('success', 'Updated Successfully!');
            return redirect()->to('/paket');
        } else {
            session()->setFlashdata('error', 'Updated fail!');
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $this->paket->deletePaket(base64_decode($id));
        session()->setFlashdata('hapus', 'Data paket berhasil dihapus');
        return redirect()->to('/paket');
    }
}
