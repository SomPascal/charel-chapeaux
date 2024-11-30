<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Psr\Log\LogLevel;

class ChangeUsernameController extends BaseController
{
    use ResponseTrait;

    public function changeUsername(): string
    {
        return view('Admin/Form/change-username');
    }

    public function attemptChangeUsername(): Response
    {
        $throttler = Services::throttler();
        $throttlerConfig = config('Config\Throttler');
        
        if (! $throttler->check(
            key: md5(sprintf('login-%s', $this->request->getIPAddress())), 
            capacity: $throttlerConfig->changeUsername['capacity'], 
            seconds: $throttlerConfig->changeUsername['seconds']
            )
        ) {
            return $this->failTooManyRequests()
            ->setHeader(X_RETRY_AFTER, $throttler->getTokenTime());
        }

        if (! $this->validate('changeUsername'))
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
            'password' => $data['password']
        ]);        

        if (! $result->isOK()) {
            return $this->failValidationErrors([
                'password' => 'Mot de passe incorrect'
            ]);
        }

        try {
            if (! model(AdminModel::class)->changeUsername(user_id(), $data['username'])) 
            {
                $this->logger->log(
                    LogLevel::ERROR,
                    'Could not change username due to : Unkown reason'
                );
    
                return $this->failServerError();
            }
        } catch (\Throwable $e) {
            $this->logger->log(
                LogLevel::ERROR,
                'Could not change username due to : ' . $e->getMessage()
            );

            return $this->failServerError();
        }

        session()->setTempdata(
            'success', 
            'Vous venez de modifier votre nom d\'utilisateur.',
            ttl: 30*SECOND
        );
        
        return $this->respondUpdated()
        ->setHeader(X_REDIRECT_TO, url_to('admin.index'));
    }
}
