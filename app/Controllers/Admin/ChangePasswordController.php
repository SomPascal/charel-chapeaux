<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use Config\Services;
use Psr\Log\LogLevel;

class ChangePasswordController extends BaseController
{
    use ResponseTrait;

    public function changePswd(): string
    {
        return view('Admin/Form/change-password');
    }

    function attemptChangePswd(): Response 
    {
        $throttler = Services::throttler();
        $throttlerConfig = config('Config\Throttler');
        
        if (! $throttler->check(
            key: md5(sprintf('login-%s', $this->request->getIPAddress())), 
            capacity: $throttlerConfig->changePassword['capacity'], 
            seconds: $throttlerConfig->changePassword['seconds']
            )
        ) {
            return $this->failTooManyRequests()
            ->setHeader(X_RETRY_AFTER, $throttler->getTokenTime());
        }

        if (! $this->validate('changePassword'))
        {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }
        
        $data = $this->validator->getValidated();
        $user = auth()->user();
        
        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();
        
        
        $result = $authenticator->check([
            'email' => $user->email,
            'password' => $data['current-password']
        ]);        

        if (! $result->isOK()) {
            return $this->failValidationErrors([
                'current-password' => 'Mot de passe incorrect'
            ]);
        }

        try {
            if (! model(AdminModel::class)->changePassword(user_id(), $data['new-password'])) 
            {
                $this->logger->log(
                    LogLevel::ERROR,
                    'Could not change password due to : Unkown reason'
                );
    
                return $this->failServerError();
            }
        } catch (\Throwable $e) {
            $this->logger->log(
                LogLevel::ERROR,
                'Could not change password due to : ' . $e->getMessage()
            );

            return $this->failServerError();
        }

        session()->setTempdata(
            'success', 
            'Vous venez de modifier votre mot de passe',
            ttl: 30*SECOND
        );
        
        return $this->respondUpdated()
        ->setHeader(X_REDIRECT_TO, url_to('admin.index'));
    }
}
