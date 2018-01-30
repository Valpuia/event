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
				 	<li>My Event</li>
          <li><a href="/myfeedback">Feedback</a></li>
					<li class="pull-right"><a href="/logout">Logout</a></li>
				</ul>
			</div>
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info j">
          <div class="panel-heading j">
            <center>
              <strong style="font-size: 25px; color: black;">My Event</strong>
            </center>
          </div>
          <div class="panel-body">
            <table id="employees" class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Venue</th>
                  <th>View</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($event as $event)
              	<tr>
              		<td>{{ $event->name }}</td>
              		<td>{{ $event->date }}</td>
                  <td>{{ $event->location_id }}</td>
              		<td>
                    <button type="button" data-toggle="modal" data-target="#event{{$event->id}}" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-resize-full"></i></button>
              		</td>
              	</tr>
              	@endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
		</div>
	</div>

  @foreach($event2 as $event)
  <div class="modal fade" id="event{{$event->id}}" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{$event->name}}</h4>
        </div>
        <div class="modal-body">
          <p>{{$event->date}} | {{$event->location_id}}</p>
          <div class="col-md-12 text-center">
            <center>
            <img src="{{URL::to('/')}}/images/{{$event->image}}" class="img-responsive img-rounded" style="object-fit:contain; overflow:hidden; height:400px; width:400px;">
            </center>
          </div>
          <div class="col-md-12 text-center">
            <br>
            <h2>Time & Location</h2>
            <p><i class="fa fa-calendar"></i> {{$event->date}}</p>
            <p><i class="fa fa-map-marker"></i> {{$event->location_id}}</p>
            <hr>
          </div>
          <div class="col-md-12 text-center">
            <br>
            <h2>About The Event</h2>
            <p> {!!nl2br (e($event->description)) !!}</p>
            <hr>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
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