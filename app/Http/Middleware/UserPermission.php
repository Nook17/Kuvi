<?php

namespace Social\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserPermission
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
  if ((!Auth::check() || $request->user != Auth::id()) && !is_admin()) {
   abort(403, 'Brak dostępu');
  }
  return $next($request);
 }
}
