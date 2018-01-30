<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>AIMS Event</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/welcome.css">
  <link rel="stylesheet" type="text/css" href="css/event.css">
  <link href='css/fullcalendar.min.css' rel='stylesheet' />
  <link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
  <link rel="stylesheet" type="text/css" href="css/show.css">
  <script src="js/show.js"></script>
  <script src='js/moment.min.js'></script>
  <script src='js/jquery.min.js'></script>
  <script src='js/fullcalendar.min.js'></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/welcome.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <style>
      #calendar {
        max-width: 900px;
        margin: 0 auto;
      }
    </style>
    <script>
 
      $(document).ready(function() {
        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
          },
          editable: true,
          eventLimit: true, // allow "more" link when too many events
          events: [
          @foreach($eventcal as $event)
            {
              title: '{{ $event->name }}',
              start: '{{ $event->date }}',
              url: '/event/{{$event->id}}'
            },
            @endforeach 
            @foreach($pasteventcal as $pastevent)
            {
              title: '{{ $pastevent->name }}',
              start: '{{ $pastevent->date }}',
              url: '/pastevent'
            },
            @endforeach      
          ],
        });
      });
    </script> 

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/">AIMS Event</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <form class="navbar-form navbar-right">
        <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Search Event">
          <div class="input-group-btn">
            <button class="btn btn-default" style="padding: 6px;" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#myPage">HOME</a></li>
        <li><a href="#event">EVENT</a></li>
        <li><a href="#pastevent">PAST EVENT</a></li>
        <li><a href="#contact">CONTACT</a></li>
        @if(Auth::check())
          @if(Auth::user()->type == 'admin')
            <li><li><a href="/login">ADMIN HOME</a></li></li>
          @else
            <li><li><a href="/login">CREATE EVENT</a></li></li>
          @endif
        @else
        <li><a href="/login">LOGIN</a></li>
        @endif
      </ul>
    </div>
  </div>
</nav>
<br>
<br>
<!-- <div class="container-fluid"> -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="images/body.jpg" alt="New York" width="1200" height="700">
      <div class="carousel-caption s">
        @if(session('msg_success'))
        <div class="alert alert-success fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
          {{session('msg_success')}}
        </div>
        @endif
        @if(session('fdb_success'))
        <div class="alert alert-success fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
          {{session('fdb_success')}}
        </div>
        @endif
        @if($search != "null")
        <div class="container-fluid cp">
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
            @if(count($search)==0)
            <div class="container-fluid cp">
              <div class="row">
                  <div class="col-sm-12">
                    <div class="alert alert-success fade in" style="padding: 3px; background-color: black; color: white;">
                      <a style="color: white; cursor: pointer;" href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      No Event available!
                    </div>
                  </div>
              </div>
            </div>
            @else
            <div class="col-md-12">
              <div class="panel panel-default t">
                  <i style="color: black;"> Available Search Result</i>
                  <span class="pull-right" style="cursor: pointer;" onclick="this.parentElement.style.display='none'"><b style="color: red;"> X</b></span>
                <div class="panel-body">
                  @foreach($search as $search)
                  <div class="col-sm-6">
                    <div class="chip">
                      <a href="/event/{{$search->id}}">{{$search->name}}</a>
                      <span class="closebtn" style="cursor: pointer;" onclick="this.parentElement.style.display='none'">&times;</span>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            @endif
            </div>
          </div>
        </div>
        @endif
      </div>      
    </div>
  </div>
  <!-- Container (The Band Section) -->
  <div id="event" class="text-center">
  <br>
  <br>
  <br>
  <div class="col-md-12">
    <div class="col-md-9">
      <div class="panel panel-info" style="border-radius: 0px;">
        <div class="panel-heading" style="border-radius: 0px;">
          <b class="text-center">AIMS Event Calendar</b>
        </div>
        <div class="panel-body" style="border-radius: 0px;">
          <div id="calendar"></div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
    <h3>UPCOMING EVENTS</h3>
    @foreach($event2 as $event)
      <div class="event">
        <center>
        <img src="images/{{$event->image}}" class="img-rounded img-responsive image" style="object-fit:contain; overflow:hidden; height:300px; width:300px;">
        </center>
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
      @endforeach
    </div>
    </div>
  </div>
  <br>
  <center>
    <a href="/allevent" class="btn">View More</a>
  </center>
  <br>
  <br>

  <!-- Container (TOUR Section) -->
  <div id="pastevent" class="bg-1">
    <div class="container text-center">
        <br>
        <br>
        <h3>PAST EVENTS</h3>
        @foreach($pastevent2 as $pastevent)
        <br>
        <div class="clearfix col">
          <img src="images/{{$pastevent->image}}" class="img-rounded img2" style="object-fit:contain; overflow:hidden; height:170px; width:170px;">
          <div class="col-md-4 col-md-offset-4">
            <b style="font-size: 20px;">{{$pastevent->name}}</b>
            <br>
            <i class="glyphicon glyphicon-calendar"></i> {{$pastevent->date}}
            <br>
            <i class="fa fa-map-marker"></i> {{$pastevent->location_id}}
            <br>
            <button class="btn" data-toggle="modal" data-target="#myModal{{$pastevent->id}}">Feedback</button>
          </div>
        </div>
        @endforeach
    </div>
    <br>
    <br>
    <center>
        <a href="/pastevent" class="btn">View More</a>
    </center>
    <br>
    <br>
  </div>

  <!-- Container (Contact Section) -->
  <div id="contact" class="container">
  <br>
  <br>
  <h3 class="text-center">Contact Us</h3>
  <div class="row">
    <div class="col-md-4">
      <p><b>AIMS Institute of Higher Education</b></p>
      <p><span class="glyphicon glyphicon-map-marker"></span> 1st Cross, 1st Phase, Peenya, Bengaluru, Karnataka 560058</p>
      <p><span class="glyphicon glyphicon-phone-alt"></span> 080 2839 0433</p>
      <p><span class="glyphicon glyphicon-envelope"></span> <a href="https://mail.google.com/mail/?view=cm&fs=1&to=aims@theaims.co.in&su=AIMS Event" target="_blank">aims@theaims.ac.in</a></p>
    </div>
    <div class="col-md-8">
    <form method="POST" action="/message">
      {{csrf_field()}}
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="message" name="message" placeholder="Message" rows="5"></textarea>
      <br>
      <div class="row">
        <div class="col-md-12 form-group">
          <button class="btn pull-right" type="submit">Send</button>
        </div>
      </div>
    </form>
    </div>
  </div>
  </div>

