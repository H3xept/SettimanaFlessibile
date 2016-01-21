<html>
	<head>
	    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
	    <link href="{{ asset('css/bootstrap-theme.min.css')}}" rel="stylesheet">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	</head>
	<body style="font-size:12px;">
	<div class="container-fluid">
		<div class="row-fluid">
		<div class="col-md-12">
		<?php $ayy=0; ?>
		@for($i=0; $i < 9; $i++) 

		@if($course->stripes()->where("stripe_number",$i+1)->get()->first() == NULL) @continue @endif

		<div class="table">
		<table class="table table-compressed table-bordered">
		<thead>
			<tr>
				<th>{{$course->name}}</th>
				<th>{{$i+1}}</th>
			</tr>
		</thead>
		<tbody>
			<tr>
			@foreach($course->stripes()->where("stripe_number",$i+1)->get()->first()->users as $user)
			@if($ayy == 10)
				</tr><tr><td>{{$user->name}} {{$user->surname}}</td>
				<?php $ayy = 0; ?>
			@else
				<td>{{$user->name}} {{$user->surname}}</td>
				<?php $ayy++; ?>
			@endif
			</tr>

			@endforeach

		</tbody>
		</table>
		@endfor

		</div>
		</div>
		</div>
	</div>
	</body>
</html>