<?php

namespace App\Repository;

use App\Models\Printing;

class PrintRepository
{
    public static function listPrintPagging($param)
    {
        $result = array();
        $data =  Printing::where(function($query) use ($param){
                    if(isset($param['value'])){
                        $query->where('name', 'like','%'.$param['value'].'%');
                    }
                    })
                    ->where('is_delete','!=','1')
                    ->skip($param['length'] * $param['start'])->take($param['length'])->get();

        $result['recordsTotal'] = Printing::count();
        $result['recordsFiltered'] = Printing::count();
        $result['data'] = $data;
        return $result;
    }
}
