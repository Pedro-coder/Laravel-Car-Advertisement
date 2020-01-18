<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    //
    protected $fillable = ['user_id', 'join_date','membership_type','membership_category','admin_code','status','cell_num','email','reference_id','reference_name','nid_no','instagram','facebook','linkedin','twitter','gender','nationality','date_of_birth','yearly_income','profession_name','profession_type','share_rate','blah','account_detail'];
}
