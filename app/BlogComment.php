<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $table = 'comment_post';
    protected $fillable = ['content', 'post_id', 'user_id','parent_comment_id'];
 
}
