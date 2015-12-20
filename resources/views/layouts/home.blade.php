@extends('layouts.master')
@section('content')

<div id="list-id" class="jumbotron contrast" align="center">
	<div align="left"><h3>Programmazione settimana<h3></div><hr>
  <table class="table table-hover">
  <thead>
    <tr>
      <th>Giorno</th>
      <th>Fascia</th>
      <th>Corso</th>
    </tr>
  </thead>
  <tbody>
    
    <?php $user_stripes = Auth::user()->stripes();  ?>
    @for($c = 0; $c < 9; $c++)
    <tr>
      <td>{{itoweekday($c)}}</td>
      <td><label class="label label-default">{{itoroman($c+1)}}</label></td>

      <?php $stripe = $stripe = $user_stripes->where("stripe_number","=",$c+1)->first(); ?>
      @if($stripe)
      	<?php $course = $stripe->course()->first(); ?>
      	<td><a data-toggle="modal" data-target="#{{$course->u_identifier}}Info">{{$course->name}}</a></td>
      	@include('partials._course_body_info')
      @else
      	<td></td>
      @endif
    </tr>
    @endfor
    
  </tbody>
</table>
</div>

@stop

@section('list_menu')
<a href="{{route('home')}}" class="list-group-item disabled">
Profilo
</a>
<a href="{{route('courses')}}" class="list-group-item">Corsi disponibili</a>
<a href="#" class="list-group-item">Istruzioni</a>
@stop