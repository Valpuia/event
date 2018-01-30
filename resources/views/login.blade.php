<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/login.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <br>
    <div class="col-md-6 col-md-offset-3">
      <h2><center>LOGIN</center></h2>
      <form method="POST" action="/login" class="form">
      {{csrf_field()}}
        <div class="imgcontainer">
          <img src="images/admin.png" alt="Images" class="avatar">
        </div>
          <label><b>Email</b></label>
          <input type="email" class="inp" required="" placeholder="Enter email" name="email">
          <label><b>Password</b></label>
          <input type="password" class="inp" required="" placeholder="Enter Password" name="password">
          @if(session('error'))
            <div class="alert alert-danger" style="border-radius: 0;">{{session('error')}}</div>
          @endif 
          <button type="submit" class="button">Login</button>
          <a href="/" class="btno pull-right">Back to Home</a>
          <input type="checkbox" checked="checked"> Remember me
          <p class="pull-right">Forgot <a href="/reset/password">password?</a>
      </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>