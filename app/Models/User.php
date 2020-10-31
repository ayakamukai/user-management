<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    protected $guarded = ['id'];

    Public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    Public function setZipAttribute($value)
    {
        $this->attributes['zip'] = str_replace('-', '', $value);
    }

    Public function setNoteAttribute($value)
    {
        $this->attributes['note'] = e($value);
    }

    Public static function scopeSearch($query, $request)
    {
    
      $name_key = $request->input('name_key'); 
      $id_key = $request->input('id_key');
      $sex_key = $request->input('sex_key');
      $pref_key = $request->input('pref_key');
      $from_key = $request->input('from_key');
      $until_key = $request->input('until_key');

      //検索
      if(!empty($name_key)){
        $query->where('name', 'like', '%'.$name_key.'%');
      }
      if(!empty($id_key)){
        $query->where('login_id', $id_key);
      }
      if(!empty($sex_key)){
        $query->where('sex', $sex_key);
      }
      if(!empty($pref_key)){
        $query->where('prefecture', $pref_key);
      }
      if(!empty($from_key) && !empty($until_key)){
          $query->whereBetween('created_at', [$from_key, $until_key]);
      }elseif(!empty($from_key) && empty($until_key)){
          $query->where('created_at', '>=', $from_key);
      }elseif(empty($from_key) && !empty($until_key)){
          $query->where('created_at', '<=', $until_key);
      }

      return $query;
    }

    public function bookmark()
    {
      return $this->hasMany('App\Models\Bookmark');
    }

}
