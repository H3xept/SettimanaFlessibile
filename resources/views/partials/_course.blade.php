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
    <button type="button" class="btn btn-default " data-toggle="modal" data-target="#{{$course->u_identifier}}Info">Info</button>
    <button class="btn btn-primary" data-toggle="modal" data-target="#{{$course->u_identifier}}Signup">Iscriviti</button>
  </div>
</div>
@include('partials._course_body')