@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row">
  @include('layouts.sidebar')
  <div class="col-md-8">
   
   @if(Auth::check() && $user->id == Auth::id())
    @include('posts.create')
   @endif
   
   @foreach($posts as $post)
    @include('posts.single')
   @endforeach

  </div>
 </div>
</div>
@endsection