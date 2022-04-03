<?php

namespace App\Repository;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DebtRepository
{
    //GET LIST DEBT
    public static function getDebtes($param,$pagging=true)
    {
        $sql = "
            DATE_FORMAT(o.created_at,'%d/%m/%Y') AS create_date,
            o.id,
            o.name,
            o.phone,
            o.amount,
            o.payment,
            (o.amount - o.payment) AS debt,
            DATEDIFF(NOW(),d.created_at) AS debt_date,
            d.status
            ";

        $result = array();
        
        $eloquent =  DB::table('tb_order AS o')
        ->join('tb_debt AS d','o.id','=','d.order_id')
        ->where(function($query) use ($param){
            $query->whereBetween(DB::raw('DATE(o.created_at)'), [$param['fromDate'],$param['toDate']]);
            if(isset($param['status'])){
                $status = $param['status'];
                if($status == '0'){
                    $query->whereRaw('DATEDIFF(NOW(),d.created_at) <= 15')
                          ->where('d.status', '!=','1');
                }
                if($status == '1'){
                    $query->whereRaw('DATEDIFF(NOW(),d.created_at) > 15')
                          ->whereRaw('DATEDIFF(NOW(),d.created_at) <= 15')
                          ->where('d.status', '!=','1');
                }
                if($status == '2'){
                    $query->whereRaw('DATEDIFF(NOW(),d.created_at) > 30')
                          ->where('d.status', '!=','1');
                }
                if($status == '3'){
                    $query->where('d.status', '=','1');
                }
            }
            if(isset($param['staff'])){
                $query->where('d.created_by', '=',$param['staff']);
            }
            if(isset($param['value'])){
                $query->where('o.name', 'like','%'.$param['value'].'%');
                $query->orWhere('o.phone', 'like','%'.$param['value'].'%');
            }
            if(isset($param['is_admin'])){
                if(!$param['is_admin']){
                    $query->where('o.created_by', '=',$param['user']);
                }
            }
        })
        ->selectRaw($sql);
        if($pagging){
            $data = $eloquent->skip($param['length'] * $param['start'])->take($param['length'])->get();
        }else{
            $data = $eloquent->get();
        }
        $result['recordsTotal'] = $eloquent->count();
        $result['recordsFiltered'] = $eloquent->count();
        $result['data'] = $data;
        $result['total'] = $eloquent->sum(DB::raw('o.amount - o.payment'));
        return $result;
    }
}
