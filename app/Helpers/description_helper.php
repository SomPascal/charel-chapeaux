<?php

if (! function_exists('get_desc'))
{
    function get_desc(string $needle, array $haystack, string $key='content'): ?string
    {
        $res = null;

        foreach ($haystack as $desc)
        {
            if ($desc->name === $needle)
            {
                $res = $desc->{$key};
                break;
            }
        }

        return $res;
    }
}