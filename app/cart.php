<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    //

    public function cartProducts(){
        return $this->hasMany('App\cartproduct','cartid');
    }

    public function cartOwner(){
        return $this->belongsTo('App\user','userid');
    }

    
}
