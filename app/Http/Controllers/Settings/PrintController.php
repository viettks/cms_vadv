<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Printing;
use App\Models\PrintManufacture;
use App\Models\PrintPrice;
use App\Models\PrintSub;
use App\Service\PrintService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\VarDumper;

class PrintController extends Controller
{
    //TẠO MỚI LOẠI IN
    public function viewCreate1(Request $request)
    {
        return view('pages.settings.print.create-1');
    }

    //TẠO LOẠI IN SUB
    public function viewCreate2(Request $request)
    {
        return view('pages.settings.print.create-2');
    }

    public function viewList(Request $request)
    {
        return view('pages.settings.print.list-print');
    }

    public function viewUpdate1(Request $request)
    {
        $id = $request->id;
        $printing = PrintSub::where('is_delete', '!=', 1)->find($id);
        if (!isset($printing)) {
            abort(404);
        }

        $manufac1 = PrintManufacture::where(["print_id" => $id, "sub_type" => 1])->get();
        $manufac2 = PrintManufacture::where(["print_id" => $id, "sub_type" => 2])->get();

        return view('pages.settings.print.update-1')->with(compact('printing', 'manufac1', 'manufac2'));
    }

    
    public function viewUpdate2(Request $request)
    {
        $id = $request->id;
        $printing = PrintSub::where('is_delete', '!=', 1)->find($id);
        if (!isset($printing)) {
            abort(404);
        }

        $manufac1 = PrintManufacture::where(["print_id" => $id, "sub_type" => 1])->get();
        $manufac2 = PrintManufacture::where(["print_id" => $id, "sub_type" => 2])->get();
        $manufac3 = PrintManufacture::where(["print_id" => $id, "sub_type" => 3])->get();

        return view('pages.settings.print.update-2')->with(compact('printing', 'manufac1', 'manufac2','manufac3'));
    }

    //API

    /*
     * List Of Print
     */
    public function getAll(Request $request)
    {
        $data = Printing::where('is_delete', '!=', '1')->get();
        return response()->json([
            'status' => "OK",
            'data'   => $data,
        ]);
    }

    /*
     * List Of Print WITH PAGGING
     */
    public function getAllPagging(Request $request)
    {
        return response()->json(PrintService::getAllPagging($request->all()), 200);
    }

    /*
     * List Of Print WITH PAGGING
     */
    public function getInfo(Request $request)
    {
        $id = $request->id;

        $manufac1 = PrintManufacture::where(["print_id" => $id, "sub_type" => 1])->get();
        $manufac2 = PrintManufacture::where(["print_id" => $id, "sub_type" => 2])->get();
        $manufac3 = PrintManufacture::where(["print_id" => $id, "sub_type" => 3])->get();

        return response()->json([
            'status' => 200,
            'data'   => [
                "id" => $id,
                "manufac1" => $manufac1,
                "manufac2" => $manufac2,
                "manufac3" => $manufac3,
            ],
            'message' => "Lấy thông tin thành công.",
        ], 200);
    }

    /*
     * Create Print
     */
    public function createPrint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'type_name'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $author = auth()->user();

        $printing = $request->except(["manufac_1", "manufac_2", "machine3"]);
        $printing['created_by'] = $author->id;
        $printing['updated_by'] = $author->id;

        $scId = $request->SCID;

        $machine3 = $request->machine3;
        $manufac1 = $request->manufac_1;
        $manufac2 = $request->manufac_2;

        try {
            $result = null;
            if ($scId === "ADDSUBPRINT") {
                $result = PrintService::createPrintType2($printing, $manufac1, $manufac2, $machine3);
            } else {
                $result = PrintService::createPrint($printing, $manufac1, $manufac2);
            }

            return response()->json([
                'status' => 201,
                'data'   => $result,
                'message' => "Tạo mới thành công.",
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message'   => "Đã xảy ra lỗi.",
            ], 500);
        }
    }

    /*
     * Update Print
     */
    public function updatePrint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        try {

            $id = $request->id;
            $manufac1 = $request->manufac_1;
            $manufac2 = $request->manufac_2;
            $machine3 = $request->machine3;

            $result = PrintService::updatePrint($id, $manufac1, $manufac2,$machine3);
            return response()->json([
                'status' => 201,
                'data'   => $result,
                'message' => 'Cập nhật thành công.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message'   => "Đã xảy ra lỗi.",
            ]);
        }
    }

    /*
     * delete Print
     */
    public function deletePrint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            $id = $request->id;
            PrintManufacture::where(["print_id" => $id])->delete();
            PrintSub::where('id', '=', $id)->delete();

            return response()->json([
                'status' => 200,
                'message'   => "Xóa thành công",
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message'   => "Đã xảy ra lỗi.",
            ]);
        }
    }
}
