<?php

namespace Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
 use SoftDeletes;
 protected $dates = ['deleted_at'];

 public function user()
 {
  return $this->belongsTo('Social\User');
 }

 public function likes()
 {
  return $this->hasMany('Social\Like');
 }
}
