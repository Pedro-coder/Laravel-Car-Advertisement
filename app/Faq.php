<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Faq extends Model
{
	protected $table = 'faq';
	protected $fillable = ['question', 'answer', 'image', 'youtube_link', 'category_id'];

	public function isUserHasPermission($userId)
    {
        return DB::table('user_menu')->where('user_id',$userId)->where('menu_options_id',15)->get();
    }
}
