<?php

namespace App\Service;

use App\Repository\RevenueRepository;

class RevenueService
{
    public static function getRevenues($param)
    {
        return RevenueRepository::getRevenues($param);
    }
}
