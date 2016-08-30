<?php

namespace App\Library;

class Util
{
    public static function checkIsNullAndEmpty($data, $field)
    {
        return isset($data[$field]) && (!empty($data[$field]));
    }

    public static function returnEmptyIfNull($data)
    {
        if (!isset($data)) {
            return "";
        }

        return $data;
    }

    public static function formatDatePt_Br_ex($data)
    {

        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        return strftime('%A, %d de %B de %Y',$data);
    }
}