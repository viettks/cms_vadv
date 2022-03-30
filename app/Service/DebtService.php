<?php

namespace App\Service;

use App\Repository\DebtRepository;

class DebtService
{
    //GET LIST DEBT
    public static function getDebtes($param)
    {
        return DebtRepository::getDebtes($param);
    }
}
