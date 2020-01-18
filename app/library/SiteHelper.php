<?php
/**
 * Created by PhpStorm.
 * User: Hamid Raza
 * Date: 12/2/2018
 * Time: 6:16 PM
 */

namespace App\library;


use App\Advertisement;
use App\Follow;

class SiteHelper
{
    public static function getTopAds($adsPostOn = 'profile', $userId)
    {
        $advertisement = new Advertisement();
        if ($adsPostOn == 'profile') {
            $advertisement = $advertisement->where('user_id', $userId);
        }
        $topAds = $advertisement->where('ads_post_on', $adsPostOn)->where(function ($query) {
            $query->where('from_date', '<=', date('Y-m-d'));
            $query->where('to_date', '>=', date('Y-m-d'));
        })->where('style', 'scroll')->where('position', 'top')->get();
        return $topAds;

    }

    public static function getLeftAds($adsPostOn = 'profile', $userId)
    {
        $advertisement = new Advertisement();
        if ($adsPostOn == 'profile') {
            $advertisement = $advertisement->where('user_id', $userId);
        }
        $leftAds = $advertisement->where('ads_post_on', $adsPostOn)->where(function ($query) {
            $query->where('from_date', '<=', date('Y-m-d'));
            $query->where('to_date', '>=', date('Y-m-d'));
        })->where('style', 'scroll')->where('position', 'left')->get();
        return $leftAds;
    }

    public static function getRightAds($adsPostOn = 'profile', $userId)
    {
        $advertisement = new Advertisement();
        if ($adsPostOn == 'profile') {
            $advertisement = $advertisement->where('user_id', $userId);
        }
        $rightAds = $advertisement->where('ads_post_on', $adsPostOn)->where(function ($query) {
            $query->where('from_date', '<=', date('Y-m-d'));
            $query->where('to_date', '>=', date('Y-m-d'));
        })->where('style', 'scroll')->where('position', 'right')->get();
        return $rightAds;
    }

    public static function getBottomAds($adsPostOn = 'profile', $userId)
    {
        $advertisement = new Advertisement();
        if ($adsPostOn == 'profile') {
            $advertisement =  $advertisement->where('user_id', $userId);
        }
        $bottomAds = $advertisement->where('ads_post_on', $adsPostOn)->where(function ($query) {
            $query->where('from_date', '<=', date('Y-m-d'));
            $query->where('to_date', '>=', date('Y-m-d'));
        })->where('style', 'scroll')->where('position', 'bottom')->get();
        return $bottomAds;
    }

    public static function getPopupAds($adsPostOn = 'profile', $userId)
    {
        $advertisement = new Advertisement();
        if ($adsPostOn == 'profile') {
            $advertisement = $advertisement->where('user_id', $userId);
        }
        $bottomAds = $advertisement->where('ads_post_on', $adsPostOn)->where(function ($query) {
            $query->where('from_date', '<=', date('Y-m-d'));
            $query->where('to_date', '>=', date('Y-m-d'));
        })->where('style', 'popup')->get();
        return $bottomAds;
    }


}