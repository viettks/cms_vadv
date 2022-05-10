<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'tb_order_detail';

    protected $fillable = [
        'order_id',
        'print_id',
        'print_name',
        "print_type",
        'machine1',
        'machine2',
        'width',
        "heigth",
        "size",
        'quantity',
        "unit_price",
        'total_size',
        'unit',
        'amount',
        'amount_display',
    ];

    public $timestamps = false;
}
