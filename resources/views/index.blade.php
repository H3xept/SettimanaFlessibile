<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://www.galileipg.it/jml/templates/templatka11/images/favicon.ico">
    <title>Login Galilei Flessibile 2.0</title>
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/login.css')}}" rel="stylesheet">
  </head>

  <body>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        @if (isset($errors) && $errors->count() > 0)
          <div class="alert alert-danger flash" role="alert" align="center">{!!$errors->first()!!}</div>
        @endif
        <form action="{{route('auth.postLogin')}}" class="form-signin" role="form" method="POST">
          {!! csrf_field() !!}
          <h2 class="form-signin-heading">Inserire i dati di Login</h2>
          <input type="text" class="form-control" placeholder="Nome" required autofocus name="username">
          <input type="password" class="form-control" placeholder="Codice badge" required name="password">
          <button class="btn btn-lg btn-success btn-block" type="submit">Accedi</button>
          <a class="btn btn-lg btn-primary btn-block" role="button" href="{!!route('auth.getRegister')!!}">Registrati</a>
        </form>
      </div>
    </div> 
  </div>


    
<!-- Needed shit -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">  
<!-- Needed shit -->

<script>
  window.setTimeout(function() {
  $(".flash").fadeTo(1000, 0).slideUp(500, function(){
      $(this).remove();
  });
  }, 1500);
</script>

</body>

</html>
