<?php

namespace App\Http\Controllers;

use App\Exports\ExportRevenue;
use App\Models\Revenue;
use App\Service\RevenueService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class RevenueController extends Controller
{
    public function index(Request $request)
    {
        $memberes = DB::table('users AS u')->get();
        return view('pages.revenue')->with(compact('memberes'));
    }
    
    public function export(Request $request) 
    {
        $param = $request->all();
        $user = auth()->user();
        $param['is_admin'] = $user->hasRole('ADMIN');
        $param['user'] = $user->id;
        return Excel::download(new ExportRevenue($param), 'Phieu-chi.xlsx');
    }

    public function getRevenues(Request $request)
    {
        $param = $request->all();
        $user = auth()->user();
        $param['is_admin'] = $user->hasRole('ADMIN');
        $param['user'] = $user->id;
        return response()->json(RevenueService::getRevenues($param), 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'amount' => 'required',
            'file' => 'required',
            'note'=> 'required',
            ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $file = $request->file;
        $fileName =  $file->getClientOriginalName();
        $url =  $file->move('upload/revenue', now()->timestamp.$fileName);
        $revenue = $request->only(['name','amount','note',"phone"]);
        $revenue['url'] = now()->timestamp.$fileName;
        $revenue['file_name'] = $fileName;
        $author = auth()->user();
        $revenue['created_by'] = $author->id;
        $result = Revenue::create($revenue);
        return response()->json([
            'status' => 201,
            'data'   => $result,
            'message'=> "T???o m???i th??nh c??ng.", 
        ]);
    }

    public function approve(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required',
            ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $author = auth()->user();
        $revenue = Revenue::find($request->id);
        $revenue->status = $request->status;
        $revenue->updated_by = $author->id;
        $revenue->save();
        return response()->json([
            'status' => 201,
            'data'   => $revenue,
            'message'=> "C???p nh???t th??nh c??ng.", 
        ]);
    }

    public function getFile(Request $request)
    {
        $filepath = public_path('upload/revenue/'.$request->file);
        return Response()->download($filepath);
    }

}
