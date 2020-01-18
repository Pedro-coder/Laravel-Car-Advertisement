<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqParent extends Model
{
    protected $table = 'faq_parents';
    protected $guarded = [];

    public function categories(){
        return $this->hasMany(FaqCategory::class, 'faq_parent_id', 'id');
    }
}
