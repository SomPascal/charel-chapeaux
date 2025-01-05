<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DescriptionModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Psr\Log\LogLevel;

class DescriptionController extends BaseController
{
    use ResponseTrait;

    protected $helpers = ['description'];

    public function modify($name)
    {
        $description = model(DescriptionModel::class)->getByName($name);
        
        if ($description == []) {
            throw new PageNotFoundException("Error Processing Request");
        }
        
        return view('Admin/create/modify-description', [
            'description' => $description
        ]);

    }

    public function update(): Response
    {
        if (! $this->validate('update_description')) {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }

        $throttler = Services::throttler();
        $config = config('Config\Throttler')->update_description;

        if (! $throttler->check(
            key: 'content.description.update',
            capacity: $config['capacity'],
            seconds: $config['seconds']
        ))
        {
            return $this->failTooManyRequests()
            ->setHeader(X_RETRY_AFTER, $throttler->getTokenTime());
        }

        $description_model = model(DescriptionModel::class);

        $data = $this->validator->getValidated();
        $data['desc-name'] = $this->request->getJsonVar('desc-name');

        $descriptions = $description_model->asObject()->getAll();

        if (empty($data['desc-name'])) {
            return $this->failValidationErrors([
                'name' => 'Une erreur est survenue. Rechargez la page.'
            ]);
        }
        else if (get_desc($data['desc-name'], $descriptions) == null)
        {
            return $this->failValidationErrors([
                'name' => 'Nous ne reconnaissons pas cette description. Veuillez recharger la page.'
            ]);
        }
        else if (get_desc($data['desc-name'], $descriptions) == $data['desc-content']) {
            return $this->failValidationErrors([
                'desc-content' => 'Veuillez changer cette description, vous utilisez déjà celle-ci.'
            ]);
        }


        try {
            $description_model->where('name', $data['desc-name'])
            ->update(row: [
                'content' => $data['desc-content']
            ]);
        } catch (\Throwable $e) {
            log_message(
                LogLevel::ERROR,
                sprintf(
                    "Unable to update description, due to: %s\n%s",
                    $e->getMessage(),
                    $e->getTraceAsString()
                ),
                ['name' => $data['desc-name'], 'user_email' => auth()->user()->email]
            );

            return $this->failServerError();
        }

        session()->setTempdata(
            'success',
            'Cette description a été modifié avec succès',
            5*SECOND
        );

        return $this->respondUpdated()->setHeader(
            X_REDIRECT_TO, url_to('admin.content')
        );
    }
}
