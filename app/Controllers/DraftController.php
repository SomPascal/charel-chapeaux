<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class DraftController extends BaseController
{
    public function index()
    {
        dd(attrs([
            'id="hello"' => 1+7 == 8,
            'id="hi"' => 1*7 == 8,
            'id="good morning"' => 1-7 == 8,
        ]));

        dd(model(AdminModel::class)->amount());
    }
}
