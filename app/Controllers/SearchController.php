<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Psr\Log\LogLevel;

class SearchController extends BaseController
{
    use ResponseTrait;

    protected function fetch(string $term): array
    {
        $results = cache()->get('search.' . md5($term));

        if ($results == null) {
            $results = model(ItemModel::class)->search(term: $term);
            cache()->save('search.' . md5($term), $results, 5*MINUTE);
        }

        return $results;
    }

    public function search(): Response
    {
        $term = $this->request->getGet(index: 'term');
        $category = (int) $this->request->getGet(index: 'category', filter: FILTER_SANITIZE_NUMBER_INT);

        try {
            $results = $this->fetch($term);
        } catch (\Throwable $e) {
            log_message(
                level: LogLevel::ERROR,
                message: sprintf(
                    'Could not find items due to: %s, \n %s',
                    $e->getMessage(), 
                    $e->getTraceAsString()
                ),
                context: ['username' => auth()->user()->username]
            );

            $results = model(ItemModel::class)->orderByPopularity()->search(term: $term);
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
