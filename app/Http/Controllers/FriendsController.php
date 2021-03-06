<?php

namespace Social\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Social\Friend;
use Social\Notifications\FriendRequestAccepted;
use Social\Notifications\FriendRequestDestroy;
use Social\Notifications\FriendRequestSent;
use Social\User;

class FriendsController extends Controller
{

 public function index($user_id)
 {
  $user = User::findOrFail($user_id);
  return view('friends.index', compact('user'));
 }

 public function add($friend_id)
 {
  if (!friendship($friend_id)->exists && !friendship($friend_id)->accepted) {
   $friend            = new Friend;
   $friend->user_id   = Auth::id();
   $friend->friend_id = $friend_id;
   $friend->save();

   User::findOrFail($friend_id)->notify(new FriendRequestSent());

  } else {
   $this->accept($friend_id);
  }
  return back();
 }

 public function accept($friend_id)
 {
  Friend::where([
   'user_id'   => $friend_id,
   'friend_id' => Auth::id(),
  ])->update([
   'accepted' => 1,
  ]);

  User::findOrFail($friend_id)->notify(new FriendRequestAccepted());

  return back();
 }

 public function destroy($friend_id)
 {
  Friend::where([
   'user_id'   => Auth::id(),
   'friend_id' => $friend_id,
  ])->orWhere([
   'user_id'   => $friend_id,
   'friend_id' => Auth::id(),
  ])->delete();

  User::findOrFail($friend_id)->notify(new FriendRequestDestroy());

  return back();
 }
}
