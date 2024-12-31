<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VisitorModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LogLevel;

class CookieController extends BaseController
{
    use ResponseTrait;

    public function accept(): Response
    {
        $visitor = session()->get('visitor');

        if (session()->get(ACCEPTED_COOKIE) === true)
        {
            return $this->respondUpdated();
        }
        else if ($visitor['accepted_cookie'] == true)
        {
            session()->set(ACCEPTED_COOKIE, true);
            return $this->respondCreated();
        }

        try {
            model(VisitorModel::class)->update(id: $visitor['id'], row: [
                'accepted_cookie' => true
            ]);
        } catch (\Throwable $e) {
            log_message(
                LogLevel::ERROR,
                sprintf(
                    'Could not set cookie acceptance due to: %s\n%s', 
                    $e->getMessage(),
                    $e->getTraceAsString()
                )
            );

            return $this->failServerError();
        }

        session()->set(ACCEPTED_COOKIE, true);
        return $this->respondUpdated();
    }
}
