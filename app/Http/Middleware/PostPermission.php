<?php

namespace Social\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Social\Post;

class PostPermission
{
 /**
  * Handle an incoming request.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \Closure  $next
  * @return mixed
  */
 public function handle($request, Closure $next)
 {
  $post_exists = Post::where([
   'id'      => $request->post,
   'user_id' => Auth::id(),
  ])->exists();

  if (!Auth::check() || !$post_exists) {
   abort(403, 'Brak dostępu');
  }
  return $next($request);
 }
}
