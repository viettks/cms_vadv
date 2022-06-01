<?php

namespace App\Service;

use App\Models\Debt;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Repository\OrderRepository;
use App\Repository\PriceRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{

    public const BILL_PARTENT = "VAD000000000";
    
    //GET LIST CUSTOMER
    public static function getCustomeres($param)
    {
        return OrderRepository::getCustomeres($param);
    }
    
    //GET LIST CUSTOMER
    public static function getOrderCode($param)
    {
        return OrderRepository::getOrderCode($param);
    }

    //GET LIST HISTORY
    public static function getOrderHistory($param)
    {
        return OrderRepository::getOrderHistory($param);
    }

    //CREATE ORDER AND MORE
    public static function createOrder($order,$details)
    {
        try {
            DB::beginTransaction();
            $order['status'] = 0;
            $result = Order::create($order);
            $tempId = $result->id;
            $billId = substr(self::BILL_PARTENT,0,12-strlen($tempId)) . $tempId ;

            foreach($details as $detail){
                $detail["order_id"] = $result->id;
                OrderDetail::create($detail);
            }
            Order::where('id',$result->id)
                   ->update(["bill_code"=>$billId]);
            if($result->payment < $result->amount){
                Debt::create([
                    "order_id"   => $result->id,
                    "bill_code"  => $billId,
                    "amount"     => $result->amount,
                    "payment"    => $result->payment,
                    "status"     => Debt::ON_DEBT,
                    "created_by" => $result->created_by,
                    "updated_by" => $result->created_by,
                ]);
            }

            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new Exception("Lỗi tạo order");
        }
    }

    //UPDATE ORDER AND MORE
    public function updateOrder($order, $details)
    {
        try {
            DB::beginTransaction();
            $result = Order::find($order["id"]);

            $status = $order['status'];
            if($status == 1){
                $result->status = 1;
                $result->payment = $result->amount;

                Debt::where('order_id','=',$order['id'])
                ->update(['payment'=>$result->amount, 'status' => 1]);

            }else{
                $result->status = 0;
                $result->payment =  $order['payment'];
            }

            $result->name   =$order["name"];
            $result->phone  =$order["phone"];
            $result->address=$order["address"];
            $result->payment=$order["payment"];
            $result->release=$order["release"];
            $result->note   =$order["note"];
            $result->amount =$order["amount"];
            $result->save();

            OrderDetail::where('order_id','=',$order['id'])->delete();

            foreach($details as $detail){
                $detail["order_id"] = $result->id;
                OrderDetail::create($detail);
            }

            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new Exception("Lỗi tạo order");
        }
    }

    public static function getListOrder($param,$pagging = true)
    {
        return OrderRepository::getListOrders($param,$pagging);
    }

    public function getOne($id)
    {
        $orderRepo = new OrderRepository();
        return $orderRepo->getOne($id);
    }

    // UPDATE ORDER AND DEBT
    public function update($param)
    {
        try {
            DB::beginTransaction();
            $order = Order::find($param['id']);
            $status = $param['status'];
            if($status == 1){
                $order->status = 1;
                $order->payment = $order->amount;

                Debt::where('order_id','=',$param['id'])
                ->update(['payment'=>$order->amount, 'status' => 1,'updated_by'=>$param['update_by']]);

            }else{
                $order->status = 0;
                $order->payment =  $param['payment'];
            }
            $order->note = $param['note'];
            $order->updated_by = $param['update_by'];
            $order->save();
            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new Exception("Lỗi cập nhật order");
        }
    }

    //DELETE ORDER
    public static function delete($id)
    {
        try {
            DB::beginTransaction();
            Debt::where("order_id",$id)->delete();
            OrderDetail::where("order_id",$id)->delete();
            Order::destroy($id);
            DB::commit();
            return $id;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new Exception("Lỗi cập nhật order");
        }
    }
}
