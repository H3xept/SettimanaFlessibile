@extends('layouts.master')
@section('content')

@if(!empty($_GET['target_id']))
<?php $t_user = App\User::find($_GET['target_id']); ?>
<div class="panel panel-warning">
  <div class="panel-body">
    Stai scegliendo un corso per <b>{{$t_user->name}} {{$t_user->surname}} <i>{{classtoroman($t_user->class)}}</i></b> 
  </div>
</div>
@endif
<div id="list-id" class="jumbotron contrast">

	<div class="form-group form-group-lg">
	  <input class="form-control fuzzy-search" type="text" id="search" placeholder="Ricerca corso per nome o referenti.">
	</div><hr>

<ul class="list" style="list-style-type:none; padding:0px;">
  
	@foreach($courses as $course)
  @if(isset($user) && !userIsMod())
  @if($course->isFull()) 
  @continue 
  @endif
  @endif
    <li>
      @include('partials._course')
    </li>
	@endforeach
</ul>

</div>

<script>
var fuzzyOptions = {
  searchClass: "fuzzy-search",
  location: 0,
  distance: 30000000000,
  threshold: 0.4,
    multiSearch: true
};
var options = {
  valueNames: [ 'name','referents' ],
  plugins: [
    ListFuzzySearch()
  ]
};

var listObj = new List('list-id', options);
</script>

@stop

@section('list_menu')
<a href="{{route('home')}}" class="list-group-item">
Profilo
</a>
<a href="{{route('courses')}}" class="list-group-item disabled">Corsi disponibili</a>
<a href="{{route('help')}}" class="list-group-item">Istruzioni</a>
@stop