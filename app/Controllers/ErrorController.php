<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ErrorController extends BaseController
{
    public function pageNotFound()
    {
        $view_name = 'page-not-found';

        if (auth()->loggedIn() && auth()->user()->hasPermission('admin.access'))
        {
            $view_name = 'Admin/page-not-found';
        }

        return view($view_name);
    }
}
