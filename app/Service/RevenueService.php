<?php

namespace App\Service;

use App\Repository\RevenueRepository;

class RevenueService
{
    public static function getRevenues($param,$pagging = true)
    {
        return RevenueRepository::getRevenues($param,$pagging);
    }
}
