@extends('layouts.master')
@section('content')

<div class="jumbotron contrast">

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
  @if(isset($issues))
  	@foreach($issues as $issue)

    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="heading{{$issue->id}}">
            <h4 class="panel-title">
              <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$issue->id}}" aria-expanded="true" aria-controls="collapse{{$issue->id}}">
                <label for="">{{$issue->user->name}} {{$issue->user->surname}} {{$issue->user->class}}</label>
              </a>
            </h4>
          </div>
          <div id="collapse{{$issue->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$issue->id}}">
            <div class="panel-body">
              <div class="col-md-10">
                <p>{{$issue->issue_msg}}</p>
              </div>
              <div class="col-md-2">
              <form action="/administration/feedback/delete/{{$issue->id}}" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger" disabled="true"><i class="fa fa-trash"></i></button>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><br>
    @endforeach

  @endif
  
</div>
</div>

@stop
@section('list_menu')
<a href="{{route('home')}}" class="list-group-item">
Profilo
</a>
<a href="{{route('courses')}}" class="list-group-item">Corsi disponibili</a>
<a href="{{route('help')}}" class="list-group-item">Istruzioni</a>
@stop