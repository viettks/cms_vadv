<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PrintSetting;
use App\Service\OrderService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public const SALE_OFF_SIZE = 1.2;

    public function viewListOrder(Request $request)
    {
        return view('pages.order.list');
    }

    public function add(Request $request)
    {
        return view('pages.order.add');
    }

    //API

        /*
     * Create Print
     */
    public function createOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string',
            'phone'   => 'required',
            'address' => 'required',
            'payment' => 'required|integer',
            'release' => 'required|date',
            'note'    => 'required',
            'detail'  => 'array',
            'detail.*.print_id'  => 'required',
            'detail.*.width'  => 'required',
            'detail.*.heigth'  => 'required',
            'detail.*.quantity'  => 'required',
            'detail.*.film_type'  => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $listPrintId = array_unique(array_column($request->input('detail.*'),'print_id'));

        $listPrint = PrintSetting::whereIn('id',$listPrintId)->get()->toarray();
        if(sizeof($listPrint) == 0){
            return response()->json([
                'status'  => 404,
                'message' => 'Loại in không tồn tại trên hệ thống.'
            ], 400);
        }else{
            $listDetails = $request->detail;
            $listOrderDetails = array();
            $author = auth()->user();
            foreach($listDetails as $detail){
                $printIndex = array_search($detail['print_id'],array_column($listPrint, 'id'));
                
                if ($printIndex !== false) {
                    $print = $listPrint[$printIndex];
                    $productArea = $detail['width'] * $detail['heigth'];
                    $basePrice = $productArea < self::SALE_OFF_SIZE ? $print['small_price'] : $print['big_price'];
                    $filmPrice = $detail['film_type'] == 2 ? $print['pe_film_2'] : ($detail['film_type'] == 3 ? $print['pe_film_3'] : $print['pe_film_1']);

                    $perUnit = ($basePrice + $filmPrice) * $productArea;
                    $total   = $perUnit * $detail['quantity'];
                    $detail['unit_price'] = $perUnit;
                    $detail['amount'] = $total;
                    $detail['film_type'] = ($detail['film_type'] == 2  || $detail['film_type'] == 3) ? $detail['film_type'] : 0;
                    $detail['created_by'] = $author->id;
                    $detail['updated_by'] = $author->id;
                    array_push($listOrderDetails,$detail);
                } else {
                    return response()->json([
                        'status'  => 404,
                        'message' => 'Loại in không tồn tại trên hệ thống.'
                    ], 400);
                }
            }
            $amount = array_sum(array_column($listOrderDetails, 'amount'));
            $order = new Order();
            $order->name       = $request->name;
            $order->phone      = $request->phone;
            $order->address    = $request->address;
            $order->payment    = $request->payment;
            $order->release    = $request->release;
            $order->note       = $request->note;
            $order->amount     = $amount;
            $order->created_by = $author->id;
            $order->updated_by = $author->id;
            
            try {
                $orderService = new OrderService();
                $orderCreate = $orderService->createOrder($order,$listOrderDetails);
                return response()->json([
                    'status' => "OK",
                    'data' => $orderCreate, 
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'status'  => 500,
                    'message' => 'Đã xảy ra lỗi hệ thống.',
                ], 500);
            }
        }
    }
}
