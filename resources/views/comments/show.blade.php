@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row">
  <div class="col-md-6 offset-md-3 {{ $post->trashed() ? ' trashed' : '' }}">

   @include('comments.single')

  </div>
 </div>
</div>
@endsection