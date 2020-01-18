<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    public function User(){
        return $this->belongsTo('App\User');
    }

    public function Product(){
        return $this->belongsTo('App\product');
    }
}
