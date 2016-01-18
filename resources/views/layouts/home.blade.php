@extends('layouts.master')
@section('content')

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
          <?php $stripe = Auth::user()->stripes()->where("stripe_number",$c+1)->first();?>
        @if(Auth::user()->referringInStripe($c+1) == 1)
          <?php $course = Auth::user()->courseWithStripe($c+1); ?>
          <td><u data-toggle="modal" data-target="#{{$course->u_identifier}}Info" class="truncate">{{$course->name}}</u></td>
        @else
        @if($stripe)
        	<?php $course = $stripe->course()->first(); ?>
        	<td><u data-toggle="modal" data-target="#{{$course->u_identifier}}Info" class="truncate">{{$course->name}}</u> <a class="btn btn-danger pull-right" href="/courses/{{$course->id}}/quit/{{$c+1}}"><i class="fa fa-trash"></i></a></td>
        	@include('partials._course_body_info')
        @else
        	<td><a href="{{route('courses')}}">Nessun corso selezionato</a><i class="fa fa-exclamation-triangle pull-right"></i></td>
        @endif
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
<a href="{{route('help')}}" class="list-group-item">Istruzioni</a>
@stop