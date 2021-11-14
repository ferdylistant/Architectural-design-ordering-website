<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->admin = new AdminModel();
    }
    public function index()
    {
        if (session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda sudah masuk!');

            return redirect()->route('/');
        }

        $data['title'] = 'Login';
        return view('login/login', $data);
    }
    public function login()
    {
        $email = $this->request->getVar('email_admin');
        $password = $this->request->getVar('password_admin');
        $dataUser = $this->admin->where([
            'email_admin' => $email,
        ])->first();
        $session_set_value = session()->get('logged_in');
        if (isset($session_set_value['remember_me']) && $session_set_value['remember_me'] == "1") {
            return redirect()->route('/');
        } else {
            if (!$this->validate([
                'email_admin' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} Harus diisi',
                        'valid_email' => '{field} tidak sesuai format email'
                    ]
                ],
                'password_admin' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus diisi',
                    ]
                ]
            ])) {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            } else {
                if ($dataUser) {
                    if (password_verify($password, $dataUser['password_admin'])) {
                        session()->set([
                            'id_admin' => $dataUser['id_admin'],
                            'email_admin' => $dataUser['email_admin'],
                            'nama_admin' => $dataUser['nama_admin'],
                            'telp_admin' => $dataUser['telp_admin'],
                            'ip_address' => $this->request->getIPAddress(),
                            'logged_in' => true
                        ]);
                        $this->admin->update($dataUser['id_admin'], ['ip_address' => $this->request->getIPAddress()]);
                        return redirect()->route('/');
                    } else {
                        session()->setFlashdata('error', 'Email & Password Salah');
                        return redirect()->back()->withInput();
                    }
                } else {
                    session()->setFlashdata('error', 'Email & Password Salah');
                    return redirect()->back()->withInput();
                }
            }
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
