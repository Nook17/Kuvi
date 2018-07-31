<?php

namespace Social\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class FriendRequestDestroy extends Notification
{
 use Queueable;

 /**
  * Create a new notification instance.
  *
  * @return void
  */
 public function __construct()
 {
  //
 }

 /**
  * Get the notification's delivery channels.
  *
  * @param  mixed  $notifiable
  * @return array
  */
 public function via($notifiable)
 {
  return ['mail', 'database'];
 }

 /**
  * Get the mail representation of the notification.
  *
  * @param  mixed  $notifiable
  * @return \Illuminate\Notifications\Messages\MailMessage
  */
 public function toMail($notifiable)
 {
  $line = Auth::user()->name . ' has removed you from friends';

  return (new MailMessage)
   ->line($line)
   ->action('Notification Action', url('users/' . Auth::id()))
   ->line('Thank you for using our application!');
 }

 /**
  * Get the array representation of the notification.
  *
  * @param  mixed  $notifiable
  * @return array
  */
 public function toArray($notifiable)
 {
  return [
   'message' => '<a href="' . url('users/' . Auth::id()) . '">' . Auth::user()->name . '</a> has removed you from friends',
  ];
 }
}
