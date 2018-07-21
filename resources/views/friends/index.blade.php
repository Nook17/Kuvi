@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
      <div class="card-header">Friends List <span class="badge badge-pill badge-info">{{ $user->friends()->count() }}</span></div>
        <div class="card-body text-center">
          
          @if($user->friends()->count() == 0)
            <p>I'm sorry, I can't find anything</p>
          @endif

          <div class="row">
            @foreach($user->friends() as $result)
              <div class="col-sm-4">
                <a href="{{ url('/users/' . $result->id)  }}">
                  @if($result->avatar && strpos($result->avatar, 'randomuser') == false)
                    <img src="{{ asset('storage/users/' . $result->id . '/avatars/' . $result->avatar) }}" alt="User Avatar" class="rounded-circle" width="100">
                  @elseif($result->avatar && strpos($result->avatar, 'randomuser') == true)
                    <img src="{{ asset($result->avatar) }}" alt="User Avatar" class="rounded-circle" width="100">
                  @elseif($result->avatar == NULL && $result->gender == 'm')
                    <img src="{{ asset('storage/users/male.png') }}" alt="User Avatar" class="rounded-circle" width="100">
                  @elseif($result->avatar == NULL && $result->gender == 'f')
                    <img src="{{ asset('storage/users/female.png') }}" alt="User Avatar" class="rounded-circle" width="100">
                  @endif
                  <p>{{ $result->name }}</p>
                </a>
              </div>
            @endforeach
          </div>

        </div>
      </div>
    </div>
  </div>
</div>


@endsection
