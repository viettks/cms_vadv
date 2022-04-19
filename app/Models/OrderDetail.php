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
        'print_name',
        'manufac1',
        "manufac2",
        'width',
        'heigth',
        'quantity',
        "total",
        "unit_name",
        'unit_price',
        "unit_type",
        'film_type',
        'amount',
    ];

    public $timestamps = false;
}
