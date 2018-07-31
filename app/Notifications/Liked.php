<?php

namespace Social\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class Liked extends Notification
{
 use Queueable;

 protected $content;

 /**
  * Create a new notification instance.
  *
  * @return void
  */
 public function __construct($content)
 {
  $this->content = $content;
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

  if (is_null($this->content['comment'])) {
   $link = 'posts/' . $this->content['post']->id;
   $line = Auth::user()->name . ' likes Your post';

  } else {
   $link = 'posts/' . $this->content['post']->id . '#comment_id' . $this->content['comment']->id;
   $line = Auth::user()->name . ' likes Your comment';
  }

  return (new MailMessage)
   ->line($line)
   ->action('Notification Action', url($link))
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
  $user_link = '<a href="' . url('users/' . Auth::id()) . '">' . Auth::user()->name . '</a>';

  if (is_null($this->content['comment'])) {
   $post_link = '<a href="' . url('posts/' . $this->content['post']->id) . '"> post</a>';
   $message   = $user_link . ' likes Your ' . $post_link;
  } else {
   $comment_link = '<a href="' . url('posts/' . $this->content['post']->id . '#comment_id' . $this->content['comment']->id) . '"> comment</a>';
   $message      = $user_link . ' likes Your ' . $comment_link;
  }

  return [
   'message' => $message,
  ];
 }
}
