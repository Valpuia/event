<!DOCTYPE html>
<html>
<head>
  <title>Past Event</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/event.css">
  <link rel="stylesheet" type="text/css" href="css/show.css">
  <script src="js/show.js"></script>
</head>
<body>
  <br>
  <div class="col-md-6 col-md-offset-3">
    <ul class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/allevent">Upcoming Event</a></li>
      <li>Past Event</li>
    </ul>
  </div>
  <div class="col-md-12">
  @foreach($pastevent as $pastevent)
    <center>
      <div class="col-md-3">
        <div class="event">
          <img src="images/{{$pastevent->image}}" class="image img-responsive" style="object-fit:contain; overflow:hidden; height:300px; width:300px;">
          <div class="middle">
            <div class="text">{{$pastevent->name}}</div>
            <div class="text2">
              <i class="glyphicon glyphicon-calendar"></i> {{$pastevent->date}}
              <br>
              <i class="fa fa-map-marker"></i> {{$pastevent->location_id}}
              <br>
            </div>
            <button class="btn" data-toggle="modal" data-target="#myModal{{$pastevent->id}}">Feedback</button>
          </div>
          <p>{{$pastevent->name}}</p>
        </div>
      </div>
    </center>
  @endforeach
  </div>

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
                <p class="text-justify"><div class="more">{!!nl2br (e($pastevent->description)) !!}</div></p>
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