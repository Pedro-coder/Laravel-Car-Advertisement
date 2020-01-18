<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TempEventDateTime extends Model
{
	protected $table = 'temp_event_date_time';
	protected $fillable = ['temp_event_id', 'start_date', 'start_hours', 'start_minit', 'start_type', 'end_date', 'end_hours', 'end_minit', 'end_type','goingstatus','created_at','updated_at'];
}