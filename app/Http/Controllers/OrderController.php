<?php

namespace App\Http\Controllers;

use App\Exports\ExportOrder;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PrintSub;
use App\Service\OrderService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function viewListOrder(Request $request)
    {
        $memberes = DB::table('users AS u')->get();
        return view('pages.order.list')->with(compact('memberes'));
    }

    //VIEW TẠO ĐƠN HÀNG
    public function viewCreate(Request $request)
    {
        $printes = PrintSub::where('is_delete','!=','1')->get();
        return view('pages.order.add')
             ->with(compact('printes'));
    }

    //VIEW TẠO ĐƠN HÀNG
    public function viewDetail(Request $request)
    {
        $id = $request->id;
        $printes = PrintSub::where('is_delete', '!=', '1')->get();
        $order = Order::find($id);
        $details = OrderDetail::where('order_id', '=', $id)->get();
        return view('pages.order.detail')
        ->with(compact(['printes','order','details']));
    }

    public function export(Request $request) 
    {
        $param = $request->all();
        $user = auth()->user();
        $param['is_admin'] = $user->hasRole('ADMIN');
        $param['user'] = $user->id;
        return Excel::download(new ExportOrder($param), 'don-hang.xlsx');
    }

    //API

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

        $result = OrderService::getListOrder($param);
        return response()->json($result, 200);
    }

    /*
    *
    * GET ORDER
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
    * GET LIST CUSTOMER ORDER
    */
    public function getCustomeres(Request $request)
    {
        return response()->json(OrderService::getCustomeres($request->all()), 200);
    }

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
            'detail'  => 'array|required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $printDetails = $request->detail;
            
        $author = auth()->user();

        $order = $request->except(['detail']);
        $order['created_by'] = $author->id;
        $order['updated_by'] = $author->id;
        try {
            $result = OrderService::createOrder($order,$printDetails);
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

    /*
    *
    * UPDATE ORDER
    */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string',
            'phone'   => 'required',
            'address' => 'required',
            'payment' => 'required|integer',
            'detail'  => 'array|required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $printDetails = $request->detail;
            
        $author = auth()->user();

        $order = $request->except(['detail']);
        $order['created_by'] = $author->id;
        $order['updated_by'] = $author->id;
        try {
            $result = OrderService::updateOrder($order,$printDetails);
            return response()->json([
                'status' => "OK",
                'data' => $result, 
                'message' => 'Cập nhật thành công.'
            ]);
        } catch (Exception $e) {
            
            return response()->json([
                'status'  => 500,
                'message' => 'Đã xảy ra lỗi hệ thống.',
            ], 500);
        }
    }

    /*
    *
    * DELETE ORDER
    */
    public function delete(Request $request)
    {
        $id = $request->id;
        return response()->json([
            'status' => "OK",
            'data' => OrderService::delete($id), 
            'message' => 'Xóa thành công.'
        ]);
    }
}
