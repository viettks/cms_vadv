<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Service\MemberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * MemberController
 * 
 * 
 * @package    Controller
 * @subpackage Settings
 * @author     VIETNT
 */
class MemberController extends Controller
{
    /**
     * 
     * SHOW VIEW LIST MEMBER
     *
     * @param Request $request 
     * @return view member
     */
    public function viewList(Request $request)
    {
        $roles = Role::all()->reverse();
        return view('pages.settings.member')->with(compact('roles'));
    }

    //API

    /**
     * 
     * SHOW LIST MEMBER
     *
     * @param Request $request (value)
     * @return json list member
     */
    public function getListMember(Request $request)
    {
        return response()->json(MemberService::getListMember($request->all()), 200);
    }

        /**
     * 
     * MEMBER INFO
     *
     * @param Request $request (value)
     * @return json member
     */
    public function getInfo(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        return response()->json([
            "data" => $user
        ], 201);
    }

    /**
     * 
     * CREATE MEMBER
     *
     * @param Request $request (value)
     * @return json member
     */
    public function createMember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_name' => 'required',
            'password' => 'required',
            'role_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $countUserName = User::where('user_name','=',$request->user_name)->count();
        if($countUserName > 0){
            return response()->json([
                'message' => 'Tên đăng nhập đã tồn tại trên hệ thống!',
                'status' => 409
            ], 409);
        }

        $user = User::create(array_merge(
                            $validator->validated(),
                            ['password' => bcrypt($request->password)]
                    ));

        return response()->json([
            'message' => 'Tạo mới thành công!',
            'status' => 201,
            "data" => $user
        ], 201);
    }
    
    /**
     * 
     * UPDATE MEMBER
     *
     * @param Request $request (value)
     * @return json member
     */
    public function updateMember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'password' => 'required',
            'role_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $result = User::find($request->id);
        $result->password = bcrypt($request->password);
        $result->role_id = $request->role_id;
        $result->save();

        return response()->json([
            'message' => 'Cập nhật thành công!',
            'status' => 201,
            "data" => $result
        ], 201);
    }

    /**
     * 
     * DELETE MEMBER
     *
     * @param Request $request (value)
     * @return json member
     */
    public function deleteMember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $result = User::find($request->id);
        $result->is_delete = 1;
        $result->save();

        return response()->json([
            'message' => 'Xóa thành công!',
            'status' => 201,
            "data" => $result
        ], 201);
    }
}
