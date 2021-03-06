@if($loop->count > 1 && $loop->first)
 <span class="text-right font-weight mr-md-2">{{ $loop->count }} Comments</span>
@endif
@if($loop->first)
 <hr>
@endif

<div class="row">
 <div id="comment_id{{ $comment->id }}" class="col-md-11 {{ $comment->trashed() ? ' trashed' : '' }}">
  <div class="media">

   <div class="ml-md-2">
    @if($comment->user['avatar'] && strpos($comment->user['avatar'], 'randomuser') == false)
     <img src="{{ asset('storage/users/' . $comment->user->id . '/avatars/' . $comment->user['avatar']) }}" alt="User Avatar" class="rounded-circle align-self-start" width="35"> 
    @elseif($comment->user['avatar'] && strpos($comment->user['avatar'], 'randomuser') == true)
     <img src="{{ asset($comment->user['avatar']) }}" alt="User Avatar" class="rounded-circle align-self-start" width="35"> 
    @elseif($comment->user['avatar'] == NULL && $comment->user['gender'] == 'm')
     <img src="{{ asset('storage/users/male.png') }}" alt="User Avatar" class="rounded-circle align-self-start" width="35">   
    @elseif($comment->user['avatar'] == NULL && $comment->user['gender'] == 'f')
     <img src="{{ asset('storage/users/female.png') }}" alt="User Avatar" class="rounded-circle align-self-start" width="35">   
    @endif
   </div>

   <div class="card mb-3 ml-md-2 n_comment">
    <div class="card-body">

     <a href="{{ url('/posts/' . $post->id . '#comment_id' . $comment->id) }}" class="text-muted pull-right"><small><ion-icon name="alarm"></ion-icon>  {{ $post->created_at }}</small></a>

     <p class="card-text"><strong><a href="{{ url('/users/' . $comment->user['id']) }}">{{ $comment->user['name'] }} </a></strong>{{ $comment->content }}</p>
    </div>
   </div>
   
   {{-- @if(Auth::check() && $comment->user_id == Auth::id()) --}}
   @if(belongs_to_auth($comment->user_id) || is_admin())
   @include('comments.dropdown_menu')
   @endif
   
  </div> {{-- div.media --}}

  @include('comments.likes')

 </div>
</div>

@section('footer')
<script>
	$(function(){

		function addHighlightClass() {
			let hash = window.location.hash.substring(1);
			let comment = document.getElementById(hash);
			let $comment = $(comment).addClass('highlight highlightYellow');
			setTimeout(function(){
				$comment.removeClass('highlightYellow');
			}, 1500);
		} addHighlightClass();

		window.addEventListener('hashchange', function(){
			addHighlightClass();
		}, false);

	});
</script>
@endsection