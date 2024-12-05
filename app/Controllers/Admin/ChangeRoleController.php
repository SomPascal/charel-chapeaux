<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LogLevel;

class ChangeRoleController extends BaseController
{
    use ResponseTrait;

    public function change(): Response
    {
        if (! $this->validate('change_role')) {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }

        $data = $this->validator->getValidated();

        try {
            model(AdminModel::class)->setGroup(
                user_id: $data['admin_id'],
                group: $data['role']
            );
        } catch (\Throwable $e) {
            log_message(
                LogLevel::ERROR,
                'Could not set admin role due to: ' . $e->getMessage()
            );

            return $this->failServerError(
                $e->getMessage()
            );
        }

        return $this->respondUpdated();
    }
}
