<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\CategoryModel;
use App\Models\ContactFormModel;
use App\Models\DescriptionModel;
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
        $contact_form_model = model(ContactFormModel::class);
        $admins = $adminModel->asObject()->getAdmins();

        return view('Admin/home', [
            'admins' => $admins,
            'redirections' => model(RedirectionModel::class)->todayRedirections(),
            'form_submits' => $contact_form_model->getAll()->asObject()->paginate(10),
            'form_submits_pager' => $contact_form_model->pager,
        ]);
    }

    public function items(): string
    {
        $item_model = model(ItemModel::class);

        return view('Admin/items', [
            'num_of_items' => $item_model->num_of_items(),
            'items' => $item_model->get_items()->orderBy('item.created_at', 'DESC')->paginate(16),

            'popular_items' => $item_model->mostPopular(),
            'unpopular_items' => $item_model->lessPopular(),

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
            'testimonials' => $testimonials,
            'descriptions' => model(DescriptionModel::class)->asObject()->getAll()
        ]);
    }

    function show(int $admin_id): string
    {
        return 'admin id ' . $admin_id;
    }

}
