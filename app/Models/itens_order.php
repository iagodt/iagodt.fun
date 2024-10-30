<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itens_order extends Model
{
    use HasFactory;

    protected $fillable = [

        'order_id',
        'product_id',
        'price',
        'quatity'
    ];
}
