<?php

use Mailjet\Client;
use Mailjet\Resources;
use Psr\Log\LogLevel;

if (! function_exists('mailjet')) {

    /**
     * @throws \Exception
     */
    function mailjet(
        string $receiverEmail, 
        string $receiverName,
        string $subject, 
        string $textContent,
        string $htmlContent
    ): bool
    {
        $config = config('Config\Email');

        $mj = new Client(
            key: getenv('mailjet.apikey'), 
            secret: getenv('mailjet.secret_key'),
            call: true,
            settings: ['version' => 'v3.1']
        );

        // Define your request body

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => $config->fromEmail,
                        'Name' => $config->fromName
                    ],

                    'To' => [
                        [
                            'Email' => $receiverEmail,
                            'Name' => $receiverName
                        ]
                    ],

                    'Subject' => $subject,
                    'TextPart' => $textContent,
                    'HTMLPart' => $htmlContent
                ]
            ]
        ];

        // All resources are located in the Resources class

        $response = null;
        try {
            $response = $mj->post(Resources::$Email, ['body' => $body])
            ->success();
        } catch (\Throwable $e) {
            log_message(
                LogLevel::ERROR,
                $e->getMessage()
            );
            $response = false;
        }

        // Read the response
        return $response;
    }
}