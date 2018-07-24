@extends('layouts.app') 
@section('content')
<div class="container">
 <div class="row">

  <div class="col-md-8 offset-md-2">

  @if(Auth::check())
    @include('posts.create') 
  @endif 

  @foreach($posts as $post)
    @include('posts.single') 
  @endforeach
    {{ $posts }}

  </div>
 </div>
</div>
@endsection