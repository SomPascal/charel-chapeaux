<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;

class ItemController extends BaseController
{
    public function show()
    {
        return view('item');
    }

    public function like(): Response
    {
        return $this->response->setBody('liked');
    }

    public function unlike(): Response
    {
        return $this->response->setBody('unliked');
    }
}
