<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;
    protected $table = 'tb_revenue';

    protected $fillable = [
        'name',
        'phone',
        'note',
        'amount',
        'url',
        'file_name',
        'status',
        'created_by',
        'updated_by'
    ];
}
