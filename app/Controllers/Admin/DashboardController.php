<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function home()
    {
        $adminModel = model(AdminModel::class);
        $admins = $adminModel->asObject()->getAdmins();

        return view('Admin/home', [
            'admins' => $admins
        ]);
    }

    public function stats()
    {
        return 'stats';
    }

    public function manage()
    {
        return 'manage';
    }

    public function index()
    {
        return redirect()->route('admin.home', [$this->request->getLocale()]);
    }

    public function content()
    {
        return view('Admin/content');
    }

    function show(int $admin_id): string
    {
        return 'admin id ' . $admin_id;
    }

    public function items(): string
    {
        return 'items';
    }
}
