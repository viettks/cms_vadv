<?php

namespace App\Repository;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DebtRepository
{
    //GET LIST DEBT
    public static function getDebtes($param)
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
            $query->whereBetween(DB::raw('DATE(created_at)'), [$param['fromDate'],$param['toDate']]);
            if(isset($param['status'])){
                $query->where('status', '=',$param['status']);
            }
            if(isset($param['staff'])){
                $query->where('created_by', '=',$param['staff']);
            }
            if(isset($param['value'])){
                $query->where('name', '=',$param['value']);
            }
        })
        ->selectRaw($sql);

        $data = $eloquent->get();

        $result['recordsTotal'] = $data->count();
        $result['recordsFiltered'] = $data->count();
        $result['data'] = $data;
        $result['total'] = $eloquent->sum('debt');
        return $result;
    }
}
