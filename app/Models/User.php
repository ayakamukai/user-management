<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{

    protected $guarded = ['id'];

    Public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }

}
