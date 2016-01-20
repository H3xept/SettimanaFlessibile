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
			<?php 

				if(function_exists("sort_")){

				}else{
				function sort_($a,$b)
				{
					if(intval($a->['stripe_number']) == intval($b->['stripe_number']))
						return 0;
					return intval($a->['stripe_number']) < intval($b->['stripe_number']) ? -1 : 1;
				}
				}

				$stripes = $user->stripes->toArray();
				dd($stripes);
				usort($stripes,"sort_");
			?>
				<td>{{$user->name}} {{$user->surname}}</td>

				@for($i = 0; $i < 9; $i++)
				@if(isset($stripes[$i+1]))
				<td>{{$stripes[$i+1]['course']['name']}}</td>
				@else 
				<?php $rfins = $user->referringInStripe($i+1); if($rfins) {$str_tmp = $user->courseWithStripe($i+1)->name;} else $str_tmp = ""; ?>
				<td>{{$str_tmp}}</td>
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