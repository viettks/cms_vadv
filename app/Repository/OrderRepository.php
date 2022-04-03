<?php

namespace App\Repository;

use App\Models\Order;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderRepository
{

    //ROW PER PAGE
    const ROW_PER_PAGE = 1;

    //GET LIST ORDER
    public function getListOrders($param,$pagging = true)
    {
        $sql = "
            o.id,
            DATE_FORMAT(o.created_at,'%d/%m/%Y') AS create_date,
            o.name AS customer,
            o.phone,
            CONCAT(p.name,', ',
                (
                CASE d.film_type 
                WHEN  '1' THEN 'không cán' 
                WHEN  '2' THEN 'cán bóng'
                WHEN  '3' THEN 'cán mờ'
                ELSE 'không xác định' END)
                ) AS detail,
            d.width,
            d.heigth,
            d.quantity,
            d.unit_price,
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
                        $query->where('name', '=',$param['value']);
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
        ->join('tb_print AS p','p.id','=','d.print_id')
        ->whereIn('o.id', $orderIds)
        ->selectRaw($sql)
        ->get();
        ;

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
            o.name AS customer,
            o.phone,
            o.address,
            o.payment,
            DATE_FORMAT(o.release, '%d/%m/%Y') AS release_dt ,
            o.note,
            o.amount AS total,
            o.status,
            p.name AS print,
            (CASE d.film_type
			 WHEN '1' THEN 'Không cán màng'
			 WHEN '2' THEN 'Cán màng bóng'
			 WHEN '3' THEN 'Cán màng mờ'
             ELSE 'Chưa xác định'
			 END
			) AS film_type,
			d.width,
			d.heigth,
            d.quantity,
			d.amount
            ";
        
        $data =  DB::table('tb_order AS o')
               ->join('tb_order_detail AS d','o.id','=','d.order_id')
               ->join('tb_print AS p','p.id','=','d.print_id')
               ->where('o.id','=', $id)
               ->selectRaw($sql)
               ->get();

        return $data;
       }
}
