<?php

if (! function_exists('classes')) 
{
    function classes (array $classes): string
    {
        $str_classes = '';

        foreach ($classes as $k => $v)
        {
            if (is_string($v))
            {
                $str_classes .= $v . ' ';
                continue;
            }

            if ($v == true) 
            {
                $str_classes .= $k . ' ';
            }
        }

        return sprintf('class="%s"', rtrim($str_classes));
    }
}

if (! function_exists('attrs')) 
{
    function attrs (array $attrs): string
    {
        $str_attrs = '';

        foreach ($attrs as $k => $v)
        {
            if (is_string($v))
            {
                $str_attrs .= $v . ' ';
                continue;
            }

            if ($v == true) 
            {
                $str_attrs .= $k . ' ';
            }
        }

        return trim($str_attrs);
    }
}

if (! function_exists('attr')) 
{
    function attr(bool $cond, string $attr, ?string $orAttr=null): ?string
    {
        return $cond ? $attr : $orAttr;
    }
}

if (! function_exists('disabled')) 
{
    function disabled(bool $cond): ?string
    {
        return $cond ? 'disabled' : null;
    }
}

if (! function_exists('readonly')) 
{
    function readonly(bool $cond): ?string
    {
        return $cond ? 'readonly' : null;
    }
}