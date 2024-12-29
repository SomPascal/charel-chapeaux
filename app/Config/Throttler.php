<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Throttler extends BaseConfig
{
    public array $login = [
        'capacity' => 5,
        'seconds'  => 30*SECOND
    ];

    public array $changePassword = [
        'capacity' => 5,
        'seconds'  => 30*SECOND,
        'cost'     => 2
    ];

    public array $changeUsername = [
        'capacity' => 5,
        'seconds'  => 30*SECOND
    ];

    public array $inviteAdmin = [
        'capacity' => 5,
        'seconds'  => MINUTE
    ];

    public array $addCategory = [
        'capacity' => 5,
        'seconds' => MINUTE
    ];

    public array $redirect = [
        'capacity' => 1,
        'seconds' => 2*MINUTE
    ];

    public array $contact = [
        'capacity' => 5,
        'seconds' => 2*MINUTE
    ];

}
