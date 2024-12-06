<?php

use App\Models\ContactModel;
use Config\Services;

if (! function_exists('get_contact')) {
    function get_contact(string $name): ?string
    {
        $cache = Services::cache();
        $contacts = null;
        $content = null;

        if ($cache->get('contacts') == null) {
            $contacts = model(ContactModel::class)->get();
            $cache->save('contacts', $contacts, 5*MINUTE);
        }
        else {
            $contacts = $cache->get('contacts');
        }

        foreach ($contacts as $contact) {
            if ($contact['name'] == $name) {
                $content = $contact['content'];
                break;
            }
        }
        return $content;
    }
}