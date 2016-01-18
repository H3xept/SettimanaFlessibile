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
		    <?php $stripes = $course->stripes; $ayy = 1; ?>
			@foreach($stripes as $stripe)

			@if(array_key_exists($ayy,$stripes))
				<?php dd("AYY"); ?>
				<table class="table">
			    <thead>
			      <tr>
			        <th>{{$stripe->course->name}}</th>
			        <th>{{$ayy}}</th>
			      </tr>
			    </thead>
			    <tbody>
				<tr>
					@foreach($stripe->users as $user)
					<td>{{$user->name}} {{$user->surname}}</td>
					@endforeach
				</tr>
			@endif
			$ayy++;
			@endforeach
		    </tbody>
			</table>
		</div>
		</div>
		</div>
	</div>
	</body>
</html>