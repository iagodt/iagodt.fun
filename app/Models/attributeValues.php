<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attributeValues extends Model
{
    use HasFactory;

    protected $fillable = ['products_id', 'attribute_id', 'value'];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function attribute()
    {
        return $this->belongsTo(attributes::class);
    }
}
