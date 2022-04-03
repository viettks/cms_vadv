<?php

namespace App\Http\Controllers;

use App\Exports\ExportDebt;
use App\Service\DebtService;
use App\Service\MemberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class DebtController extends Controller
{
    public function index(Request $request)
    {
        $memberes = DB::table('users AS u')->get();
        return view('pages.debt')->with(compact('memberes'));
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
}
