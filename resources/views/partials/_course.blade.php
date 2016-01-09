<div class="panel panel-default">
  <div class="panel-body">
    <h3 class="lead" style="font-size:20px; margin-bottom:0px;">
    <div class="truncate"><span class="name">{{$course->name}}</span></div>
    </h3>
    <div class="hidden referents">
    @foreach($course->reflist() as $referent)
      {{$referent}}
    @endforeach
    </div>
    <hr> 
    <button type="button" class="btn btn-default " data-toggle="modal" data-target="#{{$course->u_identifier}}Info">Info</button>
    <button class="btn btn-primary" data-toggle="modal" data-target="#{{$course->u_identifier}}Signup">Iscriviti</button>
  </div>
</div>
@include('partials._course_body')