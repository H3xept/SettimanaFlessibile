@extends('layouts.master')
@section('content')
	<div class="jumbotron contrast" align="center">
	<div align="left"><h3>Contatti <span><i class="fa fa-envelope pull-right"></i></span> </h3></div><hr>
	<form action="{{route('postContact')}}" method="POST">
		{!! csrf_field() !!}
		<div class="form-group required">
		  <div for="issue" class="pull-left">
			<small>Messaggio*</small>
		  </div><br>
		  <textarea class="form-control" rows="5" id="issue" name="issue"></textarea><br>
		  <div class="row">	
			  <div class="col-md-6">
				  <div class="form-group">
				    <small for="phone" class="pull-left">Numero di telefono</small>
				    <input type="phone" class="form-control" id="phone" placeholder="339..." name="phone">
				  </div>
			  </div>
			  <div class="col-md-6">
				  <div class="form-group">
				    <small for="email" class="pull-left">Email</small>
				    <input type="email" class="form-control" id="email" placeholder="esempio@gmail.com" name="email">
				  </div>
			  </div>
		  </div>
		  <br><button class="btn btn-primary pull-right" type="submit">Invia</button>
		</div>
	</form>
	</div>
@stop
@section('list_menu')
<a href="{{route('home')}}" class="list-group-item disabled">
Profilo
</a>
<a href="{{route('courses')}}" class="list-group-item">Corsi disponibili</a>
<a href="#" class="list-group-item">Istruzioni</a>
@stop