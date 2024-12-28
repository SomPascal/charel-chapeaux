<?php

namespace App\Filters;

use App\Models\ItemsVisitsModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use Psr\Log\LogLevel;

class TrackItemsVisits implements FilterInterface
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
        if (! (url_is('en/item/*') || url_is('fr/item/*')) || auth()->loggedIn())
        {
            return;
        }

        $visitor = session()->get('visitor');
        $item_id = $request->getUri()->getSegment(3);
        $items_visits_model = model(ItemsVisitsModel::class);

        if (! session()->has(sprintf(
            'item.visit.%s.%s', 
            md5($visitor['id']), 
            md5($item_id)
        )))
        {
            if (! $items_visits_model->hasAlreadyBeenVisited(
                vistor_id: $visitor['id'],
                item_id: $item_id
            )) 
            {
                try {
                    db_connect()->table('items_visits')
                    ->insert([
                        'id' => uid(),
                        'visitor_id' => $visitor['id'],
                        'item_id' => $item_id,
                        'created_at' => Time::now()
                    ]);
                } catch (\Throwable $e) {
                    log_message(
                        LogLevel::ERROR,
                        message: sprintf(
                            'Could not record item visit due to: %s\n%s',
                            $e->getMessage(),
                            $e->getTraceAsString()
                        )
                    );
                }

                session()->set(sprintf(
                    'item.visit.%s.%s', 
                    md5($visitor['id']), 
                    md5($item_id)
                ), true);
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
