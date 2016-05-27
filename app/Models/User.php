<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /* GEOPAGOS : using email as username */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'age'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
    * Model Relations
    */
    
    //this is a NaN relation with users_payments
    public function payments () {
        return $this->belongsToMany('App\Models\Payment', 'users_payments', 'user_id', 'payment_id');
    }

    public function favorites () {
        return $this->hasMany('App\Models\Favourite', 'user_id');
    }

}
