<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;

    public const UNDER_15  = 0;
    public const OVER_15   = 1;
    public const LONG_TIME = 2;
    public const PAY_OFF   = 3;

    protected $table = 'tb_debt';

    protected $fillable = [
        'order_id',
        'amount',
        'payment',
        'note',
        'status',
        'created_by',
        'updated_by'
    ];
}
