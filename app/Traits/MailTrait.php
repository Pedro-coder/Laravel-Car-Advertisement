<?php
    
namespace App\Traits;

use App\Setting;

trait MailTrait
{
    public function initMailConfig()
    {
        $setting = Setting::first();

        config([
            'app.mail.username' => $setting->mail_username,
            'app.mail.password' => $setting->mail_password
        ]);
    }
}