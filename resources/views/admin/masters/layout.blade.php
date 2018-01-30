<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/navbar.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
    <style type="text/css">
      a:hover{
        text-decoration: none;
        cursor: pointer;
      }
      .form-control{
        border-radius: 0;
      }
      .t{
        border-radius: 0;
      }
    </style>
  </head>
  <body>
  @section('navbar')
  <div id="wrapper">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div  class="navbar-brand">
            <a id="menu-toggle" href="#" class="fa fa-bars btn-menu toggle"></a>
          </div>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/admin"><span class="fa fa-home"><strong> Home</strong></span></a></li>
            <li><a href="" data-toggle="modal" data-target="#password"><span class="fa fa-lock"><strong> Password</strong></span></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/logout"><span class="fa fa-sign-out"></span><strong> Logout</strong></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <nav id="spy">
        <ul class="sidebar-nav nav">
          <li>
            <a href="/admin"><span class="fa fa-th-list solo">Dashboard</span></a>
          </li>
          <li>
            <a href="/events">
              <span class="fa fa-calendar solo">All Events</span>
            </a>
          </li>
          <li>
            <a href="/manage">
              <span class="fa fa-group  solo">Manage User</span>
            </a>
          </li>
          <li>
            <a href="/department">
              <span class="fa fa-graduation-cap  solo">Department</span>
            </a>
          </li>
          <li>
            <a href="/location">
              <span class="fa fa-map-marker  solo">Location</span>
            </a>
          </li>
          <li>
            <a href="/all_message">
              <span class="fa fa-envelope  solo">Messages</span>
            </a>
          </li>
          <li>
            <a href="/allfeedback">
              <span class="fa fa-comments  solo">Feedback</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>

    <!-- Modal content-->
    <div id="password" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Change Password?</h4>
          </div>
          <form method="POST" action="/change_password">
            {{ csrf_field() }}
            <div class="modal-body">
              <label>Enter your password</label>
              <div class="input-group">
                <span class="input-group-addon t"><i class="glyphicon glyphicon-lock"></i></span>
                <input required="" type="password" class="form-control" name="oldpassword" placeholder="Current Password">
              </div>
              <hr>
              <label>Enter new password</label>
              <div class="input-group">
                <span class="input-group-addon t"><i class="glyphicon glyphicon-lock"></i></span>
                <input required="" type="password" class="form-control" name="newpassword" placeholder="atleast 6 character">
              </div>
              <label>Retype password</label>
              <div class="input-group">
                <span class="input-group-addon t"><i class="glyphicon glyphicon-lock"></i></span>
                <input required="" type="password" class="form-control" name="confirm_password" placeholder="atleast 6 character">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-default">Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  @show
  @yield('content')
  @section('footer')
  </body>
</html>
@show

