<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

use function PHPUnit\Framework\isNull;

class HomeController extends Controller
{

    public function homePage(Request $request)
    {
        $user = auth()->user();
        if(isset($user)){
            return view('pages.home');
        }else{
            return redirect()->route('login');
        }
    }

    public function loginPage(Request $request)
    {
        $user = auth()->user();
        if(isset($user)){
            return redirect()->route('home');
        }else{
            return view('pages.auth.login');
        }
    }
}
