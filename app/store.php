<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class store extends Model
{
    /*
    * ATTRIBUES FOR MASS FILLING
    */
    protected $fillable = [
        'ownername',
        'ownerphone',
        'owneraddress',
        'businessemail',
        'owneremail',
        'city',
        'state',
        'idcardno',
        'idcardtype'
    ];

    /*
    * CREATE INVERSE RELATIONSHIP FOR USER TABLE
    */ 
    public function user()
    {
        return $this->belongsTo('App\User','email','owneremail');
    }

    /*
    * CREATE RELATIONSHIP FOR STORE AND IT'S PRODUCTS
    */ 
    public function products()
    {
        return $this->hasMany('App\Product','storeid','id');
    }
    
}
