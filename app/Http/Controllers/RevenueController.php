<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use App\Service\RevenueService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RevenueController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.revenue');
    }

    public function getRevenues(Request $request)
    {
        $param = $request->all();
        return response()->json(RevenueService::getRevenues($param), 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'amount' => 'required',
            'file' => 'required',
            'note'=> 'required',
            ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $file = $request->file;
        $fileName =  now()->timestamp .$file->getClientOriginalName();
        $url =  $file->move('upload/revenue', $fileName);
        $revenue = $request->only(['name','amount','note']);
        $revenue['url'] = $url;
        $revenue['file_name'] = $fileName;
        $author = auth()->user();
        $revenue['created_by'] = $author->id;
        $result = Revenue::create($revenue);
        return response()->json([
            'status' => 201,
            'data'   => $result,
            'message'=> "Tạo mới thành công.", 
        ]);
    }
}
