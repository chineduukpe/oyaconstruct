<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    //
    protected $fillable = [
        'size'
    ];

    public function products(Type $var = null)
    {
        return $this->belongsToMany(Product::class);
    }

    public function productPrice(){
        return $this->hasOne(ProductPrice::class);
    }
    
}
