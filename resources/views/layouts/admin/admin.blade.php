@extends('layouts.master')
@section('content')
<div class="jumbotron contrast">
	<div class="row">
		<div class="col-md-6">
			<form action="{{route('admin.installDB')}}" method="POST">
				{!! csrf_field() !!}
				<li class="list-group-item" align="center">
					<h4>Setup corsi da database</h4>
					<button class="btn btn-danger align-right" type="submit">Carica tutti i corsi</button>
				</li>
			</form>
		</div>
		<div class="col-md-6">
		<form action="{{route('admin.importUsers')}}" method="POST">
		{!! csrf_field() !!}
			<li class="list-group-item" align="center">
				<h4>Setup utenti</h4>
				<button class="btn btn-danger align-left" type="submit">Carica gli utenti</button>
			</li>
		</form>
		</div>
		</div>
		<div class="row">
		<div class="col-md-6">
		<form action="{{route('admin.setupReferents')}}" method="POST">
		{!! csrf_field() !!}
			<li class="list-group-item" align="center">
				<h4>Setup referenti</h4>
				<button class="btn btn-danger align-left" type="submit">!!!</button>
			</li>
		</form>
		</div>
		<div class="col-md-6">
		<form action="{{route('admin.feedback')}}" method="GET">
		{!! csrf_field() !!}
			<li class="list-group-item" align="center">
				<h4>Gestisci Feedback</h4>
				<button class="btn btn-danger align-left" type="submit">Messaggi utenti</button>
			</li>
		</form>
		</div>
		</div>
	</div>
	<div class="jumbotron contrast">
	<div class="row">
		<div class="col-md-12">
			<h3>Appelli <small>Classi</small></h3><br>
			<form class="form-inline" action="/administration/calls/generate" method="POST">
			{!! csrf_field() !!}
			  <div class="form-group">
			    <label for="exampleInputName2">Classe</label>
			    <select class="form-control" name="class">
				  <option>1</option>
				  <option>2</option>
				  <option>3</option>
				  <option>4</option>
				  <option>5</option>
				</select>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail2">Sezione</label>
				<select class="form-control" name="section">
				  <option>A</option>
				  <option>B</option>
				  <option>C</option>
				  <option>D</option>
				  <option>E</option>
				  <option>F</option>
				  <option>G</option>
				  <option>H</option>
				  <option>I</option>
				  <option>L</option>
				  <option>M</option>
				  <option>N</option>
				  <option>O</option>
				</select>
			  </div>
			  <button type="submit" class="btn btn-success pull-right">Genera Appello</button>
			</form>

		</div>
	</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<h4>Amministrazione utenti</h4><br>

			<div id="list-id">

				<div class="form-group form-group-lg">
				  <input class="form-control search" type="text" id="search" placeholder="Ricerca per nome o classe">
				</div>
				<hr>
				<?php $user = new \App\User; ?>
				<ul class="list" style="list-style-type:none; padding:0px;">
				@foreach($user->all() as $user)
				@include("layouts.admin._user");
				@endforeach
				</ul>

			</div>

			<script>
			var options = {
			  valueNames: ['name','class']
			};

			var listObj = new List('list-id', options);
			</script>

		</div>
	</div>
	<hr>
</div>
@stop

@section('list_menu')
<a href="{{route('home')}}" class="list-group-item">
Profilo
</a>
<a href="{{route('courses')}}" class="list-group-item">Corsi disponibili</a>
<a href="{{route('help')}}" class="list-group-item">Istruzioni</a>
@stop