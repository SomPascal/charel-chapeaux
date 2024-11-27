<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Controllers\RegisterController as ShieldRegisterController;

class RegisterController extends ShieldRegisterController
{
    public function register()
    {
        return 'register';
    }

    public function attemptRegister(): Response
    {
        return $this->response->setBody('attempt');
    }
}
