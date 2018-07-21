<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Social\User;

class SearchController extends Controller
{
 public function users(Request $request)
 {

  $search_phrase = $request->q;
  $search_result = User::where('name', 'like', '%' . $search_phrase . '%')->paginate(6);

  return view('/search.users', compact('search_result'));
 }
}
