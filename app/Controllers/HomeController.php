<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContactModel;
use CodeIgniter\HTTP\ResponseInterface;

class HomeController extends BaseController
{
    public function home()
    {
        $contacts = model(ContactModel::class)->get();

        return view('index', [
            'contacts' => $contacts
        ]);
    }

    public function index()
    {
        return redirect()->to($this->request->getLocale());
    }
}
