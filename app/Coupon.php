<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
	protected $table = 'coupon';
	protected $fillable = ['coupon_code', 'number_available', 'start_date', 'expiration_date','coupon_type','coupon_amount','criteria','used','shipping_method','selected_product'];
}