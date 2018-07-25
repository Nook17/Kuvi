<div class="dropdown-toggle ml-md-2 n_dropdown" data-toggle="dropdown"></div>
<div class="dropdown-menu">
  <a href="{{ url('/comments/' . $comment->id) . '/edit'}}" class="dropdown-item">Edit</a>
  <form action="{{ url('/comments/' . $comment->id) }}" method="post">
   {{ csrf_field() }} 
   {{ method_field('DELETE') }}
   <button type="submit"  class="dropdown-item n_button_delete" onClick="return confirm('Are you sure you want to delete comment ?')">Delete</button>
  </form>
</div>
