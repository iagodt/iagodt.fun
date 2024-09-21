<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itens extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'Price',
        'Icon',
        'Description',
        'Category',
        'discount',
        'Image1',
        'Image2',
        'Image3',
        'Image4',
        'Image5',
        'Image6',
        'installment',
        'Home'
    ];
}
