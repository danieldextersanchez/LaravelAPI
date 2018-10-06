<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
class Admin extends Authenticatable
{
    public $table = "admin";
    //
    use Notifiable, HasApiTokens;

    protected $hidden = [
        'password', 'remember_token',
    ];
}


