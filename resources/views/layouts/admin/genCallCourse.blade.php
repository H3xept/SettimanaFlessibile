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
		    <?php $stripes = $course->stripes(); $ayy = 1;?>
			@for($i = 0; $i < 9; $i++)
<?php dd($stripes->where("stripe_number",6)); ?>
			@if($stripes->where("stripe_number",$i+1)->get()->first() == NULL) @continue;
			@endif
			
			<?php $tmp = $stripes->where("stripe_number",6)->get()->first(); dd($tmp); ?>
				<table class="table table-bordered table-condensed">
			    <thead>
			      <tr>
			        <th>{{$tmp["course"]["name"]}}</th>
			        <th>{{$ayy}}</th>
			      </tr>
			    </thead>
			    <tbody>
				<tr>

				</tr>
			<?php $ayy++; ?>
			@endfor
		    </tbody>
			</table>
		</div>
		</div>
		</div>
	</div>
	</body>
</html>