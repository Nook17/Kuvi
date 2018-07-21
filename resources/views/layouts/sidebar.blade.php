<div class="col-md-4">
  <div class="card">
    <div class="card-header">User Show</div>
    <div class="card-body text-center">
      @if($user->avatar && strpos($user->avatar, 'randomuser') == false)
        <img src="{{ asset('storage/users/' . $user->id . '/avatars/' . $user->avatar) }}" alt="User Avatar" class="rounded-circle" width="100">
      @elseif($user->avatar && strpos($user->avatar, 'randomuser') == true)
        <img src="{{ asset($user->avatar) }}" alt="User Avatar" class="rounded-circle" width="100">
      @elseif($user->avatar == NULL && $user->gender == 'm')
        <img src="{{ asset('storage/users/male.png') }}" alt="User Avatar" class="rounded-circle" width="100">
      @elseif($user->avatar == NULL && $user->gender == 'f')
        <img src="{{ asset('storage/users/female.png') }}" alt="User Avatar" class="rounded-circle" width="100">
      @endif
      <p><h3><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></h3></p>
      <p>{{ $user->email }}</p>
      <p><a href="{{ url('/users/' . $user->id . '/friends') }}" class="btn btn-dark btn-sm">Friends <span class="badge badge-pill badge-info">{{ $user->friends()->count() }}</span></a></p>
      <p>@if($user->gender == 'm') male @else female @endif</p>
      @if($user->id == Auth::id())
        <div class="text-right"><a href="{{ url('/users/' . $user->id . '/edit' ) }}" >Edit</a></div>
      @endif

      @if(Auth::check() &&  $user->id !== Auth::id())
      
        @if(!friendship($user->id)->exists && !has_friend_invitation($user->id))
          <form action="{{ url('/friends/' . $user->id) }}" method="POST">
            {{ csrf_field() }}
            <button class="btn btn-success btn-sm">Invite a friend</button>
          </form>

        @elseif(has_friend_invitation($user->id))
          <form action="{{ url('/friends/' . $user->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <button class="btn btn-primary btn-sm">Accept the invitaton</button>
          </form>

        @elseif(friendship($user->id)->exists && !friendship($user->id)->accepted)
          <button class="btn btn-success btn-sm disabled">Invitation sent</button>

        @elseif(friendship($user->id)->exists && friendship($user->id)->accepted)
          <form action="{{ url('/friends/' . $user->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button class="btn btn-danger btn-sm">Delete the invitaton</button>
          </form>       
        @endif
      @endif

    </div>
  </div>
</div>