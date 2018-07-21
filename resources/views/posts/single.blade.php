<div class="card bg-light mt-3">
 <div class="card-header">
  <div class="media">
   @if($post->user->avatar && strpos($post->user->avatar, 'randomuser') == false)
    <img src="{{ asset('storage/users/' . $post->user->id . '/avatars/' . $post->user->avatar) }}" alt="User Avatar" class="rounded-circle align-self-start" width="50">
   @elseif($post->user->avatar && strpos($post->user->avatar, 'randomuser') == true)
    <img src="{{ asset($post->user->avatar) }}" alt="User Avatar" class="rounded-circle align-self-start" width="50">
   @elseif($post->user->avatar == NULL && $post->user->gender == 'm')
    <img src="{{ asset('storage/users/male.png') }}" alt="User Avatar" class="rounded-circle align-self-start" width="50">
   @elseif($post->user->avatar == NULL && $post->user->gender == 'f')
    <img src="{{ asset('storage/users/female.png') }}" alt="User Avatar" class="rounded-circle align-self-start" width="50">
   @endif
   <div class="media-body">
    <a href="{{ url('/users/' . $post->user->id) }}" class="mx-4"><strong>{{ $post->user->name }}</strong></a><br>
    <a href="{{ url('/posts/' . $post->id) }}" class="mx-4"><small class="text-muted"><ion-icon name="alarm"></ion-icon> {{ $post->created_at }}</small></a>
   </div>
  </div>     
 </div>
 <div class="card-body" id="post_{{ $post->id }}">
  <p class="card-text">{{ $post->content }}</p>
 </div>
</div>