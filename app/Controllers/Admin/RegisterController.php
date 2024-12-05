<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\InviteLinkEntity;
use App\Models\AdminModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Events\Events;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Controllers\RegisterController as ShieldRegisterController;
use CodeIgniter\Shield\Exceptions\ValidationException;

class RegisterController extends ShieldRegisterController
{
    use ResponseTrait;

    public function register()
    {
        if (auth()->loggedIn()) {
            return redirect()->route('admin.index');
        }
        else if (! session()->has('invitation.link')) {
            return redirect()->to('/');
        }
        
        return view('Admin/Form/register');
    }

    public function attemptRegister(): Response
    {
        if (auth()->loggedIn()) {
            return $this->failUnauthorized();
        }

        // Check if registration is allowed
        if (! setting('Auth.allowRegistration')) {
            return $this->failForbidden();
        }

        $users = $this->getUserProvider();

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = $this->getValidationRules();

        if (! $this->validateData(
            $this->request->getJsonVar(assoc: true), 
            $rules,
            [], 
            config('Config\Auth')->DBGroup)
        ) {
            return $this->failValidationErrors($this->validator->getErrors());
        }


        // Save the user
        $allowedPostFields = array_keys($rules);
        $user              = $this->getUserEntity();
        $user->fill($this->request->getJsonVar($allowedPostFields, assoc: true));

        // Workaround for email only registration/login
        if ($user->username === null) {
            $user->username = null;
        }

        if (model(AdminModel::class)->amount() >= 6)
        {
            return $this->failServerError(
                'Insufficient Storage',
                Response::HTTP_INSUFFICIENT_STORAGE
            );
        }

        try {
            $users->save($user);
        } catch (ValidationException $e) {
            var_dump($e->getMessage());
            return $this->failServerError();
        }

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        $invitation_link = session()->get('invitation.link');

        if (! ($invitation_link instanceof InviteLinkEntity)) 
        {
            return $this->failServerError();
        }

        // Add to default group
        $user->addGroup($invitation_link->link_role);


        Events::trigger('register', $user);

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        $authenticator->startLogin($user);

        // If an action has been defined for register, start it up.
        $hasAction = $authenticator->startUpAction('register', $user);

        if ($hasAction) {
            return $this->respondCreated()->setHeader(
                X_REDIRECT_TO, url_to('auth-action-show')
            );
        }

        // Set the user active
        $user->activate();

        $authenticator->completeLogin($user);

        // Success!
        return $this->respondCreated(message:lang('Auth.registerSuccess'))
        ->setHeader(
            X_REDIRECT_TO, 
            config('Config\Auth')->registerRedirect()
        );
    }
}
