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

        $items = $item_model->getHomeItems();
        $header_items = array_slice($items, 0, 4);
        $remaining_items = array_slice($items, 4);

        return view('index', [
            'header_items' => $header_items,
            'items' => $remaining_items,
            'redirections' => model(RedirectionModel::class)->todayRedirections(),
            'testimonials' => model(TestimonialModel::class)->asObject()->getAll()
        ]);
    }

    public function index()
    {
        return redirect()->to($this->request->getLocale());
    }
}
