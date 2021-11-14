<?php

namespace App\Controllers\Auth\Register;

use App\Controllers\BaseController;

class IndexController extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/');
        }
        $data['title'] = 'Sign-Up';
        return view('Pages/register', $data);
    }
}
