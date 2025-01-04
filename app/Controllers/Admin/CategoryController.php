<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Psr\Log\LogLevel;

class CategoryController extends BaseController
{
    use ResponseTrait;

    public function create(): Response
    {
        if (! $this->validate('set_category')) {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }

        $data = $this->validator->getValidated();

        $throttlerConfig = config('Config\Throttler')->setCategory;
        $throttler = Services::throttler();
        
        if (! $throttler->check(
            key: md5('user:' . user_id()),
            capacity: $throttlerConfig['capacity'],
            seconds: $throttlerConfig['seconds']
        )) {
            return $this->failTooManyRequests()
            ->setHeader(X_RETRY_AFTER, $throttler->getTokenTime());
        }

        try {
            $category_id = model(CategoryModel::class)->insert(['name' => $data['category_name']]);
        } catch (\Throwable $e) {
            log_message(
                LogLevel::ERROR,
                'Could not create category due to: ' . $e->getMessage()
            );
            
            return $this->failServerError();
        }

        session()->setTempdata(
            'success',
            'Votre catégorie a été créé avec succès.',
            5*SECOND
        );

        return $this->respondCreated([
            'status' => Response::HTTP_CREATED,
            'name' => $data['category_name'],
            'id' => $category_id
        ]);
    }

    public function delete(): Response
    {
        $category_code = (int) $this->request->getJsonVar('category_code');

        try {
            if (! model(CategoryModel::class)->add_in_trash($category_code)) 
            {
                return $this->failServerError();
            }
        } catch (\Throwable) {
            return $this->failServerError();
        }

        return $this->respondUpdated();
    }

    public function update(): Response
    {
        if (! $this->validate('set_category')) {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }

        $category_code = $this->request->getJsonVar('category_code', filter: FILTER_SANITIZE_NUMBER_INT);
        $data = $this->validator->getValidated();

        $throttlerConfig = config('Config\Throttler')->setCategory;
        $throttler = Services::throttler();
        
        if (! $throttler->check(
            key: md5('user:' . user_id()),
            capacity: $throttlerConfig['capacity'],
            seconds: $throttlerConfig['seconds']
        )) {
            return $this->failTooManyRequests()
            ->setHeader(X_RETRY_AFTER, $throttler->getTokenTime());
        }

        try {
            model(CategoryModel::class)->update(id: $category_code, row: [
                'name' => $data['category_name']
            ]);
        } catch (\Throwable $e) {
            log_message(
                LogLevel::ERROR,
                'Could not create category due to: ' . $e->getMessage()
            );
            
            return $this->failServerError();
        }

        session()->setTempdata(
            'success',
            'Votre catégorie a modifée créé avec succès.',
            5*SECOND
        );

        return $this->respondUpdated([
            'status' => Response::HTTP_OK
        ]);
    }
}
