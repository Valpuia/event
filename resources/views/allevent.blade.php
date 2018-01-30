<!DOCTYPE html>
<html>
<head>
  <title>Event</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/event.css">
</head>
<body>
  <br>
  <div class="col-md-6 col-md-offset-3">
    <ul class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li>Upcoming Event</li>
      <li><a href="/pastevent">Past Event</a></li>
    </ul>
  </div>
  <div class="col-md-12">
  @foreach($event as $event)
    <center>
      <div class="col-md-3">
        <div class="event">
          <img src="images/{{$event->image}}" class="image img-responsive" style="object-fit:contain; overflow:hidden; height:300px; width:300px;">
          <div class="middle">
            <div class="text">{{$event->name}}</div>
            <div class="text2">
              <i class="glyphicon glyphicon-calendar"></i> {{$event->date}}
              <br>
              <i class="fa fa-map-marker"></i> {{$event->location_id}}
              <br>
            </div>
            <a href="/event/{{$event->id}}" class="btn">View Details</a>
          </div>
          <p>{{$event->name}}</p>
        </div>
      </div>
    </center>
  @endforeach
  </div>
</body>
</html>