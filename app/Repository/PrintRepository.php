<?php

namespace App\Repository;

use App\Models\Printing;

class PrintRepository
{
    public static function listPrintPagging($param)
    {

        $result = array();
        
        $data = Printing::get();

        $result['recordsTotal'] = Printing::count();
        $result['recordsFiltered'] = Printing::count();
        $result['data'] = $data;
        return $result;
    }
}
