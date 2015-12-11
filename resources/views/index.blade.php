

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
    <link href="{{ asset('css/bootstrap-theme.min.css')}}" rel="stylesheet">
        
  </head>

  <body>

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <form action="{{route('auth.postLogin')}}" class="form-signin" role="form" method="POST">
        {!! csrf_field() !!}
          <h2 class="form-signin-heading">Inserire i dati di Login</h2>
          <input type="text" class="form-control" placeholder="Nome" required autofocus name="name">
          <input type="password" class="form-control" placeholder="Codice badge" required name="password">
          <label class="checkbox">
          </label>
          <button class="btn btn-lg btn-success btn-block" type="submit">Accedi</button>
          <a class="btn btn-lg btn-primary btn-block" role="button" href="http://iottanet.altervista.org/register.html">Registrati</a>
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
  $(".flash").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
  }, 1000);
</script>

<style>
body {
padding-top: 40px;
padding-bottom: 40px;
background-color: #eee;
}
.form-signin {
max-width: 330px;
padding: 15px;
margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
margin-bottom: 10px;
}
.form-signin .checkbox {
font-weight: normal;
}
.form-signin .form-control {
position: relative;
height: auto;
-webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
        box-sizing: border-box;
padding: 10px;
font-size: 16px;
}
.form-signin .form-control:focus {
z-index: 2;
}
.form-signin input[type="email"] {
margin-bottom: -1px;
border-bottom-right-radius: 0;
border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
margin-bottom: 10px;
border-top-left-radius: 0;
border-top-right-radius: 0;
}
</style>

</body>

</html>
