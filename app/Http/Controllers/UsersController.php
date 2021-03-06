<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Social\Post;
use Social\User;

class UsersController extends Controller
{
 public function __construct()
 {
  $this->middleware('user_permission', ['except' => ['show']]);
 }

 public function show($id)
 {
  $user = User::find($id);
  // $posts = $user->posts()->get();   // Niewydajne rozwiązanie

  if (is_admin()) {
   $posts = Post::with('comments.user') // Eager Loading (optymalizacja zapytań do bazy)
    ->with('likes')
    ->with('comments.likes')
    ->where('user_id', $id)
    ->withTrashed()
    ->orderBy('created_at', 'DESC')
    ->paginate(10);
  } else {
   $posts = Post::with('comments.user')
    ->with('likes')
    ->with('comments.likes')
    ->where('user_id', $id)
    ->orderBy('created_at', 'DESC')
    ->paginate(10);
  }

  return view('users.show', compact('user', 'posts'));
 }

 public function edit($id)
 {
  $user = Auth::user(); // $user = User::find($id); -> TO SAMO
  return view('users.edit', compact('user'));
 }

 public function update(Request $request, $id)
 {
  $this->validate($request, [
   'name'   => 'required|string|min:4|max:255',
   'gender' => 'required|string',
   'email'  => [
    'required',
    'string',
    'email',
    'max:255',
    Rule::unique('users')->ignore($id),
   ],
  ]);

  $user         = User::find($id);
  $user->name   = $request->name;
  $user->email  = $request->email;
  $user->gender = $request->gender;

  if ($request->file('avatar')) {
   $user_avatar_path = 'public/users/' . $id . '/avatars';
   $upload_path      = $request->file('avatar')->store($user_avatar_path);
   $avatar_filename  = str_replace($user_avatar_path . '/', '', $upload_path);
   $user->avatar     = $avatar_filename;
  }

  $user->save();
  $posts = $user->posts()->get();

  return view('users.show', compact('user', 'posts'));
 }
}
