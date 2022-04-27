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
            $orderIds = $eloquent->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->select('id')->skip($param['length'] * $param['start'])->take($param['length'])->get()->toArray();
        }else{
            $orderIds = $eloquent->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->select('id')->get()->toArray();
        }

        $count = $eloquent->count();
        $total = $eloquent->sum('amount');
        
        $data =  DB::table('tb_order AS o')
        ->join('tb_order_detail AS d','o.id','=','d.order_id')
        ->whereIn('o.id', $orderIds)
        ->orderBy('o.created_at', 'DESC')
        ->orderBy('o.id', 'DESC')
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
            d.print_name,
            d.manufac1,
            d.manufac2,
            d.width,
            d.heigth,
            d.quantity,
            d.unit_price,
            CONCAT(d.total,d.unit_name) AS unit_total,
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

    //GET LIST ORDER CODE
    public static function getOrderCode($param, $pagging = true){
        $sql = "
        o.name,
        o.phone,
        o.bill_code
        ";
        $eloquent = DB::table('tb_order as o')
                    ->leftJoin('tb_debt AS d','o.id','=','d.order_id')
                    ->where(function($query) use ($param){
                        $query->whereNull('d.id');
                        if(isset($param['value'])){
                            $query->where('name', 'like','%'.$param['value'].'%');
                            $query->orWhere('phone', 'like','%'.$param['value'].'%');
                        }
                    });
        $count = $eloquent->selectRaw($sql)->count();
        if($pagging){
            $data = $eloquent->selectRaw($sql)->skip($param['length'] * $param['start'])->take($param['length'])->get()->toArray();
        }else{
            $data = $eloquent->selectRaw($sql)->get()->toArray();
        }

        $result['recordsTotal'] = $count;
        $result['recordsFiltered'] = $count;
        $result['data'] = $data;
        return $result;
    }

    //GET LIST ORDER HISTORY
    public static function getOrderHistory($param, $pagging = true)
    {
        $sql = "
            o.id,
            o.bill_code,
            DATE_FORMAT(o.created_at,'%d/%m/%Y') AS create_date,
            o.name AS customer,
            o.phone,
            o.address,
            o.amount,
            o.status
            ";
        $data = DB::table('tb_order as o')
        ->leftJoin('tb_debt AS d', 'o.id', '=', 'd.order_id')
        ->where('o.phone',"=",$param['phone'])
        ->selectRaw($sql)
        ->get();
        return $data;
    }
}
