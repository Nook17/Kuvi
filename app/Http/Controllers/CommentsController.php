<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Social\Comment;

class CommentsController extends Controller
{
 public function store(Request $request)
 {
  $comment_content_id = 'post_' . $request->post_id . '_comment_content';

  $this->validate($request, [
   $comment_content_id => 'required|min:3',
  ]);

  $comment          = new Comment;
  $comment->post_id = $request->post_id;
  $comment->user_id = Auth::id();
  $comment->content = $request->$comment_content_id;
  $comment->save();

  return back();
 }

 public function edit($id)
 {
  //
 }

 public function update(Request $request, $id)
 {
  //
 }

 public function destroy($id)
 {
  //
 }
}
