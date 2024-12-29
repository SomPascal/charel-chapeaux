<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContactFormModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Psr\Log\LogLevel;

class ContactController extends BaseController
{
    use ResponseTrait;

    protected $helpers = ['mailjet'];

    protected function alreadySentForm(array $visitor): bool
    {
        if (session()->get(CONTACT_SENT) == true)
        {
            return true;
        }


        if (model(ContactFormModel::class)->alreadySubmitted($visitor['id']))
        {
            session()->set(CONTACT_SENT, true);
            return true;
        }
        else {
            return false;
        }
    }

    public function store(): Response
    {
        if (auth()->loggedIn()) {
            return $this->failServerError('An admin can\'t send the form contact.');
        }

        if (! $this->validate('store_contact')) {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }
        $visitor = session()->get('visitor');
        $throttler = Services::throttler();
        $config = config('Config\Throttler')->contact;

        if ($this->alreadySentForm($visitor)) {
            return $this->failServerError(
                'You have already submitted this contact form'
            );
        }

        if (! $throttler->check(
            key: md5('contact.' . $visitor['id']),
            capacity: $config['capacity'],
            seconds: $config['seconds']
        ))
        {
            return $this->failTooManyRequests()
            ->setHeader(X_RETRY_AFTER, $throttler->getTokenTime());
        }

        $data = $this->validator->getValidated();
        $data['phone'] = preg_replace('/\s{1,}/', '', $data['phone']);

        try {
            if (! model(ContactFormModel::class)->store([...$data, ...['visitor_id' => $visitor['id']]]))
            {
                return $this->failServerError();
            }
        } catch (\Throwable $e) {
            return $this->failServerError($e->getMessage());

            log_message(
                LogLevel::ERROR,
                sprintf(
                    'Could not record a contact form due to: %s\n%s',
                    $e->getMessage(),
                    $e->getTraceAsString()
                )
            );
        }

        // send mail
        if (env('CI_ENVIRONMENT', 'development') == 'development')
        {
            if (mailjet(
                receiverEmail: env('mailjet.receiver', 'rubenndjengwes@gmail.com'),
                receiverName: 'Charel Chapeaux',
                subject: 'Formulaire de Contact',
                textContent: 'Enregistrement au formulaire de contact',
                htmlContent: view('Mail/contact_form', [
                    'visitor' => [
                        'phone' => $data['phone'],
                        'name' => $data['name']
                    ]
                ])
            ) == false) 
            {
                log_message(
                    LogLevel::ALERT,
                    'Could not send contact form email',
                    ['phone' => $data['phone'], 'name' => $data['name']]
                );
            }
        }
        else {
            log_message(
                level: LogLevel::INFO,
                message: 'Mail successfully sent to %s' . env('mailjet.receiver', 'rubenndjengwes@gmail.com')
            );
        }
        
        // set session data
        session()->set(CONTACT_SENT, true);

        return $this->respondCreated();
    }
}