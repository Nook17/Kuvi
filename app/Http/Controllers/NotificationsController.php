<?php

namespace Social\Http\Controllers;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Social\User;

class NotificationsController extends Controller
{
 public function __construct()
 {
  $this->middleware('auth');
 }

 public function index()
 {
  $user = User::find(Auth::id());
//   Auth::user()->notifications->markAsRead();
  return view('notifications.index', compact('user'));
 }

 public function update($id)
 {
  DatabaseNotification::where([
   'id'            => $id,
   'notifiable_id' => Auth::id(),
  ])->firstOrFail()->markAsRead();
  return back();
 }
}
