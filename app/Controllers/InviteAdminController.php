<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\InviteLinkEntity;
use App\Models\InvitationLinkModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Exceptions\PageNotFoundException;
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
        // TODO: Check if the user is not connected as an admin or superadmin
        if (auth()->loggedIn()) {
            return redirect()
            ->route('admin.home', [$this->request->getLocale()])
            ->with(
                'error', 
                'Vous ne pouvez plus utiliser ce lien. Vous etes déjà connecté.'
            );
        }
        else if (session()->has('invitation.link')) {
            return redirect()->route('admin.register');
        }

        // TODO: Check if the link really exist
        $link = model(InvitationLinkModel::class)->getInfo($link_id);

        if (! $link->exist()) {
            throw new PageNotFoundException("Error Processing Request");
        }


        // TODO: Check if the link has not been used yet
        $error_message = null;

        if ($link->hasBeenAlreadyUsed()) 
        {
            $error_message = 'Ce lien a déjà été utilisé. Veuillez en demander un autre';
        } else if ($link->hasExpired()) 
        {
            $error_message = 'Ce lien a déjà expiré. Veuillez en demander un autre';
        }

        if ($error_message !== null) {
            return view('message', ['message' => $error_message]);
        }

        // TODO: Allow the visitor to signup for a moment
        $use_activation_link = $link->activate($link->link_id);

        if ($use_activation_link === null) {
            return view('message', [
                'message' => 'Une erreur est survenue. Veuillez essayer de nouveau'
            ]);
        }
        $use_activation_link['role'] = $link->link_role;

        session()->setTempdata(
            'register.access', 
            true,
            30*MINUTE
        );

        session()->setTempdata(
            'used_invitation_link', 
            $use_activation_link,
            30*MINUTE
        );

        return redirect()->route(
            'admin.register', 
            [$this->request->getLocale()]
        )->with('success', 'Le lien d\'invitation a été activé avec succès.');
    }
}
