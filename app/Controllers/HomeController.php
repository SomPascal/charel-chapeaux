<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContactModel;
use App\Models\ItemModel;
use App\Models\RedirectionModel;
use App\Models\TestimonialModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class HomeController extends BaseController
{
    public function home()
    {
        $item_model = model(ItemModel::class);

        return view('index', [
            'items' => $item_model->get_items()->unhided()->asObject()->findAll(),
            'redirections' => model(RedirectionModel::class)->todayRedirections(),
            'testimonials' => model(TestimonialModel::class)->asObject()->getAll()
        ]);
    }

    public function index()
    {
        return redirect()->to($this->request->getLocale());
    }
}
