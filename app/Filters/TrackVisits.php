<?php

namespace App\Filters;

use App\Models\VisitorModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class TrackVisits implements FilterInterface
{
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
        /**
         * @var IncomingRequest $request
         */

        if (! $request->is('GET') || auth()->loggedIn()) {
            return;
        }

        $visitor_model = model(VisitorModel::class);
        $visitor = [];

        if (! session()->has('visitor')) {
            
            if ($visitor_model->hasAlreadyVisited(
                ip: $request->getIPAddress(),
                ua: (string) $request->getUserAgent()
            )) 
            {
                $visitor = $visitor_model->findOne(
                    ip: $request->getIPAddress(), 
                    ua: (string) $request->getUserAgent()
                );

                session()->set('visitor', $visitor);
            }
            else {
                $visitor = [
                    'id' => uid(),
                    'ip' => $request->getIPAddress(),
                    'user_agent' => $request->getUserAgent(),
                    'accept_lang' => $request->header('Accept-Language'),
                    'referrer_url' => $request->getServer('HTTP_REFFERER') ?? 'Direct',
                    'created_at' => Time::now()
                ];

                $visitor_model->insert(row: $visitor);

                unset(
                    $visitor['referrer_url'], 
                    $visitor['created_at'],
                    $visitor['accept_lang']
                );

                session()->set('visitor', $visitor);
            }
        }
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
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
