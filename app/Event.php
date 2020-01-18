<?php

namespace App;

use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use Favoriteable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function eventModals()
    {
        return $this->hasMany(EventModal::class, 'event_id');
    }


}
