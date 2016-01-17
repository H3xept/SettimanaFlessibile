<html>
	<head>
	    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
	    <link href="{{ asset('css/bootstrap-theme.min.css')}}" rel="stylesheet">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	</head>
	<body><br><br>
	<div class="container">
		<div class="row">
		<div class="col-md-12">
		<div class="table-responsive">
			<table class="table">
		    <thead>
		      <tr>
		        <th>Nome</th>
		        <th>Lunedi 1</th>
		        <th>Lunedi 2</th>
		        <th>Lunedi 3</th>
		        <th>Martedi 1</th>
		        <th>Martedi 2</th>
		        <th>Martedi 3</th>
		        <th>Giovedi 1</th>
		        <th>Giovedi 2</th>
		        <th>Giovedi 3</th>
		      </tr>
		    </thead>
		    <tbody>
			@foreach($users as $user)
			<tr>
			<?php $stripes = $user->stripes;?>
				<td>{{$user->name}} {{$user->surname}}</td>
				@for($i = 0; $i < 9; $i++)
				@if(isset($stripes[$i+1]))
				<td>{{$stripes[$i+1]['course']['name']}}</td>
				@else 
				<td></td>
				@endif
				@endfor
			</tr>
			@endforeach
		    </tbody>
			</table>
		</div>
		</div>
		</div>
	</div>
	</body>
</html>