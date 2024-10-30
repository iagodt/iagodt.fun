<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'contact',
        'ship_info',
        'status',
        'total_amount'
    ];

    public function items()
{
    return $this->hasMany(itens_order::class, 'order_id');
}
}
