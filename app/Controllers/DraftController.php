<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DraftController extends BaseController
{
    public function index()
    {
        return password_hash('*Hello2024', config('Config\Auth')->hashAlgorithm);
    }
}
