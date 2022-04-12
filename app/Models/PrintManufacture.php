<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintManufacture extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'tb_print_sub_manufacture';

    protected $fillable = [
        'name',
        'sub_type',
        'print_id',
    ];

    public $timestamps = false;
}
