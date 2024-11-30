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
        'seconds'  => 30*SECOND
    ];
}
