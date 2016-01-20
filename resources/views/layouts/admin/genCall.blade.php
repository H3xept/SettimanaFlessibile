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
			<?php $stripes = $user->stripes; $stripes_p = [];?>
				<td>{{$user->name}} {{$user->surname}}</td>

				@for($i = 0; $i < 9; $i++)
				@if(isset($stripes[$i+1]))
				<?php $stripes_p[$stripes[$i]->stripe_number] = $stripes[$i]['course']['name']; ?>
				@else
				<?php $rfins = $user->referringInStripe($i+1); if($rfins) {$str_tmp = $user->courseWithStripe($i+1)->name;} else $str_tmp = ""; ?>
				@if($str_tmp == "")
				<?php $stripes_p[$i+1] = ""; ?>
				@else
				<td>{{$str_tmp}}</td>
				@endif
				@endif
				@endfor
				@for($i=0;$i<9;$i++)
				<?php dd($stripes_p); ?>
				@if(array_key_exists($i+1, $stripes_p))
					<td>{{$stripes_p[$i+1]}}</td>
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