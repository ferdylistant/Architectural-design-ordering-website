<?php

namespace App\Controllers;

use App\Models\PortfolioModel;
use App\Controllers\BaseController;
use App\Models\GambarPortofolioModel;
use App\Models\CategoryPortfolioModel;

class PortfolioController extends BaseController
{
    public function __construct()
    {
        $this->portofolio = new PortfolioModel();
        $this->kategori = new CategoryPortfolioModel();
        $this->gambar = new GambarPortofolioModel();
    }
    public function index()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        
        $data['title'] = 'Portofolio';
        $data['pict'] = $this->gambar->getImage();
        return view("portofolio/index", $data);
    }
    public function add()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $data['title'] = 'Add Portfolio';
        $data['kategori'] = $this->kategori->getCatPortfolio();
        return view('portofolio/add', $data);
    }
    public function save()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $postData = $this->request->getPost();
        if (!$this->validate([
            'userfile' => [
                'rules' => 'uploaded[userfile]|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png]|max_size[userfile,5048]',
                'errors' => [
                    'uploaded' => 'Harus Ada File yang diupload',
                    'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                    'max_size' => 'Ukuran File Maksimal 5 MB'
                ]
 
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $dataFile = $this->request->getFiles();
        $this->portofolio->insert([
            'nama_portofolio' => $postData['nama_portofolio'],
            'kategori_portofolio_id' => $postData['id_kategori_portofolio'],
            'keterangan' => $postData['keterangan'],
        ]);
        $id = $this->portofolio->getInsertID();
        foreach ($dataFile['userfile'] as $fileName) {
            $file = $fileName->getRandomName();
            $this->gambar->insert([
            'portofolio_id' => $id,
            'gambar_portofolio' => $file
            ]);
            $fileName->move('uploads/portofolio/', $file);
        }
        session()->setFlashdata('success', 'Portofolio berhasil diupload');
        return redirect()->to(base_url('/portfolio'));
    }
}
