@if(Auth::check())
 @if(!Auth::user()->likes->contains('post_id', $post->id))
  <form action="{{ url('/likes') }}" method="POST">
   {{ csrf_field() }}
   <input type="hidden" name="post_id" value="{{ $post->id }}">
   <button type="submit" class="btn btn-default float-right m-2 n_btn_like_post"><ion-icon name="thumbs-up"></ion-icon> Like <span class="badge badge-light">{{ $post->likes->count() }}</span></button>
  </form>
  @else
   <form action="{{ url('/likes') }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <button type="submit" class="btn btn-default float-right m-2 n_btn_like_post"><ion-icon name="thumbs-down"></ion-icon> Dislike <span class="badge badge-light">{{ $post->likes->count() }}</span></button>
   </form>
 @endif
@endif