<?php

namespace App\Service;

use App\Models\Printing;
use App\Models\PrintPrice;
use App\Repository\PriceRepository;
use App\Repository\PrintRepository;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PrintService
{

    //CREATE PRINT AND PRICE
    public function createPrint($print, $prices)
    {
        try {
            DB::beginTransaction();
            $result = Printing::create($print);
            foreach ($prices as $price) {
                $price['print_id']   = $result->id;
                $price['created_by'] = $result->created_by;
                $price['updated_by'] = $result->created_by;
                PrintPrice::create($price);
            }
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new Exception("Lỗi tạo in");
        }
    }

        //UPDATE PRINT AND PRICE
        public function updatePrint($print, $prices)
        {
            try {
                DB::beginTransaction();

                $param = Arr::except($print, ['id']);

                $result = Printing::where('id', $print['id'])
                          ->update($param);

                PrintPrice::where('print_id','=',$print['id'])->delete();
                foreach ($prices as $price) {
                    $price['print_id']   = $print['id'];
                    $price['created_by'] = $print['updated_by'];
                    $price['updated_by'] = $print['updated_by'];
                    PrintPrice::create($price);
                }
                DB::commit();
                return $print;
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

        public function getPriceDetails()
        {
            $price =  new PriceRepository();
            return $price->getAllPriceDetail();
        }

    public static function listPrintPagging($param)
    {
        return PrintRepository::listPrintPagging($param);
    }
}
