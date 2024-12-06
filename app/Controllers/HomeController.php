<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContactModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

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
