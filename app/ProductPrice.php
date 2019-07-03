<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    //
    public  $timestamps = false;
    protected $fillable = [
      'product_id','size_id','price'
    ];

    public function size(){
        return $this->hasOne('App\Size','id','size_id');
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
