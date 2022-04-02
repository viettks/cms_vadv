<?php

namespace App\Service;

use App\Repository\MemberRepository;

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
        return MemberRepository::getListOrders($param);
    }
}
