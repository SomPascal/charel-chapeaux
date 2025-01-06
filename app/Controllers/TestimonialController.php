<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TestimonialModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use Psr\Log\LogLevel;

class TestimonialController extends BaseController
{
    use ResponseTrait;

    public function create(): string
    {
        return view('Admin/Create/testimonial');
    }

    public function store(): Response
    {
        if (! $this->validate('store_testimonail')) {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }

        $data = $this->validator->getValidated();

        try {
            model(TestimonialModel::class)->insert([
                'id' => random_int(1111, 9999),
                'name' => $data['autor'],
                'content' => $data['testimonial'],
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ]);
        } catch (\Throwable $e) {
            return $this->failServerError();
        }

        session()->setTempdata(
            'success', 
            'Votre témoignage a été ajouté avec succès',
            5*SECOND
        );

        return $this->respondCreated()
        ->setHeader(X_REDIRECT_TO, url_to('admin.content'));
    }

    public function delete(): Response
    {
        $testimonial_id = $this->request->getJsonVar('id', filter: FILTER_SANITIZE_NUMBER_INT);

        try {
            model(TestimonialModel::class)->update(id: $testimonial_id, row: [
                'deleted_at' => Time::now()
            ]);
        } catch (\Throwable) {
            return $this->failServerError();
        }

        session()->setTempdata(
            'success', 
            'Ce témoignages a été supprimé avec succès.',
            5*SECOND
        );

        return $this->respondCreated();
    }

    public function modify(int $testimonial_id): string
    {
        $testimonial = model(TestimonialModel::class)->getById($testimonial_id);

        if ($testimonial == null) {
            throw new PageNotFoundException("Error Processing Request");
        }

        return view('Admin/Create/modify-testimonial', [
            'testimonial' => $testimonial
        ]);
    }

    public function update(): Response
    {
        if (! $this->validate('update_testimonial')) {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }

        $data = $this->validator->getValidated();

        try {
            if (! model(TestimonialModel::class)->update(
                id: $data['id'], 
                row: [
                    'name' => $data['autor'],
                    'content' => $data['testimonial'],
                    'updated_at' => Time::now()
                ]
            )) 
            {
                return $this->failServerError();
            }
        } catch (\Throwable $e) {
            log_message(
                LogLevel::ALERT,
                sprintf(
                    'Could not update a testimonial due to: %s\n%s',
                    $e->getMessage(),
                    $e->getTraceAsString()
                )
            );

            return $this->failServerError($e->getMessage());
        }

        session()->setFlashdata(
            'success',
            'Ce Témoignage a été modifié avec succès',
            5*SECOND
        );

        return $this->respondUpdated()->setHeader(
            X_REDIRECT_TO,
            url_to('admin.content')
        );
    }
}
