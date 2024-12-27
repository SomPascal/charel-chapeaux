<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContactModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Psr\Log\LogLevel;

class ContactController extends BaseController
{
    use ResponseTrait;

    public function change(): Response
    {
        if (! $this->validate('change_contact')) {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }

        $data = $this->validator->getValidated();

        if (get_contact($data['name']) == $data['content']) {
            return $this->failServerError();
        }

        $contactModel = model(ContactModel::class);
        try {
            $contactModel->setContact(
                name: $data['name'],
                content: $data['content']
            );
        } catch (\Throwable $e) {
            log_message(
                LogLevel::ERROR,
                'Could not update a contact info due to: ' . $e->getMessage()
            );
            return $this->failServerError();
        }

        $cache = Services::cache();
        $cache->delete('contacts');
        $cache->save('contacts', $contactModel->get(), 5*MINUTE);

        session()->setTempdata(
            'success',
            sprintf('Vous avez modifié votre "%s" avec succès', $data['name']),
            5*SECOND
        );

        return $this->respondUpdated();
    }
}