<!-- Add Google Maps -->
<div id="googleMap"></div>
<script>
function myMap() {
  var myCenter = new google.maps.LatLng(13.035592, 77.518611);
  var mapProp = {center:myCenter, zoom:15, mapTypeId:google.maps.MapTypeId.ROADMAP};
  var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
  var marker = new google.maps.Marker({position:myCenter});
  marker.setMap(map);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqmtjnp-aBD0mO-tEKaW7wXsdyricz9N4&callback=myMap"></script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

<!-- Footer -->
<footer class="text-center">
  <a class="up-arrow" href="#myPage" title="GO TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <br>
    <!--Facebook-->
    <a href="https://www.facebook.com/AIMS1994" target="_blank" type="button" class="btn-floating btn-small btn-fb" title="Facebook"><i class="fa fa-facebook"></i></a>
    &nbsp;&nbsp;
    <!--Twitter-->
    <a href="https://twitter.com/AIMSinstitutes" title="Twitter" target="_blank" type="button" class="btn-floating btn-small btn-tw"><i class="fa fa-twitter"></i></a>
    &nbsp;&nbsp;
    <!--Linkedin-->
    <a href="https://www.linkedin.com/company-beta/630596/" title="Linkedin" target="_blank" type="button" class="btn-floating btn-small btn-li"><i class="fa fa-linkedin"></i></a>
    &nbsp;&nbsp;
    <!--Youtube-->
    <a href="https://www.youtube.com/channel/UCg7DpXvhmhzYg1Sno-h61gA" title="Youtube" target="_blank" type="button" class="btn-floating btn-small btn-yt"><i class="fa fa-youtube"></i></a>
    <br>
    © 2017 Copyright, <a href="https://theaims.ac.in" target="_blank">AIMS</a>
  </footer>

  <!-- Modal -->
  @foreach($pastevent2 as $pastevent)
  <div class="modal fade" id="myModal{{$pastevent->id}}" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><button type="button" class="btn" data-toggle="modal" data-target="#myevent{{$pastevent->id}}">{{$pastevent->name}}</button><i class="pull-right"><- Click here to view the event</i></h4>
        </div>
        <div class="modal-body h">
          <center>
            <h1>EVENT FEEDBACK FORM</h1>
            <p>Please help us evaluate our event by completing this short survey. We will use your feedback to determine how we can improve our future events.</p>
          </center>
          <hr>
          <form method="POST" action="/feedback">
            {{csrf_field()}}
          <input type="hidden" name="event_id" value="{{$pastevent->id}}">
          <label>How did you hear about this event?</label><br>
          <select class="form-control" required="" name="option">
            <option></option>
            <option value="Friends/Family">Friends/Family</option>
            <option value="Co-workers/Colleagues">Co-workers/Colleagues</option>
            <option value="Web">Web</option>
            <option value="Other">Other</option>
          </select>
          <hr>
          <label>Have you attended this event before?</label><br>
          <input type="radio" required="" name="attend" value="Yes"> Yes<br>
          <input type="radio" required="" name="attend" value="No"> No
          <hr>
          <label>Would you recommend about this event to your friend?</label><br>
          <input type="radio" required="" name="recom" value="Yes"> Yes<br>
          <input type="radio" required="" name="recom" value="No"> No
          <hr>
          <label>Overall Satisfaction</label><br>
          <table class="table-bordered">
            <thead>
              <tr style="padding-left: 30px;">
                <th></th>
                <th>Very Bad</th>
                <th>Bad</th>
                <th>Ok</th>
                <th>Good</th>
                <th>Excellent</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <tr>
                <td>Date</td>
                <td><input type="radio" name="date" required="" value="Very Bad"></td>
                <td><input type="radio" name="date" required="" value="Bad"></td>
                <td><input type="radio" name="date" required="" value="Ok"></td>
                <td><input type="radio" name="date" required="" value="Good"></td>
                <td><input type="radio" name="date" required="" value="Excellent"></td>
              </tr>
              <tr>
                <td>Location</td>
                <td><input type="radio" name="loc" required="" value="Very Bad"></td>
                <td><input type="radio" name="loc" required="" value="Bad"></td>
                <td><input type="radio" name="loc" required="" value="Ok"></td>
                <td><input type="radio" name="loc" required="" value="Good"></td>
                <td><input type="radio" name="loc" required="" value="Excellent"></td>
              </tr>
              <tr>
                <td>Interesting and Entertaining</td>
                <td><input type="radio" name="interest" required="" value="Very Bad"></td>
                <td><input type="radio" name="interest" required="" value="Bad"></td>
                <td><input type="radio" name="interest" required="" value="Ok"></td>
                <td><input type="radio" name="interest" required="" value="Good"></td>
                <td><input type="radio" name="interest" required="" value="Excellent"></td>
              </tr>
              <tr>
                <td>Relevant to you</td>
                <td><input type="radio" name="relevant" required="" value="Very Bad"></td>
                <td><input type="radio" name="relevant" required="" value="Bad"></td>
                <td><input type="radio" name="relevant" required="" value="Ok"></td>
                <td><input type="radio" name="relevant" required="" value="Good"></td>
                <td><input type="radio" name="relevant" required="" value="Excellent"></td>
              </tr>
              <tr>
                <td>Inspiring</td>
                <td><input type="radio" name="inspiring" required="" value="Very Bad"></td>
                <td><input type="radio" name="inspiring" required="" value="Bad"></td>
                <td><input type="radio" name="inspiring" required="" value="Ok"></td>
                <td><input type="radio" name="inspiring" required="" value="Good"></td>
                <td><input type="radio" name="inspiring" required="" value="Excellent"></td>
              </tr>
            </tbody>
          </table>
          <hr>
          <label>How can we improve this event?</label><br>
          <textarea class="form-control" rows="5" name="message" required="" placeholder="Please leave a message"></textarea>
          <hr>
          <label>Would you like to hear about similar events in the future? If so, please provide your email address:</label><br>
          <input type="email" class="form-control" name="email" placeholder="ex:myname@gmail.com (*Optional*)">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  @endforeach

  @foreach($pastevent2 as $pastevent)
  <div class="modal fade" id="myevent{{$pastevent->id}}" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{$pastevent->name}}</h4>
        </div>
        <div class="modal-body">
          <div class="panel panel-info">
            <div class="panel-body">
              <p>{{$pastevent->date}} | {{$pastevent->location_id}}</p>
              <div class="col-md-6 col-md-offset-3 text-center">
                <center>
                <img src="{{URL::to('/')}}/images/{{$pastevent->image}}" class="img-responsive img-rounded" style="object-fit:contain; overflow:hidden; height:400px; width:400px;">
                </center>
              </div>
              <div class="col-md-6 text-center">
                <br>
                <h2>Time & Location</h2>
                <p><i class="fa fa-calendar"></i> {{ $pastevent->date }}</p>
                <p><i class="fa fa-map-marker"></i> {{ $pastevent->location_id }}</p>
                <hr>
                <h2>Hosted By</h2>
                <p>{{ $pastevent->User->department_id }}</p>
                <hr>
              </div>
              <div class="col-md-6">
                <br>
                <h2 class="text-center">About The Event</h2>
                <p class="text-justify"><div class="more"> {!!nl2br (e($pastevent->description)) !!}</div></p>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach

</body>
</html>