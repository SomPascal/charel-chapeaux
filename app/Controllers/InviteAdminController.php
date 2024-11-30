<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InvitationLinkModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Psr\Log\LogLevel;

class InviteAdminController extends BaseController
{
    use ResponseTrait;

    public function get(): Response
    {
        $throttler = Services::throttler();
        $config = config('Config\Throttler');

        if (! $this->validate('invite_admin'))
        {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }

        if (! $throttler->check(
            key: md5(sprintf('invite-%s', $this->request->getIPAddress())),
            capacity: $config->inviteAdmin['capacity'],
            seconds: $config->inviteAdmin['seconds']
        ))
        {
            return $this->failTooManyRequests()
            ->setHeader(X_RETRY_AFTER, $throttler->getTokenTime());
        }

        try {
            $link_id = model(InvitationLinkModel::class)
            ->createLink($this->validator->getValidated()['role']);

            if ($link_id == null)
            {
                $this->logger->log(
                    LogLevel::ERROR,
                    'Could not create invite link due to unknow reason'
                );

                return $this->failServerError();
            }
        } catch (\Throwable $e) {
            $this->logger->log(
                LogLevel::ERROR,
                'Could not create invite link due to ' . $e->getMessage()
            );

            return $this->failServerError($e->getMessage());
        }

        return $this->respondCreated([
            'status' => Response::HTTP_CREATED,
            'url' => url_to('invite.use', $link_id)
        ]);
    }

    public function use(string $link_id)
    {
        return 'use link ' . $link_id;
    }
}
