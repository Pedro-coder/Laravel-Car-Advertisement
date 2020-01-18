<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;

use App\Setting;
use App\PostCategory;

class SettingsController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $postCats = PostCategory::get();
        // dd($postCats);

        return view('pages.settings.index')->withSetting($setting)->withPostCats($postCats);

    }

    public function updateEnv(Request $request)
    {
        $setting = Setting::first();

        if (! $setting) {
            $setting = Setting::firstOrCreate([]);
        }
        
        try {
            $setting->update($request->except('_token'));
            if ($setting) {
                $mail_username= $setting->mail_username;
                $mail_password= $setting->mail_password;
                \Config::set('mail.username', $mail_username);
                \Config::set('mail.password', $mail_password);
            }
        } catch (\Exception $e) {
            Session::flash('failure', 'Server error: ' . $e->getMessage());
        }
        
        Session::flash('success', 'Settings updated');
        return redirect()->back();
    }

    protected function setEnvironmentValue(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {

                $str .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }

            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        return true;

    }
    public function aboutUsPage(){
        $setting = Setting::first();
        $about_us = $setting->about;
        return view('about_us', compact('about_us'));
    }

    public function updatePaypalEmailId(Request $request) {
        $setting = Setting::first();
        $setting->paypal_email = $request->input('email_id');
        $setting->paypal_client_id = $request->input('client_id');
        $setting->paypal_secret_id = $request->input('client_secret');
        $setting->save();
        Session::flash('success', 'Settings updated');
        return redirect()->back();
    }
    public function display(Request $request){
        $setting = Setting::first();
        $setting->view_style =  $request->input('display');
        $setting->save();
        Session::flash('success', 'Settings updated');
        return redirect()->back();
    }
}
