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
        'width',
        'heigth',
        'quantity',
        'unit_price',
        'film_type',
        'amount',
        'created_by',
        'updated_by'
    ];
}
