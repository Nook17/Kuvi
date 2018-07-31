<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Social\Post;
use Social\User;

class PostController extends Controller
{
 public function __construct()
 {
  $this->middleware('post_permission', ['except' => ['show', 'store']]);
 }

 public function store(Request $request)
 {
  $this->validate($request, [
   'post_content' => 'required|min:5',
  ]);

  $post          = new Post;
  $post->content = $request->post_content;
  $post->user_id = Auth::id();
  $post->save();

  return back();
 }

 public function show($id)
 {
  $user = User::find($id);
  // $user = User::find(Auth::id());

  // if (is_admin()) {
  //  $post = Post::findOrFail($id)->withTrashed()->get();
  // } else {
  $post = Post::findOrFail($id);
  // }

  return view('posts.show', compact('post', 'user'));
 }

 public function edit($id)
 {
  $user = User::find(Auth::id());

  if (is_admin()) {
   $post = Post::findOrFail($id)->withTrashed();
  } else {
   $post = Post::findOrFail($id);
  }

  return view('posts.edit', compact('post', 'user'));
 }

 public function update(Request $request, $id)
 {
  $this->validate($request, [
   'post_content' => 'required|min:5',
  ]);

  $post          = Post::find($id);
  $post->content = $request->post_content;
  $post->save();

  $user = User::find(Auth::id());

  return view('posts.show', compact('post', 'user'));
 }

 public function destroy($id)
 {
  $post = Post::find($id);
  $post->delete();
  $post->comments()->delete();

  return back();
 }
}
