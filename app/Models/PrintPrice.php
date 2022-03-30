<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintPrice extends Model
{
    use HasFactory;

    protected $table = 'tb_print_price';

    protected $fillable = [
        'print_id',
        'from',
        'to',
        'price',
        'order_num',
        'created_by',
        'updated_by'
    ];
}
