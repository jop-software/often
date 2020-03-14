<?php

namespace App\Services;

use Prefab;

class MonthConverterService extends Prefab
{
    /**
     * return the name of the month with the given number in the language of the user
     * 
     * @param int $monthNumber
     * @return string
     */
    public function getName(int $monthNumber)
    {
        // TODO: support for multiple languages
        return date("F", mktime(0,0,0, $monthNumber, 10));
    }
}