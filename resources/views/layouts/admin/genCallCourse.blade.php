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
		<div class="table">
		    <?php $stripes = $course->stripes; $ayy = 1; dd($stripes->get());?>
			@foreach($stripes as $stripe)
				<table class="table table-bordered table-condensed">
			    <thead>
			      <tr>
			        <th>{{$stripe->course->name}}</th>
			        <th>{{$ayy}}</th>
			      </tr>
			    </thead>
			    <tbody>
				<tr>
					<?php $lmao = 0; ?>
					@foreach($stripe->users as $user)
					@if($lmao == 10)
					<?php $lmao = 0; ?>
					</tr>
					<tr>
					@else
					<?php $lmao++; ?>
					<td>{{$user->name}} {{$user->surname}} {{$user->class}}</td>
					@endif
					@endforeach
				</tr>
			<?php $ayy++; ?>
			@endforeach
		    </tbody>
			</table>
		</div>
		</div>
		</div>
	</div>
	</body>
</html>