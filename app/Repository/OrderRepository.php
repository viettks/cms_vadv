<?php

namespace App\Repository;

use App\Models\Order;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderRepository
{

    //GET LIST ORDER
    public function getListOrders($param,$pagging = true)
    {
        $sql = "
            o.id,
            o.bill_code,
            DATE_FORMAT(o.created_at,'%d/%m/%Y') AS create_date,
            o.name AS customer,
            o.phone,
            d.print_name as name,
            d.manufac1,
            d.manufac2,
            d.width,
            d.heigth,
            d.quantity,
            d.quantity as unit_total,
            d.unit_price,
            d.unit_name,
            d.amount,
            o.amount AS total,
            o.status
            ";

        $result = array();
        $eloquent = Order::where(function($query) use ($param){
                    $query->whereBetween(DB::raw('DATE(created_at)'), [$param['fromDate'],$param['toDate']]);
                    if(isset($param['status'])){
                        $query->where('status', '=',$param['status']);
                    }
                    if(isset($param['staff'])){
                        $query->where('created_by', '=',$param['staff']);
                    }
                    if(isset($param['value'])){
                        $query->where('name', 'like','%'.$param['value'].'%');
                        $query->orWhere('bill_code', 'like','%'.$param['value'].'%');
                    }
                    if(isset($param['is_admin'])){
                        if(!$param['is_admin']){
                            $query->where('created_by', '=',$param['user']);
                        }
                    }
                });
        if($pagging){
            $orderIds = $eloquent->select('id')->skip($param['length'] * $param['start'])->take($param['length'])->get()->toArray();
        }else{
            $orderIds = $eloquent->select('id')->get()->toArray();
        }
        
        $count = $eloquent->count();
        $total = $eloquent->sum('amount');
        
        $data =  DB::table('tb_order AS o')
        ->join('tb_order_detail AS d','o.id','=','d.order_id')
        ->whereIn('o.id', $orderIds)
        ->selectRaw($sql)
        ->get();

        $result['recordsTotal'] = $count;
        $result['recordsFiltered'] = $count;
        $result['data'] = $data;
        $result['total'] = $total;
        return $result;
    }

    //GET ORDER
    public function getOne($id)
    {
        $sql = "
            o.id,
            o.bill_code,
            o.name AS customer,
            o.phone,
            o.address,
            o.payment,
            DATE_FORMAT(o.release, '%d/%m/%Y') AS release_dt ,
            o.note,
            o.amount AS total,
            o.status,
			d.width,
			d.heigth,
            d.quantity,
			d.amount
            ";
        
        $data =  DB::table('tb_order AS o')
               ->join('tb_order_detail AS d','o.id','=','d.order_id')
               ->where('o.id','=', $id)
               ->selectRaw($sql)
               ->get();

        return $data;
    }

    //GET LIST ORDER
    public static function getCustomeres($param,$pagging = true){
        $sql = "
        o.name,
        o.phone,
        address
        ";
        $eloquent = Order::where(function($query) use ($param){
                    if(isset($param['value'])){
                        $query->where('name', 'like','%'.$param['value'].'%');
                        $query->orWhere('phone', 'like','%'.$param['value'].'%');
                    }
                });
        $count = $eloquent->select(['name','phone','address'])->distinct()->count();
        if($pagging){
            $data = $eloquent->select(['name','phone','address'])->distinct()->skip($param['length'] * $param['start'])->take($param['length'])->get()->toArray();
        }else{
            $data = $eloquent->select(['name','phone','address'])->distinct()->get()->toArray();
        }

        $result['recordsTotal'] = $count;
        $result['recordsFiltered'] = $count;
        $result['data'] = $data;
        return $result;
    }
}
