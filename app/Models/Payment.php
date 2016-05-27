<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
	protected $table = 'payments';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
		'amount', 'created_at'
	];

	/**
     * The model have timestamps fields?
     *
     * @var boolean
     */
	protected $timestamps = false;


	/**
    * Model Relations
    */

    //this is a NaN relation 
	public function users () {
        return $this->belongsToMany('App\Models\User', 'users_payments', 'payment_id', 'user_id');
    }



}
