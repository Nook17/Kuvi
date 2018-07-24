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
    <a href="{{ url('/users/' . $post->user->id) }}" class="mx-4"><strong>{{ $post->user->name }}</strong></a> 
    @if(Auth::check() && $post->user_id == Auth::id())
     <a href="{{ url('/posts/' . $post->id . '/edit') }}" class="float-sm-right">
      <ion-icon class="text-success" name="create"></ion-icon>
     </a>
    @endif
    <br><a href="{{ url('/posts/' . $post->id) }}" class="mx-4"><small class="text-muted"><ion-icon name="alarm"></ion-icon> {{ $post->created_at }}</small></a>    
    @if(Auth::check() && $post->user_id == Auth::id()) 
    <a href="javascript:void(0);" class="float-sm-right" onclick="$(this).find('form').submit();">
     <ion-icon class="text-danger" name="trash"></ion-icon>
     <form action="{{ url('/posts/' . $post->id) }}" method="post">
      {{ csrf_field() }} 
      {{ method_field('DELETE') }}
     </form>
    </a>
    @endif
   </div>
  </div>
 </div>
 <div class="card-body" id="post_{{ $post->id }}">
  <p class="card-text">{{ $post->content }}</p>
 </div>
</div>
