<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContactModel;
use App\Models\RedirectionModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use Config\Services;
use Psr\Log\LogLevel;

class RedirectController extends BaseController
{
    public function goto(string $name): string
    {
        $contact = get_contact($name);
        $visitor = session()->get('visitor');
        $item_id = $this->request->getGet('item', filter: FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($contact === null)
        {
            throw new PageNotFoundException("Error Processing Request");
        }
        $throttler = Services::throttler();
        $config = config('Config\Throttler')->redirect;

        if (! auth()->loggedIn()) 
        {
            if (! $throttler->check(
                key: sprintf('redirect.%s.%s', md5($visitor['id']), md5($name)),
                capacity: $config['capacity'],
                seconds: $config['seconds']
            )) 
            {
                // record redirect

                try {
                    $contact_id = model(ContactModel::class)->getIdByName($name);

                    model(RedirectionModel::class)->insert(row: [
                        'id' => uid(),
                        'visitor_id' => $visitor['id'],
                        'contact_id' => $contact_id,
                        'item_id' => $item_id,
                        'context' => empty($item_id) ? 'any' : 'item',
                        'created_at' => Time::now()
                    ]);
                } catch (\Throwable $e) {
                    dd($e->getMessage());                    
                    log_message(
                        LogLevel::ERROR,
                        sprintf(
                            'Could not record redirection due to : %s \n %s',
                            $e->getMessage(),
                            $e->getTraceAsString()
                        ),
                    );
                }
            }
            else {
                dd('too many requests');
            }
        }
        else {
            dd('logged in');
        }

        return view('click-contact', [
            'link' => match ($name) {
                'whatsapp' => sprintf('https://wa.me/%s', $contact),
                'phone' => sprintf('tel:%s', $contact),
                default => $contact
            }
        ]);
    }
}
