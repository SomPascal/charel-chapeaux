<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;

class CookieController extends BaseController
{
    public function accept(): Response
    {
        return $this->response->setBody('ok');
    }
}
