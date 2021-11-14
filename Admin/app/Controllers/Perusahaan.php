<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PerusahaanModel;

class Perusahaan extends BaseController
{
    public function __construct()
    {
        $this->perusahaan = new PerusahaanModel();
    }
    public function index()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $data['company'] = $this->perusahaan->getCompany();
        $data['title'] = 'Company';
        // return var_dump($data);
        return view('tentang_kami/index', $data);
    }
    public function create()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $data = [
            'perusahaan' => $this->perusahaan->getCompany(),
            'title' => 'Tambah perusahaan'
        ];
        return view('tentang_kami/add', $data);
    }
    public function save()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $postData = $this->request->getPost();
        if (!$this->validate([
            'nama_perusahaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Perusahaan tidak boleh kosong'
                ]
            ],
            'email_perusahaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email Perusahaan tidak boleh kosong',
                ]
            ],
            'telp_perusahaan' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Telepon Perusahaan tidak boleh kosong',
                    'numeric' => 'Telepon Perusahaan hanya menggunakan angka'
                ]
            ],
            'alamat_perusahaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Perusahaan tidak boleh kosong',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi Perusahaan tidak boleh kosong',
                ]
            ],
            'wa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Url Whatsapp perusahaan tidak boleh kosong',
                ]
            ],
            'ig' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Url Instagram perusahaan tidak boleh kosong',
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
        $this->perusahaan->insert([
            'nama_perusahaan' => $postData['nama_perusahaan'],
              'email_perusahaan' => $postData['email_perusahaan'],
              'telp_perusahaan' => $postData['telp_perusahaan'],
              'alamat_perusahaan' => $postData['alamat_perusahaan'],
              'deskripsi' => $postData['deskripsi'],
              'wa' => $postData['wa'],
              'ig' => $postData['ig'],
              'logo' => $fileName,
        ]);
        $dataFile->move('uploads/perusahaan/', $fileName);
        session()->setFlashdata('success', 'perusahaan Berhasil diupload');
        return redirect()->to('/company');
    }
    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $data = array(
            'company' => $this->perusahaan->getCompanyId(base64_decode($id)),
            'title' => 'Edit perusahaan'
        );
        if (empty($data['company'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        return view("tentang_kami/edit", $data);
    }

    public function update()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }

        if (!$this->validate([
            'nama_perusahaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Perusahaan tidak boleh kosong'
                ]
            ],
            'email_perusahaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email Perusahaan tidak boleh kosong',
                ]
            ],
            'telp_perusahaan' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Telepon Perusahaan tidak boleh kosong',
                    'numeric' => 'Telepon Perusahaan hanya menggunakan angka'
                ]
            ],
            'alamat_perusahaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Perusahaan tidak boleh kosong',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi Perusahaan tidak boleh kosong',
                ]
            ],
            'wa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Url Whatsapp perusahaan tidak boleh kosong',
                ]
            ],
            'ig' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Url Instagram perusahaan tidak boleh kosong',
                ]
            ],
            'userfile' => [
                'rules' => 'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png]|max_size[userfile,2048]',
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
        $postData = $this->request->getPost();
        $dataFile = $this->request->getFile('userfile');
        if (empty($dataFile)) {
            $update = $this->perusahaan->update($postData['id_perusahaan'], [
                'nama_perusahaan' => $postData['nama_perusahaan'],
                'email_perusahaan' => $postData['email_perusahaan'],
                'telp_perusahaan' => $postData['telp_perusahaan'],
                'alamat_perusahaan' => $postData['alamat_perusahaan'],
                'deskripsi' => $postData['deskripsi'],
                'wa' => $postData['wa'],
                'ig' => $postData['ig'],
            ]);
            return var_dump($update);
            if ($update == true) {
                session()->setFlashdata('success', 'Updated Successfully!');
                return redirect()->to('/company');
            } else {
                session()->setFlashdata('error', 'Updated fail!');
                return redirect()->back()->withInput();
            }
        }
        $dataFile = $this->request->getFile('userfile');
        $fileName = $dataFile->getRandomName();
        $update = $this->perusahaan->update($postData['id_perusahaan'], [
                'nama_perusahaan' => $postData['nama_perusahaan'],
                'email_perusahaan' => $postData['email_perusahaan'],
                'telp_perusahaan' => $postData['telp_perusahaan'],
                'alamat_perusahaan' => $postData['alamat_perusahaan'],
                'deskripsi' => $postData['deskripsi'],
                'wa' => $postData['wa'],
                'ig' => $postData['ig'],
                'logo' => $fileName,
            ]);
        if ($update == true) {
            @unlink('uploads/perusahaan/'.$postData['logo']);
            $dataFile->move('uploads/perusahaan/', $fileName);
            session()->setFlashdata('success', 'Updated Successfully!');
            return redirect()->to('/company');
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
        $postData = $this->perusahaan->getCompanyId(base64_decode($id));
        @unlink('uploads/perusahaan/'.$postData['logo']);
        $this->perusahaan->deleteCompany(base64_decode($id));
        
        session()->setFlashdata('hapus', 'Perusahaan berhasil dihapus');
        return redirect()->to('/company');
    }
}
