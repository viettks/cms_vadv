<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Printing;
use App\Models\PrintPrice;
use App\Service\PrintService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\VarDumper;

class PrintController extends Controller
{
    public function viewCreate(Request $request)
    {
        return view('pages.settings.print');
    }

    public function viewList(Request $request)
    {
        return view('pages.settings.list-print');
    }

    public function viewUpdate(Request $request)
    {
        $id = $request->id;
        $printing = Printing::where('is_delete','!=',1)->find($id);
        if(!isset($printing)){
            abort(404);
        }
        $printPrices = PrintPrice::where('print_id','!=',1)->get();
        return view('pages.settings.updatePrint')->with(compact('printing','printPrices'));
    }

    //API

    /*
     * List Of Print
     */
    public function listPrint(Request $request)
    {
        $data = Printing::where('is_delete','!=','1')->get();
        return response()->json([
            'status' => "OK",
            'data'   => $data, 
        ]);
    }

    /*
     * List Of Print WITH PAGGING
     */
    public function listPaggingPrint(Request $request)
    {
        return response()->json(PrintService::listPrintPagging($request->all()), 200);
    }

     /*
     * Create Print
     */
    public function createPrint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required|string',
            'pe_film_1'         => 'required|integer',
            'pe_film_2'         => 'required|integer',
            'pe_film_3'         => 'required|integer',
            'price'             => 'required|array',
            'price.*.from'      => 'required|integer',
            'price.*.to'        => 'integer',
            'price.*.price'     => 'required|integer',
            'price.*.order_num' => 'integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $author = auth()->user();

        $printing = $request->except(['price']);
        $printing['created_by'] = $author->id;
        $printing['updated_by'] = $author->id;

        $prices = $request->only(['price'])['price'];

        $prService = new PrintService();
        try {
            $create = $prService->createPrint($printing,$prices);
            return response()->json([
                'status' => 201,
                'data'   => $create,
                'message'=> "Tạo mới thành công.", 
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message'   => "Đã xảy ra lỗi.", 
            ]);
        }
    }

    /*
     * Update Print
     */
    public function updatePrint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pe_film_1'         => 'required|integer',
            'pe_film_2'         => 'required|integer',
            'pe_film_3'         => 'required|integer',
            'price'             => 'required|array',
            'price.*.from'      => 'required|integer',
            'price.*.to'        => 'integer',
            'price.*.price'     => 'required|integer',
            'price.*.order_num' => 'integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $author = auth()->user();
        $printing = $request->except(['price']);
        $printing['updated_by'] = $author->id;

        $prices = $request->only(['price'])['price'];

        $prService = new PrintService();
        try {
            $result = $prService->updatePrint($printing,$prices);
            return response()->json([
                'status' => 201,
                'data'   => $result,
                'message' =>'Cập nhật thành công.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message'   => "Đã xảy ra lỗi.", 
            ]);
        }
    }

    /*
     * delete Print
     */
    public function deletePrint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $prService = new PrintService();
        try {
            $result = $prService->deletePrint($request->id);
            return response()->json([
                'status' => 200,
                'data'   => $result,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message'   => "Đã xảy ra lỗi.", 
            ]);
        }
    }
}
