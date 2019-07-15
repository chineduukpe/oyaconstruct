<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    //
    public $incrementing = false;
    public function user(Type $var = null)
    {
        return $this->belongsTo(User::class);
    }
}
