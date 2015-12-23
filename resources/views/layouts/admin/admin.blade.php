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
			<li class="list-group-item" align="center">
				<h3>Qualcosa...</h3>
			</li>
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