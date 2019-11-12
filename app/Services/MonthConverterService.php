<?php

namespace App\Services;

use Base;
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
        // return the name of the month in the configures language
        return Base::instance()->get("month")[$monthNumber];
    }
}