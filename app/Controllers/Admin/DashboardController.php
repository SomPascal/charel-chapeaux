<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\CategoryModel;
use App\Models\ItemModel;
use App\Models\RedirectionModel;
use App\Models\TestimonialModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class DashboardController extends BaseController
{
    public function home()
    {
        $adminModel = model(AdminModel::class);
        $admins = $adminModel->asObject()->getAdmins();

        return view('Admin/home', [
            'admins' => $admins,
            'redirections' => model(RedirectionModel::class)->todayRedirections()
        ]);
    }

    public function items(): string
    {
        $item_model = model(ItemModel::class);

        return view('Admin/items', [
            'num_of_items' => $item_model->num_of_items(),
            'items' => $item_model->get_items()->paginate(24),
            'items_pager' => $item_model->pager,
            'categories' => model(CategoryModel::class)->asObject()->getAll(),
            'redirections' => model(RedirectionModel::class)
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
        $testimonials = model(TestimonialModel::class)->asObject()->getAll();

        return view('Admin/content', [
            'testimonials' => $testimonials
        ]);
    }

    function show(int $admin_id): string
    {
        return 'admin id ' . $admin_id;
    }

}
