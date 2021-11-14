<?php

namespace App\Controllers\Profile;

use App\Models\Client;
use App\Controllers\BaseController;

class EditController extends BaseController
{
	public function __construct()
	{
		$this->client = new Client();
	}
	public function index()
	{
		if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Harap masuk terlebih dahulu!');
            return redirect()->to('/signin');
        }
		if (!$this->validate([
            'telp_client' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Telepon harus diisi',
                    'numeric' => 'Telepon harus angka',
                ]
            ],
            'alamat_client' => [
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'matches' => '{field} harus diisi',
                    'min_length' => '{field} Minimal 3 Karakter',
                ]
            ],
            'nama_client' => [
                'rules' => 'required|min_length[4]|max_length[100]',
                'errors' => [
                    'required' => 'Nama Harus diisi',
                    'min_length' => 'Nama minimal 3 Karakter',
                    'max_length' => 'Nama maksimal 100 Karakter',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
		$id = $this->request->getPost('id_client');
		$email = $this->request->getPost('email_client');
		$nama = $this->request->getPost('nama_client');
		$telp = $this->request->getPost('telp_client');
		$alamat = $this->request->getPost('alamat_client');
		$dataFile = $this->request->getFile('userfile');
		// return var_dump($email);
		if (empty($dataFile)) {
			$up = [
				'nama_client' => $nama,
				'telp_client' => $telp,
				'alamat_client' => $alamat,
			];
			$this->client->set($up);
			$this->client->where('id_client',base64_decode($id));
			$this->client->update();
			
			session()->setFlashdata('success', 'Berhasil memperbarui data diri');
			return redirect()->to(base_url('/profile?c='.$id.'&em='.base64_encode($email)));
		}
		$dataFile = $this->request->getFile('userfile');
        $fileName = $dataFile->getRandomName();
		$this->client->update(base64_decode($id),[
			'nama_client' => $nama,
			'telp_client' => $telp,
			'alamat_client' => $alamat,
			'pict_client' => $fileName
		]);
		@unlink('uploads/profile/'.$this->request->getPost('pict_client'));
		$dataFile->move('uploads/profile/', $fileName);
		session()->setFlashdata('success', 'Berhasil memperbarui data diri');
		return redirect()->to(base_url('/profile?c='.$id.'&em='.$email));

	}
	public function changePassword()
	{
		if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Harap masuk terlebih dahulu!');
            return redirect()->to('/signin');
        }
		$id = $this->request->getPost('id_client');
		$email = $this->request->getPost('email_client');
		$currentPassword = $this->request->getPost('current_password');
		$dataUser = $this->client->where([
            'email_client' => base64_decode($email),
        ])->first();
		// return var_dump($dataUser);
		if (password_verify($currentPassword, $dataUser['password_client'])) {
			if (!$this->validate([
            'new_password' => [
                'rules' => 'required|min_length[4]|max_length[50]',
                'errors' => [
                    'required' => 'Password Harus diisi',
                    'min_length' => 'Password Minimal 4 Karakter',
                    'max_length' => 'Password Maksimal 50 Karakter',
                ]
            ],
            'confirm_password' => [
                'rules' => 'matches[new_password]',
                'errors' => [
                    'matches' => 'Konfirmasi password tidak sesuai dengan password baru.',
                ]
            ],
			])) {
				session()->setFlashdata('error', $this->validator->listErrors());
				return redirect()->back()->withInput();
			}
			$this->client->update(base64_decode($id),[
			'password_client' => password_hash($this->request->getPost('new_password'), PASSWORD_BCRYPT)
			]);
			session()->setFlashdata('success','Berhasil mengubah password.');
			return redirect()->to(base_url('/profile?c='.$id.'&em='.$email));
		}
		else{
			session()->setFlashdata('error','Password anda salah!');
			return redirect()->back()->withInput();
		}
	}
}
