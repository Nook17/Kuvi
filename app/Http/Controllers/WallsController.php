<?php

namespace Social\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Social\Post;
use Social\User;

class WallsController extends Controller
{
 public function __construct()
 {
  $this->middleware('auth');
 }

 public function index()
 {
  $friends = Auth::user()->friends();

  $friends_ids_array   = [];
  $friends_ids_array[] = Auth::id();

  foreach ($friends as $friend) {
   $friends_ids_array[] = $friend->id;
  }

  $posts = Post::whereIn('user_id', $friends_ids_array)
   ->orderBy('created_at', 'DESC')
   ->paginate(10);

  $user = User::find(Auth::id());

  return view('walls.index', compact('posts', 'user'));
 }
}
// var_dump($friend);
// exit;
