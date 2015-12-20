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