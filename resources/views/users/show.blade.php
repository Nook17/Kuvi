@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row">
  @include('layouts.sidebar')
  <div class="col-md-8">
   
   @if(Auth::check() && $user->id == Auth::id())
    @include('posts.create')
   @endif
   
   @if($posts->count() > 0)
    @foreach($posts as $post)
     @include('posts.single')
    @endforeach
   @else
   <div class="card bg-light mt-3">
     <div class="card-header">
      <h4 class="text-center">The user has no posts</h4>
     </div>
   </div>
   @endif
  </div>
 </div>
</div>
@endsection