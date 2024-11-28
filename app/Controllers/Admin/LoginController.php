<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Controllers\LoginController as ShieldLoginController;

class LoginController extends ShieldLoginController
{
    use ResponseTrait;

    public function login()
    {
        return view('Admin/Form/login');
    }

    public function attemptLogin(): Response
    {
        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = $this->getValidationRules();

        if (! $this->validateData(
            $this->request->getJsonVar(assoc: true), 
            $rules, 
            [], 
            config('Config\Auth')->DBGroup
        )) {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }

        /** @var array $credentials */
        $credentials             = $this->request->getJsonVar(setting('Auth.validFields')) ?? [];
        $credentials             = array_filter($credentials);
        $credentials['password'] = $this->request->getJsonVar('password');
        $remember                = $this->request->getJsonVar('remember') == 'on' ? true : false;

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        // Attempt to login
        $result = $authenticator->remember($remember)->attempt($credentials);
        if (! $result->isOK()) {
            return  $this->failUnauthorized(message: $result->reason());
        }

        // If an action has been defined for login, start it up.
        if ($authenticator->hasAction()) {
            return $this->failForbidden();
        }

        return $this->respondCreated()
        ->setHeader(X_REDIRECT_TO, config('Config\Auth')->loginRedirect());
    }
}
