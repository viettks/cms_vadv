<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\PrintSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrintController extends Controller
{
    public function viewCreate(Request $request)
    {
        return view('pages.settings.print');
    }


    //API

    /*
     * List Of Print
     */
    public function listPrint(Request $request)
    {
        $data = PrintSetting::get();
        return response()->json([
            'status' => "OK",
            'data'   => $data, 
        ]);
    }

     /*
     * Create Print
     */
    public function createPrint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required|string',
            'big_price'  => 'required|integer',
            'small_price'=> 'required|integer',
            'pe_film_1'  => 'required|integer',
            'pe_film_2'  => 'required|integer',
            'pe_film_3'  => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $author = auth()->user();
        $print = PrintSetting::create([
            'name'       => $request->name,
            'big_price'  => $request->big_price,
            'small_price'  => $request->small_price,
            'pe_film_1'  => $request->pe_film_1,
            'pe_film_2'  => $request->pe_film_2,
            'pe_film_3'  => $request->pe_film_3,
            'created_by' => $author->id,
            'updated_by' => $author->id
        ]);
        return response()->json([
            'status' => "OK",
            'data'   => $print, 
        ]);
    }

    /*
     * Update Print
     */
    public function updatePrint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'          => 'required|integer',
            'name'        => 'required|string',
            'big_price'   => 'required|integer',
            'small_price' => 'required|integer',
            'pe_film_1'   => 'required|integer',
            'pe_film_2'   => 'required|integer',
            'pe_film_3'   => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $author = auth()->user();
        $print = PrintSetting::where('id', $request->id)
                             ->update([ 'name'       => $request->name,
                                        'big_price'  => $request->big_price,
                                        'small_price'=> $request->small_price,
                                        'pe_film_1'  => $request->pe_film_1,
                                        'pe_film_2'  => $request->pe_film_2,
                                        'pe_film_3'  => $request->pe_film_3,
                                        'updated_by' => $author->id
                                      ]);
        return response()->json([
            'status' => "OK",
            'data'   => $print, 
        ]);
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
        $author = auth()->user();
        $print = PrintSetting::destroy($request->id);
        return response()->json([
            'status' => "OK",
            'data'   => [], 
        ]);
    }
}
