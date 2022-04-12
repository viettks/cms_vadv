<?php

namespace App\Service;

use App\Models\Printing;
use App\Models\PrintManufacture;
use App\Models\PrintPrice;
use App\Models\PrintSub;
use App\Repository\PriceRepository;
use App\Repository\PrintRepository;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PrintService
{

    public function getPriceDetails()
    {
        $price =  new PriceRepository();
        return $price->getAllPriceDetail();
    }

    public static function getAllPagging($param)
    {
        return PrintRepository::getAllPagging($param);
    }

    //CREATE PRINT AND PRICE
    public static function createPrint($print, $manufac1, $manufac2)
    {
        try {
            DB::beginTransaction();
            $result = PrintSub::create($print);
            if(sizeof($manufac1) > 0){
                foreach ($manufac1 as $manu) {
                    $manu["print_id"] = $result->id;
                    $manu["sub_type"] = "01";
                    PrintManufacture::create($manu);
                }
            }
            if(sizeof($manufac2) > 0){
                foreach ($manufac2 as $manu) {
                    $manu["print_id"] = $result->id;
                    $manu["sub_type"] = "02";
                    PrintManufacture::create($manu);
                }
            }
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new Exception("Lỗi tạo in");
        }
    }

        //UPDATE MANUFACTURE
        public static function updatePrint($id, $manufac1, $manufac2)
        {
            try {
                DB::beginTransaction();

                PrintManufacture::where("print_id",$id)->delete();
                if(sizeof($manufac1) > 0){
                    foreach ($manufac1 as $manu) {
                        $manu["print_id"] = $id;
                        $manu["sub_type"] = "01";
                        PrintManufacture::create($manu);
                    }
                }
                if(sizeof($manufac2) > 0){
                    foreach ($manufac2 as $manu) {
                        $manu["print_id"] = $id;
                        $manu["sub_type"] = "02";
                        PrintManufacture::create($manu);
                    }
                }

                DB::commit();
                return ["id"=>$id];
            } catch (Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                throw new Exception("Lỗi cập nhật in");
            }
        }
        
        //CREATE PRINT AND PRICE
        public function deletePrint($print_id)
        {
            try {
                DB::beginTransaction();
                Printing::where('id','=',$print_id)->update(["is_delete",1]);
                DB::commit();
                return $print_id;
            } catch (Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                throw new Exception("Lỗi xóa in");
            }
        }

}
