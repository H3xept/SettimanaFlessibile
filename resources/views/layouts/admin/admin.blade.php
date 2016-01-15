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
				<h1>{!!count($user->all())!!}</h1>
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
<a href="#" class="list-group-item">Istruzioni</a>
@stop