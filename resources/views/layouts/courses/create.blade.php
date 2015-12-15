@extends('layouts.master')
@section('content')
<div class="jumbotron contrast">
<hr>
<form action="{{route('installDB')}}" method="POST">
{!! csrf_field() !!}
<h2>Setup da database <span><button class="btn btn-danger pull-right" type="submit">Carica tutti i corsi</button></span></h2>
</form>
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