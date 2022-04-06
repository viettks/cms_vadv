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

    public const BILL_PARTENT = "VAV000000000";

    //CREATE ORDER AND MORE
    public function createOrder($order,$details)
    {

        try {
            DB::beginTransaction();
            $order['status'] = 0;
            $result = Order::create($order);
            $totalAmount = 0;
            $priceRepository = new PriceRepository();
            $tempId = $result->id;
            $billId = substr(self::BILL_PARTENT,0,12-strlen($tempId)) . $tempId ;

            foreach($details as $detail){
                $detail["order_id"] = $result->id;
                if($detail["is_fix_price"] === true){
                    Log::info($detail["is_fix_price"]);
                    $perUnit = $detail["fix_price"];
                    $amount = $detail["quantity"] * $perUnit;
                }else{
                    $size = $detail["width"] * $detail["heigth"] * $detail["quantity"];
                    $price = $priceRepository->getPrice($detail["print_id"],$size);
                    $filmPrice = $detail["film_type"] == 1 ? $price->pe_film_1 : ($detail["film_type"] == 2 ? $price->pe_film_2 : $price->pe_film_3);
                    $amount = $size * ($price->price + $filmPrice);
                    $perUnit = $amount / $detail["quantity"];
                }

                $totalAmount += $amount;
                $detail['unit_price'] = $perUnit;
                $detail['amount']     = $amount;
                $detail['created_by'] = $result->created_by;
                $detail['updated_by'] = $result->created_by;
                OrderDetail::create($detail);
            }
            Order::where('id',$result->id)
                   ->update(['amount'=>$totalAmount,"bill_code"=>$billId]);
            if($result->payment < $totalAmount){
                Debt::create([
                    "order_id"   => $result->id,
                    "amount"     => $totalAmount,
                    "payment"    => $result->payment,
                    "status"     => Debt::UNDER_15,
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

    public static function getListOrder($param,$pagging = true)
    {
        $orderRepo = new OrderRepository();
        return $orderRepo->getListOrders($param,$pagging);
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
}
