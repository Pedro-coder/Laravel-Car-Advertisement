<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['mail_username', 'mail_password', 'pusher_app_id', 'pusher_app_key', 'pusher_app_secret', 'pusher_app_cluster','file_size','about'];
}
