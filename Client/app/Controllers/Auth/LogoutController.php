<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class LogoutController extends BaseController
{
    public function index()
    {
        session()->destroy();
        return redirect()->to('/signin');
    }
}
