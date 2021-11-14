<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class IndexController extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->back();
        }
        $data['title'] = 'Sign-in';
        return view('Pages/login', $data);
    }
}
