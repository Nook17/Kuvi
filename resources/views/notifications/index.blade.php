@extends('layouts.app')
@section('content')

<div class="container">
 <div class="row">
  <div class="col-md-6 offset-md-3">
   <div class="card">
   <div class="card-header">Notifications</div>
    <div class="card-body text-center">
      
     @if(Auth::user()->notifications->count() == 0)
      <p>No notifications</p>
     @endif

      @foreach(Auth::user()->notifications as $notification) 
        <form action="{{ url('/notifications/' . $notification->id) }}" method="POST" class="">
         {{ csrf_field() }}
         {{ method_field('PATCH') }}
          <div class="n_notification mb-3">
           <?= html_entity_decode($notification->data['message']) ?>
            <button type="submit" class="btn n_btn_group_icon float-right">
             <?= is_null($notification->read_at) ? '<ion-icon class="text-danger" name="notifications"></ion-icon>' : '<ion-icon class="text-success" name="notifications-off"></ion-icon>'?>
            </button>
           </div>
         </form>        
      @endforeach

    </div>
   </div>
  </div>
 </div>
</div>

@endsection
