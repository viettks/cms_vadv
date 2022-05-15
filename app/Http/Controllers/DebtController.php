<?php

namespace App\Http\Controllers;

use App\Exports\ExportDebt;
use App\Models\Debt;
use App\Service\DebtService;
use App\Service\MemberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class DebtController extends Controller
{
    public function index(Request $request)
    {
        $memberes = DB::table('users AS u')->get();
        return view('pages.debt.index')->with(compact('memberes'));
    }

    public function viewCreate(Request $request)
    {
        $memberes = DB::table('users AS u')->get();
        return view('pages.debt.create')->with(compact('memberes'));
    }

    public function export(Request $request) 
    {
        $param = $request->all();
        $user = auth()->user();
        $param['is_admin'] = $user->hasRole('ADMIN');
        $param['user'] = $user->id;
        return Excel::download(new ExportDebt($param), 'Cong-no.xlsx');
    }

    function getDebtes(Request $request){
        $param = $request->all();
        $user = auth()->user();
        $param['is_admin'] = $user->hasRole('ADMIN');
        $param['user'] = $user->id;
        return response()->json(DebtService::getDebtes($param), 200);
    }

    function getInfo(Request $request){
        $param = $request->id;
        $user = auth()->user();
        $param['is_admin'] = $user->hasRole('ADMIN');
        $param['user'] = $user->id;
        return response()->json(DebtService::getDebtes($param), 200);
    }

    function createDebt(Request $request){
        $validator = Validator::make($request->all(), [
            'id'   => 'required',
            'amount'   => 'required',
            'payment'   => 'required',
            'fromdate'   => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        Log::info($request->all());

        $param = $request->all();
        $user = auth()->user();
        $param['user'] = $user->id;
        
        return response()->json([
            'status' => "OK",
            'data' => DebtService::createDebt($param), 
            'message' => 'Thành công.'
        ]);
    }

    function completeDebt(Request $request){
        $validator = Validator::make($request->all(), [
            'id'   => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        
        Debt::where('id', $request->id)->update(['status' => 1]);

        return response()->json([
            'status' => "OK",
            'data' => $request->id, 
            'message' => 'Thành công.'
        ]);
    }
}
