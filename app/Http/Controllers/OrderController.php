<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Printing;
use App\Service\OrderService;
use App\Service\PrintService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function viewListOrder(Request $request)
    {
        $memberes = DB::table('users AS u')->get();
        return view('pages.order.list')->with(compact('memberes'));
    }

    public function add(Request $request)
    {

        $printes = Printing::where('is_delete','!=','1')->get();
        $priceService = new PrintService();
        $details = $priceService->getPriceDetails();
        return view('pages.order.add')
                ->with(compact('printes'))
                ->with(compact('details'))
    ;}

    //API

    /*
     * Create ORDER
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

        $printDetails = $request->detail;

        $paramIds = array_unique(array_column($printDetails,'print_id'));

        $resultIds = array_unique(array_column(Printing::whereIn('id',$paramIds)->get()->toarray(),'id'));

        if(sizeof($paramIds) != sizeof($resultIds)){
            return response()->json([
                'status'  => 404,
                'message' => 'Loại in không tồn tại trên hệ thống.'
            ], 400);
        }else{
            
            $author = auth()->user();

            $order = $request->except(['detail']);
            $order['created_by'] = $author->id;
            $order['updated_by'] = $author->id;
            $order['amount']     = 0;
            try {
                $orderService = new OrderService();
                $result = $orderService->createOrder($order,$printDetails);
                return response()->json([
                    'status' => "OK",
                    'data' => $result, 
                    'message' => 'Tạo mới thành công.'
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'status'  => 500,
                    'message' => 'Đã xảy ra lỗi hệ thống.',
                ], 500);
            }
        }
    }

    /*
    *
    * GET LIST ORDER
    */

    public function getListOrder(Request $request)
    {
        $param = $request->all();
        $user = auth()->user();
        $param['is_admin'] = $user->hasRole('ADMIN');
        $param['user'] = $user->id;

        $orderSvc = new OrderService(); 
        $result = $orderSvc->getListOrder($param);

        return response()->json($result, 200);
    }

        /*
    *
    * GET LIST ORDER
    */

    public function getOne(Request $request)
    {
        $id = $request->id;

        $orderSvc = new OrderService(); 
        $result = $orderSvc->getOne($id);

        return response()->json($result, 200);
    }

    /*
    *
    * GET LIST ORDER
    */

    public function update(Request $request)
    {
        $param = $request->all();
        $param['update_by'] = auth()->user()->id;
        $orderSvc = new OrderService(); 
        $result = $orderSvc->update($param);

        return response()->json($result, 200);
    }
}
