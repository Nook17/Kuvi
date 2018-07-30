@extends('layouts.app')
@section('content')

<div class="container">
 <div class="row">
  <div class="col">
   <div class="card">
   <div class="card-header">Notifications</div>
    <div class="card-body text-center">
      
     @if(Auth::user()->notifications->count() == 0)
      <p>No notifications</p>
     @endif

     <div class="row">
      @foreach(Auth::user()->notifications as $notification) 
       <div class="col-sm-4">
        <form action="{{ url('/notifications/' . $notification->id) }}" method="POST" class="">
         {{ csrf_field() }}
         {{ method_field('PATCH') }}
          <div class="input-group">
           <input class="form-control" name="notification_message" id="notification_message" value="{{ $notification->data['message'] }}">
           <div class="input-group-append">
            <button type="submit" class="btn n_btn_group_icon">
             <?= is_null($notification->read_at) ? '<ion-icon size="large" class="text-danger" name="notifications"></ion-icon>' : '<ion-icon size="large" class="text-success" name="notifications-off"></ion-icon>'?>
            </button>
           </div>
          </div>
         </form>        
       </div>
      @endforeach
     </div>

    </div>
   </div>
  </div>
 </div>
</div>

@endsection
