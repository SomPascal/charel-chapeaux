<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class DraftController extends BaseController
{
    public function index()
    {
        dd(session()->get(CONTACT_SENT));

        dd(preg_replace(
            pattern: '/\s{1,}/', 
            replacement: '',
            subject: '656 06 35 55'
        ));

        dd(model(AdminModel::class)->amount());
    }
}
