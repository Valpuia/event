<!DOCTYPE html>
<html>
<head>
  <title>Create Event</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/dataTables.bootstrap.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
    .j{
      border-radius: 0;
    }
  </style>
</head>
<body>
  <br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <ul class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li><a href="/create">Create</a></li>
          <li><a href="/myevent">My Event</a></li>
          <li>Feedback</li>
          <li class="pull-right"><a href="/logout">Logout</a></li>
        </ul>
      </div>
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info j">
          <div class="panel-heading j">
            <center>
              <strong style="font-size: 25px; color: black;">My Event Feedback</strong>
            </center>
          </div>
          <div class="panel-body">
            <table id="employees" class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th>Event Name</th>
                  <th>Date</th>
                  <th>View</th>
                </tr>
              </thead>
              <tbody>
                @foreach($feedback as $feedback)
                @if($feedback->Event->user_id == Auth::user()->id)
                <tr>
                  <td>{{$feedback->Event->name}}</td>
                  <td>{{$feedback->created_at}}</td>
                  <td>
                    <button type="button" data-toggle="modal" data-target="#feedback{{$feedback->id}}" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-resize-full"></i></button>
                  </td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  @foreach($feedback2 as $feedback)
  <div class="modal fade" id="feedback{{$feedback->id}}" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: black;">
          <button style="color: white;" type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color: white;">{{$feedback->Event->name}}</h4>
        </div>
        <div class="modal-body">
          <table class="table">
            <tbody>
              <center>
                <img src="images/{{$feedback->Event->image}}" class="image img-responsive" style="object-fit:contain; overflow:hidden; height:300px; width:300px;">
              </center>
              <tr>
                <th>How/ From?</th>
                <td>{{$feedback->from}}</td>
              </tr>
              <tr>
                <th>Are they Attend?</th>
                <td>{{$feedback->attending}}</td>
              </tr>
              <tr>
                <th>Recommend Others?</th>
                <td>{{$feedback->recommend}}</td>
              </tr>
              <tr>
                <th>Good/Bad</th>
                <td>
                  <b>Date:</b> {{$feedback->date}}<br>
                  <b>Location:</b> {{$feedback->location}}<br>
                  <b>Interest:</b> {{$feedback->interest}}<br>
                  <b>Relevant:</b> {{$feedback->relevant}}<br>
                  <b>Inspired:</b> {{$feedback->inspiring}}
                </td>
              </tr>
              <tr>
                <th>Message?</th>
                <td>{!! nl2br (e($feedback->message)) !!}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer" style="border-radius: 0; background-color: black;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach

  <script type="text/javascript">
    $('#employees').dataTable();
  </script>     
</body>
</html>