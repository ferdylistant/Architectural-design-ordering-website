<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Controllers\BaseController;

class ProfileController extends BaseController
{
    public function __construct()
    {
        $this->admin = new AdminModel();
    }
    public function index()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $data['title'] = 'Profile Admin';
		$data['admin'] = $this->admin->getAdmin();
        return view('profil/index', $data);
    }
    public function updateProfile()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
        $id = $this->request->getPost('id_admin');
        $update = $this->admin->update($id, [
            'nama_admin' => $this->request->getPost('nama_admin'),
            'telp_admin' => $this->request->getPost('telp_admin'),
            'email_admin' => $this->request->getPost('email_admin')
        ]);
        
        if ($update == true) {
            session()->setFlashdata('success', 'Profil berhasil diperbarui!');

            return redirect()->to(base_url('/profile'));
        } else {
            session()->setFlashdata('error', 'Profil gagal diperbarui!');

            return redirect()->to(base_url('/profile'));
        }
    }
	public function changePass()
	{
		if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Silahkan masuk terlebih dahulu!');

            return redirect()->to('/login');
        }
		$data['title'] = 'Change Password';
		return view('ganti_password/index',$data);
	}
}
