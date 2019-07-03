<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colour extends Model
{
    //
    protected $fillable = [
        'colour'
    ];

    public function products(Type $var = null)
    {
        return $this->belongsToMany(Product::class);
    }
}
