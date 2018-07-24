<div class="col-md-11">
<div class="media">
{{-- <div class="card-footer"> --}}
  @if(Auth::user()->avatar && strpos(Auth::user()->avatar, 'randomuser') == false)
  <img src="{{ asset('storage/users/' . Auth::user()->id . '/avatars/' . Auth::user()->avatar) }}" alt="User Avatar" class="rounded-circle" width="35">
  @elseif(Auth::user()->avatar && strpos(Auth::user()->avatar, 'randomuser') == true)
  <img src="{{ asset(Auth::user()->avatar) }}" alt="User Avatar" class="rounded-circle" width="35">
  @elseif(Auth::user()->avatar == NULL && Auth::user()->gender == 'm')
  <img src="{{ asset('storage/users/male.png') }}" alt="User Avatar" class="rounded-circle" width="35">
  @elseif(Auth::user()->avatar == NULL && Auth::user()->gender == 'f')
  <img src="{{ asset('storage/users/female.png') }}" alt="User Avatar" class="rounded-circle" width="35">
  @endif
<div class="media-body">
{{-- <div class="row justify-content-end"> --}}
{{-- <div class="col-md-11"> --}}
 <form action="{{ url('/comments') }}" method="POST">
  {{ csrf_field() }}
  <div class="input-group ml-md-3 mb-md-2">
   <input type="text" class="form-control {{ $errors->has('post_' . $post->id . '_comment_content') ? ' is-invalid' : '' }}" name="post_{{ $post->id }}_comment_content" id="comment_content" placeholder="Write a comment ..." aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ old('post_' . $post->id . '_comment_content') }}">
   <input type="hidden" name="post_id" value="{{ $post->id }}">
    <div class="input-group-append">
     <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Send</button>
    </div>    
    @if ($errors->has('post_{{ $post->id }}_comment_content'))
     <span class="invalid-feedback text-left" role="alert">
      <strong>{{ $errors->first('post_' . $post->id . '_comment_content') }}</strong>
     </span>
    @endif
  </div>
 </form>
{{-- </div> --}}
{{-- </div> --}}

</div>
</div>
</div>
