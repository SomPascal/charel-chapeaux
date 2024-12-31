<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class DraftController extends BaseController
{
    protected $helpers = ['mailjet'];
    
    public function index()
    {
        dd(session()->get(ACCEPTED_COOKIE));

        return view('Mail/contact_form', [
            'visitor' => [
                'name' => 'John Doe',
                'phone' => '656 06 35 55'
            ]
        ]);
    }
}
