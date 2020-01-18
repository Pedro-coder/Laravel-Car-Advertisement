<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Advertisement extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'image',
        'adds_name',
        'adds_type',
        'image_link',
        'embed_code',
        'referral_code',
        'from_date',
        'to_date',
        'position',
        'style',
        'ads_post_on',
        'created_at',
    ];

    public function saveAdsData($data = [])
    {

        $rowData = [];
        foreach ($data as $key => $value) {
            if (!empty($value)){
                $rowData[$key] = $value;
            }
        }

        if (!empty($rowData)){
           self::create($rowData);
        }

    }
    public function updateAdsData($data = [], $id = 0)
    {

        $rowData = [];
        foreach ($data as $key => $value) {
            if (!empty($value)){
                $rowData[$key] = $value;
            }
        }

        if (!empty($rowData)){
           self::where('id',$id)->update($rowData);
        }

    }
    public function isUserHasPermission($userId){
        return DB::table('user_menu')->where('user_id',$userId)->where('menu_options_id',10)->get();
    }
}
