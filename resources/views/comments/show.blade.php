<div class="row">
 <div class="col-md-11">
  <div class="media">

   <div class="ml-md-2">
    @if($comment->user->avatar && strpos($comment->user->avatar, 'randomuser') == false)
     <img src="{{ asset('storage/users/' . $comment->user->id . '/avatars/' . $comment->user->avatar) }}" alt="User Avatar" class="rounded-circle align-self-start" width="35"> 
    @elseif($comment->user->avatar && strpos($comment->user->avatar, 'randomuser') == true)
     <img src="{{ asset($comment->user->avatar) }}" alt="User Avatar" class="rounded-circle align-self-start" width="35"> 
    @elseif($comment->user->avatar == NULL && $comment->user->gender == 'm')
     <img src="{{ asset('storage/users/male.png') }}" alt="User Avatar" class="rounded-circle align-self-start" width="35">   
    @elseif($comment->user->avatar == NULL && $comment->user->gender == 'f')
     <img src="{{ asset('storage/users/female.png') }}" alt="User Avatar" class="rounded-circle align-self-start" width="35">   
    @endif
   </div>

   <div class="card mb-3 ml-md-2 n_comment">
    <div class="card-body">
     <p class="card-text"><strong><a href="{{ url('/users/' . $comment->user->id) }}">{{ $comment->user->name }} </a></strong>{{ $comment->content }}</p>
    </div>
   </div>

  </div>
 </div>
</div>