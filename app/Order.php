<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function cart()
    {
        return $this->belongsTo('\App\cart','cart_id','id');
    }

    public function user()
    {
        return $this->belongsTo('\App\User','user_id');
    }
}