<?php

namespace App\Service;

use App\Repository\ChartRepository;

class ChartService
{
    public static function getDatas($param)
    {
        return ChartRepository::getDatas($param);
    }
}
