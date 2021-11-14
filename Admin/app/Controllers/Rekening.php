<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Rekeningmodel;

class Rekening extends BaseController
{
    public function __construct()
    {
        $this->rekening = new RekeningModel();
    }
    public function index()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $data = [
            'rekening' => $this->rekening->getRekening(),
            'title' => 'Rekening'
        ];
        return view('rekening/index', $data);
    }
    public function create()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $data = [
            'rekening' => $this->rekening->getRekening(),
            'title' => 'Tambah Rekening'
        ];
        return view('rekening/add', $data);
    }
    public function save()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        if (!$this->validate([
            'nama_bank' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Bank Tidak boleh kosong'
                ]
            ],
            'nomor_rekening' => [
                'rules' => 'required|numeric|is_unique[tbl_rekening.nomor_rekening]',
                'errors' => [
                    'required' => 'Nomor Tidak boleh kosong',
                    'numeric' => 'Nomor Rekening harus menggunakan angka',
                    'is_unique' => 'Nomor Rekening sudah ada di database, silahkan menggunakan nomor rekening yang lain'
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
        $this->rekening->insert([
            'nama_bank' => $this->request->getPost('nama_bank'),
            'nomor_rekening' => $this->request->getPost('nomor_rekening'),
            'nama_pemilik' => $this->request->getPost('nama_pemilik'),
            'gambar_rekening' => $fileName,
        ]);
        $dataFile->move('uploads/rekening/', $fileName);
        session()->setFlashdata('success', 'Rekening Berhasil diupload');
        return redirect()->to('/rekening');
    }
    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $data = array(
            'rek' => $this->rekening->getRekeningId(base64_decode($id)),
            'title' => 'Edit Rekening'
        );
        if (empty($data['rek'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        return view("rekening/edit", $data);
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
            'nomor_rekening' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Nomor Tidak boleh kosong',
                    'numeric' => 'Nomor Rekening harus menggunakan angka'
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
        $update = $this->rekening->update($postData['id_rekening'], [
              'nama_bank' => $postData['nama_bank'],
              'nomor_rekening' => $postData['nomor_rekening'],
              'nama_pemilik' => $postData['nama_pemilik'],
              'gambar_rekening' => $fileName,
           ]);
        if ($update == true) {
            @unlink('uploads/rekening/'.$postData['gambar_rekening']);
            $dataFile->move('uploads/rekening/', $fileName);
            session()->setFlashdata('success', 'Updated Successfully!');
            return redirect()->to('/rekening');
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
        $postData = $this->rekening->getRekeningId(base64_decode($id));
        @unlink('uploads/rekening/'.$postData['gambar_rekening']);
        $this->rekening->deleteRekening(base64_decode($id));
        session()->setFlashdata('hapus', 'Rekening berhasil dihapus');
        return redirect()->to('/rekening');
    }
}
