<?php

namespace Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
 use SoftDeletes;

 /**
  * The attributes that should be mutated to dates.
  *
  * @var array
  */
 protected $dates = ['deleted_at'];

 public function user()
 {
  return $this->belongsTo('Social\User', 'user_id');
 }

 public function comments()
 {
  if (is_admin()) {
   return $this->hasMany('Social\Comment')->withTrashed();
  } else {
   return $this->hasMany('Social\Comment');
  }
 }

 public function likes()
 {
  return $this->hasMany('Social\Like');
 }
}
