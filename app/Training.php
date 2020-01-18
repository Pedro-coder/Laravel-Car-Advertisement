<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    //
     protected $table = 'training';
	protected $fillable = ['title', 'image', 'youtube_link'];
}
