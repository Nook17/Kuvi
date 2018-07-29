<?php

namespace Social;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
 use Notifiable;

 /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
 protected $fillable = [
  'name', 'email', 'gender', 'role_id', 'password',
 ];

 /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
 protected $hidden = [
  'password', 'remember_token',
 ];

 public function friendsOfOther()
 {
  return $this->belongsToMany('Social\User', 'friends', 'user_id', 'friend_id')->wherePivot('accepted', 1);
 }

 public function friendsOfMine()
 {
  return $this->belongsToMany('Social\User', 'friends', 'friend_id', 'user_id')->wherePivot('accepted', 1);
 }

 public function friends()
 {
  return $this->friendsOfOther->merge($this->friendsOfMine);
 }

 public function posts()
 {
  return $this->hasMany('Social\Post')->orderBy('created_at', 'DESC');
 }

 public function role()
 {
  return $this->belongsTo('Social\Role');
 }

 public function likes()
 {
  return $this->hasMany('Social\Like');
 }

}
