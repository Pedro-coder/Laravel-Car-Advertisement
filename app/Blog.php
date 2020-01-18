<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $table = 'blog_posts';
    protected $fillable = ['heading', 'content', 'image', 'user_id','published_at','comment_count','checkbox','read_amount'];

    public function User(){
        return $this->belongsTo('App\User');
    }
    protected $casts = [
        'read_amount' => 'float',
    ];
}
