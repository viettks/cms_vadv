<?php

namespace App\Repository;

use App\Models\Revenue;
use Illuminate\Support\Facades\DB;

class RevenueRepository
{
    public static function getRevenues($param)
    {

        $eloquent = Revenue::where(function($query) use ($param){
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
        });

        $total = $eloquent->where('status','=','1')->sum('amount');
        $count = $eloquent->count();
        $data = $eloquent->get();

        $result['recordsTotal'] = $count;
        $result['recordsFiltered'] = $count;
        $result['data'] = $data;
        $result['total'] = $total;
        return $result;
    }
}
