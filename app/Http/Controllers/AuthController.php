<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

     /**
     * 
     * SHOW VIEW LIST MEMBER
     *
     * @param Request $request 
     * @return view member
     */
    public function viewChangePW(Request $request)
    {
        return view('pages.auth.updatePass');
    }

    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Sai tên đăng nhập hoặc mật khẩu'], 401);
        }

        $user = auth()->user();
        if($user->is_delete == 1){
            return response()->json(['error' => 'Tài khoản của bạn đã bị xóa khỏi hệ thống'], 403);
        }
        return $this->createNewToken($token)->withCookie(cookie('token', $token, 120));
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request) {

        Auth::logout();
        return redirect('login');
    }

        /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        
        return response()->json(Auth::check());
        //return response()->json(auth()->user());
    }

        /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    public function changePW(Request $request){
    	$validator = Validator::make($request->all(), [
            'oldPW' => 'required',
            'newPW' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $user = auth()->user();

        if(Hash::check($request->oldPW,$user->password)){

            $newPw = User::find($user->id);
            $newPw->password = bcrypt($request->newPW);
            $newPw->save();
            
            return response()->json([
                'status' => '200',
                'message' => "Cập nhật thành công!"
            ],200);
        }else{
            return response()->json([
                'status' => '400',
                'message' => "Sai mật khẩu!"
            ],400);
        }
       
    }
}
