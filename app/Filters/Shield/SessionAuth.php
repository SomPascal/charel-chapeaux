<?php

namespace App\Filters\Shield;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Filters\SessionAuth as ShieldSessionAuth;

class SessionAuth extends ShieldSessionAuth
{
    protected Response $response;

    use ResponseTrait;

    public function __construct() {
        $this->response = response();
    }

    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! $request instanceof IncomingRequest) {
            return;
        }

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        if ($authenticator->loggedIn()) {
            if (setting('Auth.recordActiveDate')) {
                $authenticator->recordActiveDate();
            }

            // Block inactive users when Email Activation is enabled
            $user = $authenticator->getUser();

            if ($user->isBanned()) {
                $error = $user->getBanMessage() ?? lang('Auth.logOutBannedUser');
                $authenticator->logout();

                return ($request->isAJAX()) ? $this->failUnauthorized() : 
                    redirect()->to(config('Config\Auth')->logoutRedirect())
                    ->with('error', $error);
            }

            if ($user !== null && ! $user->isActivated()) {
                // If an action has been defined for register, start it up.
                $hasAction = $authenticator->startUpAction('register', $user);
                if ($hasAction) {
                    return ($request->isAJAX()) ? $this->failUnauthorized() : 
                        redirect()->route('auth-action-show')
                        ->with('error', lang('Auth.activationBlocked'));
                }
            }

            return;
        }

        if ($authenticator->isPending()) {
            return ($request->isAJAX()) ? $this->failUnauthorized() :  redirect()->route('auth-action-show')
                ->with('error', $authenticator->getPendingMessage());
        }

        if (uri_string() !== route_to('login')) {
            $session = session();
            $session->setTempdata('beforeLoginUrl', current_url(), 300);
        }

        return redirect()->route('admin.login');
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {
        //
    }
}
