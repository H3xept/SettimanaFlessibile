<!-- INFO -->
<div class="modal fade" id="{{$course->u_identifier}}Info" tabindex="-1" role="dialog" aria-labelledby="{{$course->u_identifier}}InfoLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="{{$course->u_identifier}}InfoLabel">{{$course->name}}</h4>
      </div>
      <div class="modal-body">
      
        @include('partials._course_description')
        @if(Route::getCurrentRoute()->getPath() == "home")
        @include('partials._course_referents')
        @else
        @include('partials._course_schedule')
        @endif

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
      </div>
    </div>
  </div>
</div>
