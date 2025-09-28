<?php
namespace App\Support;

final class FilterSupport
{
    public static function verifyIfEmptyValueByArray(array $data,?string $value, string|int|float|bool $default = false)
    {
        if(!isset($data[$value]))
        {
            $data[$value] = $default;
        }
        return $data;
    }
}