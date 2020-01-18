<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    //
    protected $table = 'examination';
	protected $fillable = ['question', 'answer', 'image', 'youtube_link'];
}
