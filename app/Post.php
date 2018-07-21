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
}
