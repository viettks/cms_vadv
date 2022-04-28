<?php

namespace App\Service;

use App\Models\Debt;
use App\Models\Order;
use App\Repository\DebtRepository;

class DebtService
{
    //GET LIST DEBT
    public static function getDebtes($param,$pagging=true)
    {
        return DebtRepository::getDebtes($param,$pagging);
    }

    //CREATE DEBT
    public static function createDebt($param)
    {
        $order = Order::find($param['id']);

        $debt = Debt::create([
            'order_id' => $order->id,
            'bill_code' => $order->bill_code,
            'amount' => $param['amount'],
            'payment' => $param['payment'],
            'status' => 0,
            'created_by' => $param['user'],
            'created_at' => $param['fromdate'],
        ]);

        return $debt;
    }
}
