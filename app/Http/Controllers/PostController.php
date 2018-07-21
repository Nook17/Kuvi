<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Social\Post;
use Social\User;

class PostController extends Controller
{
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
  $post = Post::findOrFail($id);
  $user = User::find($id);
  return view('/posts.show', compact('post', 'user'));
 }

 public function edit(Post $post)
 {
  //
 }

 public function update(Request $request, Post $post)
 {
  //
 }

 public function destroy(Post $post)
 {
  //
 }
}
