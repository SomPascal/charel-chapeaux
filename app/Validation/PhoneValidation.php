<?php

namespace App\Validation;

class PhoneValidation
{
    protected array $patterns = [
        'cameroon' => '/^(((\+)?237)?6[2-9]\d{7})$/',
        'france' => '/^(?:\+33|0033|0)[1-9]\d{8}$/',
        'ivory_coast' => '/^((?:\+225|00225)?\d{8})$/',
        'germany' => '/^(?:\+?49|0)[1-9]\d{1,4}\d{1,7}$/',
        'england' => '/^(?:\+?44)?(?:\d{2})?(?:\d{4}|\d{3})\d{6}$/',
        'belgium' => '/^(?:\+?32)?(?:[2-9]\d{1,2})[2-9]\d{6}$/',
    ];

    public function phone(string $phone): bool
    {
        $flag = false;
        $phone = preg_replace(
            pattern: '/\s{1,}/', 
            replacement: '',
            subject: $phone
        );

        foreach ($this->patterns as $pattern)
        {
            if (preg_match(pattern: $pattern, subject: $phone))
            {
                $flag = true;
                break;
            }
        }

        return $flag;
    }
}
