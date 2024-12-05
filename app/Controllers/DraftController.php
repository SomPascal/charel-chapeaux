<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class DraftController extends BaseController
{
    public function index()
    {
        dd(model(AdminModel::class)->amount());
    }
}
