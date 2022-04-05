<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class ChartRepository
{
    public static function getDatas($param)
    {

        $date1 = $param['year'] . '-' .$param['month']. '-';
        $date2 = $date1 . '01';
        $userId = $param['user'];
        if($param['is_admin']){
            $sql = "
            SELECT 
            t1.*,
            t2.amount_pay
            FROM
            (
            SELECT 
                t.date,
                IFNULL(SUM(o.amount),0)  AS amount_get
            FROM
                (SELECT FROM_UNIXTIME(UNIX_TIMESTAMP(CONCAT( ? ,n)),'%Y-%m-%d') as Date from (
                    SELECT (((b4.0 << 1 | b3.0) << 1 | b2.0) << 1 | b1.0) << 1 | b0.0 as n
                            FROM (SELECT 0 UNION ALL SELECT 1) as b0,
                                 (SELECT 0 UNION ALL SELECT 1) as b1,
                                 (SELECT 0 UNION ALL SELECT 1) as b2,
                                 (SELECT 0 UNION ALL SELECT 1) as b3,
                                 (SELECT 0 UNION ALL SELECT 1) as b4 ) t
                        WHERE n > 0 AND n <= day(last_day( ? ))
                    ) AS t
                  LEFT JOIN tb_order o ON DATE_FORMAT( o.created_at, '%Y-%m-%d') = t.Date
            GROUP BY Date
            ) AS t1
            JOIN 
            (
            
            SELECT 
                t.date,
                IFNULL(SUM(r.amount),0)  AS amount_pay
            FROM
                (SELECT FROM_UNIXTIME(UNIX_TIMESTAMP(CONCAT( ? ,n)),'%Y-%m-%d') as Date from (
                    SELECT (((b4.0 << 1 | b3.0) << 1 | b2.0) << 1 | b1.0) << 1 | b0.0 as n
                            FROM (SELECT 0 UNION ALL SELECT 1) as b0,
                                 (SELECT 0 UNION ALL SELECT 1) as b1,
                                 (SELECT 0 UNION ALL SELECT 1) as b2,
                                 (SELECT 0 UNION ALL SELECT 1) as b3,
                                 (SELECT 0 UNION ALL SELECT 1) as b4 ) t
                        WHERE n > 0 AND n <= day(last_day( ? ))
                    ) AS t
                  LEFT JOIN tb_revenue r ON DATE_FORMAT( r.created_at, '%Y-%m-%d') = t.Date AND r.status = 2
            GROUP BY Date
            ) AS t2 ON t1.date = t2.date
            ORDER BY date
            ";
            $data = DB::select($sql,[$date1,$date2,$date1,$date2]);
        }else{
            $sql = "
            SELECT 
            t1.*,
            t2.amount_pay
            FROM
            (
            SELECT 
                t.date,
                IFNULL(SUM(o.amount),0)  AS amount_get
            FROM
                (SELECT FROM_UNIXTIME(UNIX_TIMESTAMP(CONCAT( ? ,n)),'%Y-%m-%d') as Date from (
                    SELECT (((b4.0 << 1 | b3.0) << 1 | b2.0) << 1 | b1.0) << 1 | b0.0 as n
                            FROM (SELECT 0 UNION ALL SELECT 1) as b0,
                                 (SELECT 0 UNION ALL SELECT 1) as b1,
                                 (SELECT 0 UNION ALL SELECT 1) as b2,
                                 (SELECT 0 UNION ALL SELECT 1) as b3,
                                 (SELECT 0 UNION ALL SELECT 1) as b4 ) t
                        WHERE n > 0 AND n <= day(last_day( ? ))
                    ) AS t
                  LEFT JOIN tb_order o ON DATE_FORMAT( o.created_at, '%Y-%m-%d') = t.Date AND o.created_by = ?
            GROUP BY Date
            ) AS t1
            JOIN 
            (
            
            SELECT 
                t.date,
                IFNULL(SUM(r.amount),0)  AS amount_pay
            FROM
                (SELECT FROM_UNIXTIME(UNIX_TIMESTAMP(CONCAT( ? ,n)),'%Y-%m-%d') as Date from (
                    SELECT (((b4.0 << 1 | b3.0) << 1 | b2.0) << 1 | b1.0) << 1 | b0.0 as n
                            FROM (SELECT 0 UNION ALL SELECT 1) as b0,
                                 (SELECT 0 UNION ALL SELECT 1) as b1,
                                 (SELECT 0 UNION ALL SELECT 1) as b2,
                                 (SELECT 0 UNION ALL SELECT 1) as b3,
                                 (SELECT 0 UNION ALL SELECT 1) as b4 ) t
                        WHERE n > 0 AND n <= day(last_day( ? ))
                    ) AS t
                  LEFT JOIN tb_revenue r ON DATE_FORMAT( r.created_at, '%Y-%m-%d') = t.Date AND r.status = 2 AND r.created_by = ?
            GROUP BY Date
            ) AS t2 ON t1.date = t2.date
            ORDER BY date
            ";
            $data = DB::select($sql,[$date1,$date2,$userId,$date1,$date2,$userId]);
        }
        return $data;
    }
}
