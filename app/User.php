<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;



class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasRoles , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','active', 'activation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','activation_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates=['deleted_at'];

    public function posts()
    {
        return $this->belongsToMany('posts');
    }


    // public function quizzes()
    // {
    //     return $this->belongsToMany('quizzes');
    // }
}
