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

    Public function setPrefectureAttribute($value){
        if($value = '選択して下さい'){
            $this->attributes['prefecture'] = null;
        }
    }

    Public function setZipAttribute($value){
        $this->attributes['zip'] = str_replace('-', '', $value);
    }

}
