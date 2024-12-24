<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class DraftController extends BaseController
{
    public function index()
    {
        dd(classes([
            'd-flex',
            'justify-content-center',
            'align-items-center',
            'flex-column',
            'opacity-75' => false
        ]));

        dd(model(AdminModel::class)->amount());
    }
}
