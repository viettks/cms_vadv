<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintSub extends Model
{
    use HasFactory;
    protected $table = 'tb_print_sub';

    protected $fillable = [
        'name',
        'sub_name',
        'price_type',
        'type_name',
        'is_delete',
        'created_by',
        'updated_by'
    ];
}
