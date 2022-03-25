<?php

namespace App\Service;

use App\Models\Debt;
use App\Models\Order;
use App\Models\OrderDetail;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{
    //CREATE ORDER AND MORE
    public function createOrder($order,$details)
    {
        try {
            DB::beginTransaction();
            $ord = $order->create($order->toArray());
            foreach($details as $detail){
                $temp= array_merge($detail,["order_id" => $ord->id]);
                OrderDetail::create($temp);
            }
            if($ord->payment < $ord->amount){
                Debt::create([
                    "order_id"   => $ord->id,
                    "amount"     => $ord->amount,
                    "payment"    => $ord->payment,
                    "status"     => Debt::UNDER_15,
                    "created_by" => $ord->created_by,
                    "updated_by" => $ord->created_by,
                ]);
            }
            DB::commit();
            return $ord;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new Exception("Lỗi tạo order");
        }
    }
}
