<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostBid extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function buyer()
    {
        return static::leftjoin('buyers',function($q){
           $q->on('buyers.id','=','post_bids.reference_id');
           $q->where('post_bids.bid_type','=','buy');
        })->first();
    }
}
