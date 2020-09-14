<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Crypt;

class User extends Model
{

    protected $guarded = ['id'];

    Public function getPasswordAttribute($value){
        return Crypt::decrypt($value);
    }

    Public function setPasswordAttribute($value){
        $this->attributes['password'] = Crypt::encrypt($value);
    }
}
