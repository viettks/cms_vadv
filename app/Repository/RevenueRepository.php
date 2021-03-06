<?php

namespace App\Repository;

use App\Models\Revenue;
use Illuminate\Support\Facades\DB;

class RevenueRepository
{
    public static function getRevenues($param,$pagging = true)
    {
        $sql = "
            DATE_FORMAT(r.created_at,'%d/%m/%Y') AS create_date,
            r.id,
            r.name,
            r.phone,
            r.note,
            r.amount,
            r.file_name,
            cr.name as created_by,
            up.name as updated_by,
            r.status,
            r.url
            ";
        $eloquent = DB::table('tb_revenue AS r')
                      ->join('users AS cr','cr.id','=','r.created_by')
                      ->leftJoin('users AS up','up.id','=','r.updated_by')
                      ->where(function($query) use ($param){
                        $query->whereBetween(DB::raw('DATE(r.created_at)'), [$param['fromDate'],$param['toDate']]);
                        if(isset($param['status'])){
                            $query->where('r.status', '=',$param['status']);
                        }
                        if(isset($param['staff'])){
                            $query->where('r.created_by', '=',$param['staff']);
                        }
                        if(isset($param['value'])){
                            $query->where('r.name', 'like','%'.$param['value'].'%');
                            $query->orWhere('r.note', 'like','%'.$param['value'].'%');
                        }
                        if(isset($param['is_admin'])){
                            if(!$param['is_admin']){
                                $query->where('r.created_by', '=',$param['user']);
                            }
                        }
                    });
        
        $count = $eloquent->count();
        if($pagging){
            $data =  $eloquent->selectRaw($sql)->skip($param['length'] * $param['start'])->take($param['length'])->get();
        }else{
            $data =  $eloquent->selectRaw($sql)->get();
        }

        $total = $eloquent->where('status','=','2')->sum('amount');

        $result['recordsTotal'] = $count;
        $result['recordsFiltered'] = $count;
        $result['data'] = $data;
        $result['total'] = $total;
        return $result;
    }
}
