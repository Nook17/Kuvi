<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Social\User;

class SearchController extends Controller
{
 public function users(Request $request)
 {
  $search_phrase = $request->q;
  $search_result = User::where('name', 'like', '%' . $search_phrase . '%')->paginate(6);

  $user = User::find(Auth::id());
  return view('/search.users', compact('search_result', 'user'));
 }
}
