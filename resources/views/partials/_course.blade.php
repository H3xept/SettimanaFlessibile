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
    <button type="button" class="btn btn-default " data-toggle="modal" data-target="#{{$course->u_identifier}}Info">
	  Info
	</button>
    <button class="btn btn-primary" data-toggle="modal" data-target="#{{$course->u_identifier}}Signup">Iscriviti</button>
  </div>
</div>

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

<!-- ISCRIVITI -->
<div class="modal fade" id="{{$course->u_identifier}}Signup" tabindex="-1" role="dialog" aria-labelledby="{{$course->u_identifier}}Signup">
  <div class="modal-dialog" role="document">
    <form action="/courses/{{$course->id}}/signup" method="POST">
    {!! csrf_field() !!}

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="{{$course->u_identifier}}SignupLabel">{{$course->name}} - Iscrizione </h4>
        </div>
        <div class="modal-body">
        
        @if($course->single_stripe)
        @include('partials._single_signup')
        @else
        @include('partials._stripes_signup')
        @endif
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
          <button type="submit" class="btn btn-primary">Iscriviti</button>
        </div>
      </div>
    </form>
  </div>
</div>