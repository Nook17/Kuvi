@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row">
  <div class="col-md-6 offset-md-3">
   <div class="card bg-light mt-3">
    <div class="card-header">
     <form action="{{ url('/posts/' . $post->id) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
       <div class="form-group">
        <textarea class="form-control {{ $errors->has('post_content') ? ' is-invalid' : '' }}" name="post_content" id="post_content" cols="60" rows="5" placeholder="What's up ?">{{ $post->content }}</textarea>
         @if ($errors->has('post_content'))
          <span class="invalid-feedback text-left" role="alert">
           <strong>{{ $errors->first('post_content') }}</strong>
          </span>
         @endif
        <button type="submit" class="btn btn-success btn-sm mt-2">Edit</button>
       </div>
      </form>
    </div>
   </div>
  </div>
 </div>
</div>
@endsection