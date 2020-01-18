<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['title', 'price', 'payment_status'];

    public function getPaidAttribute() {
    	if ($this->payment_status == 'Invalid') {
    		return false;
    	}
    	return true;
    }

    public function up()
	{
	     Schema::create('invoices', function (Blueprint $table) {
	         $table->increments('id');
	         $table->string('title');
	         $table->double('price', 2);
	         $table->string('payment_status')->nullable();
	         $table->string('recurring_id')->nullable();
	         $table->timestamps();
	    });
	}
}
