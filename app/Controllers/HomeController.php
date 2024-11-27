<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class HomeController extends BaseController
{
    public function home()
    {
        return view('index');
    }

    public function index()
    {
        return redirect()->to($this->request->getLocale());
    }
}
