<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PriceRepository
{
    public function getPrice($print_id,$size)
    {
        $sql = 'SELECT * FROM tb_print p JOIN tb_print_price pp ON p.id = pp.print_id
        WHERE 
        p.id = ?
        AND pp.from <= ?
        ORDER BY pp.from DESC
        LIMIT 1';
        $result = DB::select($sql,[$print_id,$size])[0];
        if(!isset($result)){
            $sql = 'SELECT * FROM tb_print p JOIN tb_print_price pp ON p.id = pp.print_id
            WHERE 
            p.id = ?
            ORDER BY pp.from ASC
            LIMIT 1';

            $result = DB::select($sql,[$print_id,$size])[0];
        }

        return $result;
    }

    public function getAllPriceDetail()
    {
        $sql = 'SELECT p.id,
        p.pe_film_1,
        p.pe_film_2,
        p.pe_film_3,
        pp.from,
        pp.price
        FROM tb_print p 
        JOIN tb_print_price pp ON p.id = pp.print_id
        ORDER BY p.id,pp.from DESC';
        $result = DB::select($sql);
        return $result;
    }
}
