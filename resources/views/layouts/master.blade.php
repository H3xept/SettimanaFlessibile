<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="Settimana flessibile - Liceo Scientifico Statale Galieo Galilei, Perugia">
	    <meta name="author" content="Leonardo Cascianelli">
	    <link rel="icon" href="">
	    <title>Galilei flessibile - 2015</title>
	    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
	    <link href="{{ asset('css/bootstrap-theme.min.css')}}" rel="stylesheet">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	    <link href="{{ asset('css/priv.css')}}" rel="stylesheet">
	    <script src="{{ asset('js/dist/list.min.js') }}"></script>
	    <script src="{{ asset('js/dist/list.fuzzysearch.min.js') }}"></script>
		<style>body{padding-top:50px;}</style>
	</head>
	<body>
		    
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-4 col-md-offset-8 col-sm-offset-8">
					<div align="right">
						<h3>{!! Auth::user()->name , Auth::user()->surname!!} <small>{!! Auth::user()->class !!}</small></h3>
						<button class="btn btn-default">Impostazioni</button>
						<a class="btn btn-danger" href="{!!route('auth.logout')!!}">Esci</a>
					</div>
				</div>
			</div>
			<hr>
			<div class="row-fluid">

				<div class="col-md-4 col-sm-12">
					<div class="list-group">
	  					<a href="#" class="list-group-item disabled">
	    				Profilo
	  					</a>
	  					<a href="#" class="list-group-item">Corsi disponibili</a>
	  					<a href="#" class="list-group-item">Istruzioni</a>
					</div>
				</div>
				
				<div class="col-md-8 col-sm-12">
					@yield('content')
				</div>
			</div>
		</div>

	<!-- Needed shit -->
	<script src="{{ url('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">  
	<!-- Needed shit -->
	</body>

</html>