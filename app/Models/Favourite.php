<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    
	protected $table = 'favorites';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
		'user_id', 'favorited_user_id'
	];

	/**
     * The model have timestamps fields?
     *
     * @var boolean
     */
	protected $timestamps = false;

}
