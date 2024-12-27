<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Models\UserModel;
use Psr\Log\LogLevel;

class ChangeController extends BaseController
{
    use ResponseTrait;

    public function role(): Response
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

        session()->setTempdata(
            'success',
            'Votre modification de role a été éffectué avec succès', 
            10*SECOND
        );
        return $this->respondUpdated();
    }

    public function ban(): Response
    {
        if (! $this->validate('ban_admin')) {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }

        $data = $this->validator->getValidated();
        $admin = model(UserModel::class)->findById($data['admin_id']);

        if ($admin == null) {
            return $this->failServerError();
        }

        if ($data['ban'] == 'on') {
            $admin->ban();
        }
        else {
            $admin->unBan();
        }

        session()->setTempdata(
            'success',
            'Cette modification a été éffectué avec succès !',
            5*SECOND
        );

        return $this->respondUpdated();
    }
}
