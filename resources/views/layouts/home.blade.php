@extends('layouts.master')
@section('content')

<div id="list-id" class="jumbotron contrast" align="center">
  <h3>Profilo in costruzione... Ammirare il π grazie.</h3>
</div>

@stop

@section('list_menu')
<a href="{{route('home')}}" class="list-group-item disabled">
Profilo
</a>
<a href="{{route('courses')}}" class="list-group-item">Corsi disponibili</a>
<a href="#" class="list-group-item">Istruzioni</a>
@stop