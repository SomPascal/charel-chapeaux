<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class SearchController extends BaseController
{
    use ResponseTrait;

    public function search(): Response
    {
        $term = $this->request->getGet(index: 'term', filter: FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $category = (int) $this->request->getGet(index: 'category', filter: FILTER_SANITIZE_NUMBER_INT);
        $cache = Services::cache();

        try {
            $results = model(ItemModel::class)->search(term: $term, category: $category);
        } catch (\Throwable) {
            return $this->failServerError();
        }

        $new_results = [];

        if ($category > 0) 
        {
            foreach ($results as $result)
            {
                if ($result->category_code == $category) {
                    $new_results[] = $result;
                }
            }

            $results = $new_results;
        }

        return $this->response->setJSON($results);
    }
}
