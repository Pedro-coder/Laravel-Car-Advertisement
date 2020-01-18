<?php
    
namespace App\Traits;

use App\Setting;

trait PusherTrait
{
    public function initPusherConfig()
    {
        $setting = Setting::first();

        config([
            'app.broadcasting.connections.pusher.key' => $setting->pusher_app_key,
            'app.broadcasting.connections.pusher.secret' => $setting->pusher_app_secret,
            'app.broadcasting.connections.pusher.app_id' => $setting->pusher_app_id,
            'app.broadcasting.connections.pusher.options.cluster' => $setting->pusher_app_cluster
        ]);
    }
}