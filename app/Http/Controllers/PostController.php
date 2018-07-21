<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Social\Post;

class PostController extends Controller
{
 public function store(Request $request)
 {
  $post          = new Post;
  $post->content = $request->post_content;
  $post->user_id = Auth::id();
  $post->save();
 }

 public function show(Post $post)
 {
  //
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
