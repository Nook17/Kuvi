@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">

        @include('layouts.sidebar')
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <form action="{{ url('/posts') }}" method="POST">
                        {{ csrf_field() }}
                          <div class="form-group">
                            <textarea class="form-control" name="post_content" id="post_content" cols="60" rows="5" placeholder="What's up ?"></textarea>
                            <button type="submit" class="btn btn-success btn-sm mt-2">Send</button>
                          </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection