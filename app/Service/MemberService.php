<?php

namespace App\Service;

use App\Repository\MemberRepository;
use Illuminate\Support\Facades\Log;

/**
 * MemberService
 * 
 * 
 * @package    Service
 * @author     VIETNT
 */
class MemberService
{
    /**
     * 
     * GET LIST MEMBER
     *
     * @param Request $request 
     * @return json list member
     */
    public static function getListMember($param)
    {
        Log::info("GET LIST MEMBER WITH : ", $param);
        return MemberRepository::getListOrders($param);
    }
}
