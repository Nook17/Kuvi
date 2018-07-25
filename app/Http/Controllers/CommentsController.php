<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Social\Comment;
use Social\User;

class CommentsController extends Controller
{
 public function __construct()
 {
  $this->middleware('comment_permission', ['except' => ['store']]);
 }

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
  $comment = Comment::findOrFail($id);
  $user    = User::find(Auth::id());
  return view('comments.edit', compact('comment', 'user'));
 }

 public function update(Request $request, $id)
 {
  $this->validate($request, [
   'comment_content' => 'required|min:5',
  ]);

  $comment          = Comment::find($id);
  $comment->content = $request->comment_content;
  $comment->save();

  return back();
 }

 public function destroy($id)
 {
  Comment::where(['id' => $id])->delete();
  return back();
 }
}
