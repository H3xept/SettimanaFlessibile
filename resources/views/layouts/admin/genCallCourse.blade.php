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
		<?php $stripes = $course->stripes(); $ayy = 1; ?>
		@for($i = 0; $i < 9; $i++) 
		<?php dd($stripes->where("stripe_number",$i+1)->get()); ?>
		@for($cn=0; $cn < 9; $cn++)
		<div class="table">
		<table class="table table-compressed table-grid">
		</table>
		</div>
		@endfor
		</div>
		</div>
	</div>
	</body>
</html>