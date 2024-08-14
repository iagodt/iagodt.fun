<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarouselBanners extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'text above',
        'main text',
        'button text',
        'link'
    ];
}
