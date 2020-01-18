<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReaction extends Model
{
    protected $table = 'comment_reactions';
    protected $fillable = ['post_id', 'user_id','comment_reaction'];
}
