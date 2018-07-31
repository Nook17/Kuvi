<?php

namespace Social\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class PostCommented extends Notification
{
 use Queueable;

 protected $post_id;
 protected $comment_id;

 /**
  * Create a new notification instance.
  *
  * @return void
  */
 public function __construct($post_id, $comment_id)
 {
  $this->post_id    = $post_id;
  $this->comment_id = $comment_id;
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
  $line = Auth::user()->name . ' Commented Your post';

  return (new MailMessage)
   ->line($line)
   ->action('Notification Action', url('/posts/' . $this->post_id . '#comment_id' . $this->comment_id))
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
  $user_profile_link = '<a href="' . url('/users/' . Auth::id()) . '">' . Auth::user()->name . '</a>';
  $post_comment_link = '<a href="' . url('/posts/' . $this->post_id . '#comment_id' . $this->comment_id) . '">Post</a>';
  return [
   'message' => $user_profile_link . ' Commented Your ' . $post_comment_link,
  ];
 }
}
