<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class DraftController extends BaseController
{
    protected $helpers = ['mailjet'];
    
    public function index()
    {
        mailjet(
            receiverEmail: env('mailjet.receiver', 'rubenndjengwes@gmail.com'),
            receiverName: 'Charel Chapeaux',
            subject: 'Formulaire de Contact',
            textContent: 'Enregistrement au formulaire de contact',
            htmlContent: view('Mail/contact_form', [
                'visitor' => [
                    'phone' => '656063555',
                    'name' => 'jules'
                ]
            ])
        );

        return view('Mail/contact_form', [
            'visitor' => [
                'name' => 'John Doe',
                'phone' => '656 06 35 55'
            ]
        ]);
    }
}
