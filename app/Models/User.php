<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{

    protected $guarded = ['id'];

    public function getSexAttribute($value)
    {
        if($value == 'male'){
            return '男';
        }elseif($value == 'female'){
            return '女';
        }
    }

    Public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }

    Public function setZipAttribute($value){
        $this->attributes['zip'] = str_replace('-', '', $value);
    }

    Public function setNoteAttribute($value){
        $this->attributes['note'] = e($value);
    }

}
