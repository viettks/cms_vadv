<?php

namespace App\Http\Controllers;

use App\Service\ChartService;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function getDatas(Request $request)
    {
        $param= $request->all();
        $user = auth()->user();
        $param['is_admin'] = $user->hasRole('ADMIN');
        $param['user'] = $user->id;

        return response()->json([
            'status' => 200,
            'data'   => ChartService::getDatas($param),
            'message'=> "OK.", 
        ]);
    }
}
