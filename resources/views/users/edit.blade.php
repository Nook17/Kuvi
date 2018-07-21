@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row">
    
    <div class="col-6">
      <div class="card">
        <div class="card-header">User Edit</div>
          <div class="card-body text-center">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PATCH') }}
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" aria-describedby="name" value="{{ $user->name }}">
                  @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif
              </div>
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" aria-describedby="email" value="{{ $user->email }}">
                  @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
              </div>
              <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender">
                  <option value='m' @if($user->gender == 'm') selected @endif>Male</option>
                  <option value='f' @if($user->gender == 'f') selected @endif>Female</option>
                </select>                          
              </div>
              <div class="form-group">
                <div class="custom-file">
                  <input type="file" name="avatar" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
              </div>
              <button type="submit" class="btn btn-danger btn-sm">Save</button>
              <a href="{{ route('users.show', $user->id) }}" class="btn btn-success btn-sm">Back</a>
            </form>
          </div>
      </div>
    </div>
    
  </div>
</div>


@endsection
