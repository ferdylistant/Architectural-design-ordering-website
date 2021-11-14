<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Client;

class LoginController extends BaseController
{
    public function index()
    {
        $client = new Client();
        $email = $this->request->getVar('email_client');
        $password = $this->request->getVar('password_client');
        $dataUser = $client->where([
            'email_client' => $email,
        ])->first();
        if (!$this->validate([
            'email_client' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'E-mail Harus diisi',
                    'valid_email' => 'E-mail tidak sesuai format'
                ]
            ],
            'password_client' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password Harus diisi',
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            if ($dataUser) {
                if ($dataUser['is_active'] == 0) {
                    session()->setFlashdata('error', 'Akun anda belum aktif, silahkan lakukan aktivasi akun di email yang telah Anda daftarkan');
                    return redirect()->back();
                }
                // return var_dump(password_verify($password, $dataUser['password_client']));
                if (password_verify($password, $dataUser['password_client'])) {
                    session()->set([
                    'id_client' => $dataUser['id_client'],
                    'nama_client' => $dataUser['nama_client'],
                    'alamat_client' => $dataUser['alamat_client'],
                    'email_client' => $dataUser['email_client'],
                    'telp_client' => $dataUser['telp_client'],
                    'logged_in' => true
                ]);
                    $this->cart = cart();
                    if (!empty($this->cart->contents())) {
                        return redirect()->to('/package/cart');
                    } else {
                        return redirect()->to('/profile?c='.base64_encode(session()->get('id_client')).'&em='.base64_encode(session()->get('email_client')));
                    }
                } else {
                    session()->setFlashdata('error', 'Email atau Password Anda salah');
                    return redirect()->back()->withInput();
                }
            } else {
                session()->setFlashdata('error', 'Anda belum daftar');
                return redirect()->back()->withInput();
            }
        }
    }
}
