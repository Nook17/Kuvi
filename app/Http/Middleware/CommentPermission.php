<?php

namespace Social\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Social\Comment;

class CommentPermission
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
  $comment_exists = Comment::where([
   'id'      => $request->comment,
   'user_id' => Auth::id(),
  ])->exists();

  if (!Auth::check() || !$comment_exists) {
   abort(403, 'Brak dostępu');
  }
  return $next($request);
 }
}
