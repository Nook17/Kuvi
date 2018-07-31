<?php

namespace Social\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class FriendRequestSent extends Notification
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
  $line = 'You have a new friend suggestion: ' . Auth::user()->name;

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
   'message' => 'You have a new friend suggestion: <a href="' . url('users/' . Auth::id()) . '">' . Auth::user()->name . '</a>',
  ];
 }
}
