<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attributes extends Model
{
    use HasFactory;

    protected $fillable = ['name','type'];

    public function attributeValues(){

        return $this->hasMany(attributeValues::class);
    }

    
}
