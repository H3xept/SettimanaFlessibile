@extends('layouts.master')
@section('content')
	@if(empty($user))
	<?php return redirect(route("admin"))->withErrors(["Nessun utente selezionato."]); ?>
	@endif

	<div class="jumbotron contrast">
	<div class="row">
		<div class="col-md-12" align="left">
			<h3>{{$user->name}}{{$user->surname}} <i>{{classtoroman($user->class)}}</i><small> Modificando</small></h3>
			<br>

			<form class="form" action="{{route('admin.updateUser',['target_id'=>$user->id])}}" method="POST">
			{!! csrf_field() !!}
			<div class="input-group" style="margin-top:8px;">
			  <span class="input-group-addon" id="basic-addon1">Nome</span>
			  <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1" value="{{$user->name}}" name="name">
			</div>
			<div class="input-group" style="margin-top:8px;">
			  <span class="input-group-addon" id="basic-addon1">Cognome</span>
			  <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1" value="{{$user->surname}}" name="surname">
			</div>
			<div class="input-group" style="margin-top:8px;">
			  <span class="input-group-addon" id="basic-addon1">Classe</span>
			  <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1" value="{{$user->class}}" name="class">
			</div><br>
			<button type="submit" class="btn btn-primary btn-small pull-right">Salva</button>
			</form>
		</div>
	</div>
	</div>

<div id="list-id" class="jumbotron contrast" align="center">
	<div align="left"><h3>Programmazione settimana</h3></div><hr>
  <table class="table table-hover">
  <thead>
    <tr>
      <th>Giorno</th>
      <th>Fascia</th>
      <th>Corso</th>
    </tr>
  </thead>
  <tbody>
    @for($c = 0; $c < 9; $c++)
      <tr>
        <td>{{itoweekday($c)}}</td>
        <td><span class="label label-default" data-toggle="tooltip" data-placement="right" title="{{ttext($c+1)}}">{{itoroman($c+1)}}</span></td>
          <?php $stripe = $user->stripes()->where("stripe_number",$c+1)->first(); ?>
        @if($user->referringInStripe($c+1) == 1)
          <?php $course = $user->courseWithStripe($c+1); ?>
          <td><u data-toggle="modal" data-target="#{{$course->u_identifier}}Info">{{$course->name}}</u></td>
        @else
        @if($stripe)
        	<?php $course = $stripe->course()->first(); ?>
        	<td><u data-toggle="modal" data-target="#{{$course->u_identifier}}Info">{{$course->name}}</u> <a class="btn btn-danger pull-right" href="/courses/{{$course->id}}/quit/{{$c+1}}/?target_id={{$user->id}}"><i class="fa fa-trash"></i></a></td>
        	@include('partials._course_body_info')
        @else
        	<td><a href="{{route('courses',['target_id'=>$user->id])}}">Nessun corso selezionato</a><i class="fa fa-exclamation-triangle pull-right"></i></td>
        @endif
        @endif
      </tr>
    @endfor
    
  </tbody>
</table>
</div>

@stop

@section('list_menu')
<a href="{{route('home')}}" class="list-group-item">
Profilo
</a>
<a href="{{route('courses')}}" class="list-group-item">Corsi disponibili</a>
<a href="#" class="list-group-item">Istruzioni</a>
@stop