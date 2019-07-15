<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cartproduct extends Model
{
    //
    public function cart(){
        return $this->belongsTo('App\cart','cartid');
    }

    public function product(){
        return $this->hasMany('App\product','id','productid');
    }

    public function colour()
    {
        return $this->belongsTo("App\Colour",'colourid','id');
    }
    public function size()
    {
        return $this->belongsTo("App\Size",'sizeid','id');
    }
}
