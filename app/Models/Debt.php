<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;

    public const ON_DEBT   = 0;
    public const PAY_OFF   = 1;

    protected $table = 'tb_debt';

    protected $fillable = [
        'order_id',
        'amount',
        "bill_code",
        'payment',
        'note',
        'status',
        'created_by',
        'updated_by'
    ];
}
