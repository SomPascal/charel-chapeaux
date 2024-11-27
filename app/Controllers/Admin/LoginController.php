<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Controllers\LoginController as ShieldLoginController;

class LoginController extends ShieldLoginController
{
    public function login()
    {
        return view('Admin/Form/login');
    }

    public function attemptLogin(): Response
    {
        return $this->response->setBody('hey');
    }
}
