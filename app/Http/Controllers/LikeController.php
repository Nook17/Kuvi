<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Social\Comment;
use Social\Like;
use Social\Notifications\Liked;
use Social\Post;
use Social\User;

class LikeController extends Controller
{

 public function add(Request $request)
 {
  $like             = new Like;
  $like->user_id    = Auth::id();
  $like->post_id    = $request->post_id;
  $like->comment_id = $request->comment_id;
  $like->save();

  if (!empty($request->post_id)) {
   $post = Post::findOrFail($request->post_id);

   if (Auth::id() !== $post->user_id) {
    $content = [
     'post'    => $post,
     'comment' => null,
    ];

    User::findOrFail($post->user_id)->notify(new Liked($content));
   }

  }

  if (!empty($request->comment_id)) {
   $comment = Comment::findOrFail($request->comment_id);
   $post    = Post::findOrFail($comment->post_id);

   if (Auth::id() !== $comment->user_id) {
    $content = [
     'post'    => $post,
     'comment' => $comment,
    ];

    User::findOrFail($comment->user_id)->notify(new Liked($content));
   }
  }

  return back();
 }

 public function destroy(Request $request)
 {
  Like::where([
   'user_id'    => Auth::id(),
   'post_id'    => $request->post_id,
   'comment_id' => $request->comment_id,
  ])->delete();

  return back();
 }
}
