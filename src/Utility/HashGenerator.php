<?php

namespace App\Utility;


class HashGenerator
{
    public static function create($className, $id)
    {
        return md5($className.$id);
    }
}