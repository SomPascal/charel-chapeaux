<?php

use Symfony\Component\Uid\Uuid;

if (! function_exists('uid')) {
    function uid(): string
    {
        return Uuid::v7();
    }
}