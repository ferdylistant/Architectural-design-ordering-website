<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryPortfolioModel;

class CategoryPortfolioController extends BaseController
{
	public function __construct()
	{
		$this->kategori = new CategoryPortfolioModel();
	}
	public function index()
	{
		if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
		$data['kategori'] = $this->kategori->getCatPortfolio();
		$data['title'] = 'Category Portfolio';
		return view('kategori_portofolio/index',$data);
	}
	public function add()
	{
		if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
		$data['title'] = 'Add Category Portfolio';
		return view('kategori_portofolio/add',$data);
	}
	public function save()
	{
		if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
		$input = $this->request->getPost('nama_kategori_portofolio');
		// return var_dump($input);
		$this->kategori->insert(['nama_kategori_portofolio' => $input]);
		session()->setFlashdata('success', 'Berhasil menambahkan data kategori portofolio');
		return redirect()->to(base_url('/portfolio/category'));
	}
	public function edit($id)
	{
		if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
		$data = [
			'title' => 'Edit Category Portfolio',
			'edit' => $this->kategori->getCatPortfolioId(base64_decode($id))
		];
		return view('kategori_portofolio/edit',$data);
	}
	public function update()
	{
		if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
		$id = $this->request->getPost('id_kategori_portofolio');
		$update = $this->request->getPost('nama_kategori_portofolio');
		$this->kategori->update($id,['nama_kategori_portofolio' => $update]);
		session()->setFlashdata('success','Berhasil update data kategori portofolio');
		return redirect()->to(base_url('/portfolio/category'));
	}
	public function delete($id)
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $this->kategori->delete(['id_kategori_portofolio' => base64_decode($id)]);
        session()->setFlashdata('success', 'Berhasil menghapus data kategori portofolio');
        return redirect()->to(base_url('/portfolio/category'));
    }
}
