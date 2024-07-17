<?php

namespace App\Models;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'password',
    ];

    protected $attributes = ["verified" => false];
    /**
     * The attributes that should be hidden for serialization.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = true;

}
