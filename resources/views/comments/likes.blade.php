@if(Auth::check())
 @if(!Auth::user()->likes->contains('comment_id', $comment->id))
 <form action="{{ url('/likes') }}" method="POST">
  {{ csrf_field() }}
  <input type="hidden" name="comment_id" value="{{ $comment->id }}">
  <button type="submit" class="btn btn-default n_btn_like_comment"> Like <span class="badge badge-light">{{ $comment->likes->count() }}</span></button>
 </form>
  @else
  <form action="{{ url('/likes') }}" method="POST">
   {{ csrf_field() }}
   {{ method_field('DELETE') }}
   <input type="hidden" name="comment_id" value="{{ $comment->id }}">
   <button type="submit" class="btn btn-default n_btn_like_comment"> Dislike <span class="badge badge-light">{{ $comment->likes->count() }}</span></button>
  </form>
 @endif
@endif