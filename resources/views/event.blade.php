<!DOCTYPE html>
<html>
<head>
  <title>Event</title>
  <link href="{{URL::to('/')}}/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="{{URL::to('/')}}/js/bootstrap.min.js"></script>
  <script src="{{URL::to('/')}}/js/show.js"></script>
  <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/event.css">
  <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/show.css">
</head>
<body>
  <br>
  <div class="col-md-6 col-md-offset-3">
    <ul class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/allevent">Upcoming Event</a></li>
      <li>Event</li>
    </ul>
  </div>
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-info b">
      <div class="panel-heading">
        <p class="p">{{$event->name}}</p>
      </div>
      <div class="panel-body">
        <p>{{$event->date}} | {{$event->location_id}}</p>
        <div class="col-md-6 col-md-offset-3 text-center">
          <center>
          <img src="{{URL::to('/')}}/images/{{$event->image}}" class="img-responsive img-rounded" style="object-fit:contain; overflow:hidden; height:400px; width:400px;">
          </center>
        </div>
        <div class="col-md-6 text-center">
          <br>
          <h2>Time & Location</h2>
          <p><i class="fa fa-calendar"></i> {{ $event->date }}</p>
          <p><i class="fa fa-map-marker"></i> {{ $event->location_id }}</p>
          <hr>
          <h2>Hosted By</h2>
          <p>{{ $event->User->department_id }}</p>
          <p><a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $event->User->department_id }}@theaims.co.in&su={{ $event->name }}" target="_blank">{{ $event->User->department_id }}@theaims.ac.in</a></p>
          <hr>
        </div>
        <div class="col-md-6">
          <br>
          <h2 class="text-center">About The Event</h2>
          <p class="text-justify"><div class="more"> {!!nl2br (e($event->description)) !!}</div></p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
