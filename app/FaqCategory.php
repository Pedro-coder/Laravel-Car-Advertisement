<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    protected $table = 'faq_categories';
    protected $guarded = [];

    public function parent(){
        return $this->belongsTo(FaqParent::class,'faq_parent_id', 'id');
    }
}
