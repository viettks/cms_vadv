<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * MemberRepository
 * 
 * 
 * @package    Repository
 * @author     VIETNT
 */
class MemberRepository
{

    const ADMIN = 'ADMIN';
    const USER = 'USER';


    /**
     * 
     * SHOW LIST MEMBER PAGGING
     *
     * @param Request $request 
     * @return json list member
     */
    public static function getListOrders($param)
    {   
        $select = "u.id,
                   u.name,
                   u.user_name,
                   r.decription AS role_name,
                   DATE_FORMAT(u.created_at,'%d/%m/%Y') AS create_date
                  ";

        $eloquent = DB::table('users AS u')
                    ->join('tb_role AS r','u.role_id','=','r.id')
                    ->where('r.name','=',self::USER)
                    ->where('u.is_delete','!=',1)
                    ->where(function($query) use ($param){
                        if(isset($param['value'])){
                            $query->where('u.name', 'like','%'.$param['value'].'%');
                        }
                    });
        $count = $eloquent->count();
        $data = $eloquent->select(DB::raw($select))->skip($param['length'] * $param['start'])->take($param['length'])->get();
        $result['recordsTotal'] = $count;
        $result['recordsFiltered'] = $count;
        $result['data'] = $data;
        return $result;
    }
}
