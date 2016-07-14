<?php

namespace App\Library;

class Util
{
    public static function checkIsNullAndEmpty($data,$field)
    {
        return isset($data[$field]) && (! empty($data[$field] ));
    }

    public static function returnEmptyIfNull($data)
    {
        if(! isset($data)){
            return ""; 
        }
        
        return $data;
    }
}