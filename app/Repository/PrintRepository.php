<?php

namespace App\Repository;

use App\Models\Printing;
use App\Models\PrintSub;

class PrintRepository
{
    //GET PRINT WITH PAGGING
    public static function getAllPagging($param)
    {
        $result = array();
    
        $eloquent =  PrintSub::where(function($query) use ($param){
                        if(isset($param['value'])){
                            $query->where('name', 'like','%'.$param['value'].'%');
                        }
                    })
                    ->where('is_delete','!=','1');
        $count = $eloquent->count();
        $dataSet = $eloquent->skip($param['length'] * $param['start'])->take($param['length'])->get();
        $result['recordsTotal'] = $count;
        $result['recordsFiltered'] = $count;
        $result['data'] = $dataSet;
        return $result;

        // $result = array();
        // $data =  Printing::where(function($query) use ($param){
        //             if(isset($param['value'])){
        //                 $query->where('name', 'like','%'.$param['value'].'%');
        //             }
        //             })
        //             ->where('is_delete','!=','1')
        //             ->skip($param['length'] * $param['start'])->take($param['length'])->get();

        // $result['recordsTotal'] = Printing::count();
        // $result['recordsFiltered'] = Printing::count();
        // $result['data'] = $data;
        // return $result;
    }
}
