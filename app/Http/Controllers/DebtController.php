<?php

namespace App\Http\Controllers;

use App\Service\DebtService;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.debt');
    }

    function getDebtes(Request $request){
        return response()->json(DebtService::getDebtes($request->all()), 200);
    }
}
