<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'category','installment','discount','description', 'images'];

    protected $casts = [
        'images' => 'array',
        'category' => 'array'
    ];
    
    public function attributeValues()
    {
        return $this->hasMany(attributeValues::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(attributes::class, 'attribute_values')->withPivot('value')->withTimestamps();
    }
}
