<div class="panel panel-default">
  <div class="panel-body">
    <h3 class="lead name" style="font-size:20px; margin-bottom:0px;">
      <div class="truncate">{{$course->name}}</div>
    </h3>
    <div class="hidden referents">
    @foreach($course->referents as $referent)
      {{$referent->name.$referent->surname}}
    @endforeach
    </div>
    <hr> 
    <button type="button" class="btn btn-info " data-toggle="modal" data-target="#{{$course->u_identifier}}">
	  Info
	</button>
    <button class="btn btn-default">Iscriviti</button>
  </div>
</div>

<div class="modal fade" id="{{$course->u_identifier}}" tabindex="-1" role="dialog" aria-labelledby="{{$course->u_identifier}}Label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{$course->name}}</h4>
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

