<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    /**
    * CREATE INVERSE RELATIONSHIP FOR PRODUCT AND IT'S STORE
    */
    public function store()
    {
        return $this->belongsTo('App\Store','storeid','id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }

    public function colours()
    {
        return $this->belongsToMany(Colour::class);
    }

    public function pictures()
    {
        return $this->hasMany('App\Picture','productid');
    }

    public function productPrices(){
        return $this->hasMany(ProductPrice::class);
    }
    
}
