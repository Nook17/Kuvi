@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row">
  <div class="col-md-6 offset-md-3">
   <div class="card bg-light mt-3">
    <div class="card-header">
     <form action="{{ url('/comments/' . $comment->id) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
       <div class="form-group">
        <input class="form-control {{ $errors->has('comment_content') ? ' is-invalid' : '' }}" name="comment_content" id="comment_content" placeholder="Write a comment ..." value="{{ $comment->content }}">
         @if ($errors->has('comment_content'))
          <span class="invalid-feedback text-left" role="alert">
           <strong>{{ $errors->first('comment_content') }}</strong>
          </span>
         @endif
        <button type="submit" class="btn btn-success btn-sm mt-2 float-right">Edit</button>
       </div>
      </form>
    </div>
   </div>
  </div>
 </div>
</div>
@endsection