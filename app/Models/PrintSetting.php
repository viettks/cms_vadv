<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintSetting extends Model
{
    use HasFactory;

    protected $table = 'tb_print';

    protected $fillable = [
        'name',
        'big_price',
        'small_price',
        'pe_film_1',
        'pe_film_2',
        'pe_film_3',
        'created_by',
        'updated_by'
    ];
}
