<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "tb_order";

    protected $fillable = [
        "name",
        "phone",
        "address",
        "payment",
        "release",
        "amount",
        "note",
        "is_vat",
        "vat_fee",
        "status",
        "created_by",
        "updated_by"
    ];
}
