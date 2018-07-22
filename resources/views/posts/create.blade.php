<div class="card">
 <div class="card-body text-center">
  <form action="{{ url('/posts') }}" method="POST">
  {{ csrf_field() }}
   <div class="form-group">
    <textarea class="form-control {{ $errors->has('post_content') ? ' is-invalid' : '' }}" name="post_content" id="post_content" cols="60" rows="5" placeholder="What's up ?">{{ old('post_content') }}</textarea>
     @if ($errors->has('post_content'))
      <span class="invalid-feedback text-left" role="alert">
       <strong>{{ $errors->first('post_content') }}</strong>
      </span>
     @endif
    <button type="submit" class="btn btn-success btn-sm mt-2">Send</button>
   </div>
  </form>
 </div>
 </div>