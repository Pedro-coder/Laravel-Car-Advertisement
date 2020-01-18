<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventVisitors extends Model
{
    //
    protected $table = 'event_visitors';
    protected $fillable = ['user_id', 'owner_id', 'event_id', 'event_modal_id','going_status'];
    
}
