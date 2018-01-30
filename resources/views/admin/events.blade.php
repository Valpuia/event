@extends('admin.masters.layout')
@section('title','Admin')
@section('navbar')
  @parent
@endsection
@section('content')
<!-- Page content -->
<div id="page-content-wrapper">
  <div class="page-content">
    @if(session('del_evn'))
    <div class="col-md-10 col-md-offset-1">
      <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
        {{session('del_evn')}}
      </div>
    </div>
    @endif
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-danger" style="border-radius: 0;">
            <div class="panel-heading" style="border-radius: 0;">
              <center>
                <strong style="font-size: 25px; color: black;">All Events</strong>
              </center>
            </div>
            <div class="panel-body">
              <table id="employees" class="table table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <th>Event Name</th>
                    <th>Place</th>
                    <th>From</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($event as $event)
                  <tr>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->location_id }}</td>
                    <td>{{ $event->User->department_id }}</td>
                    <td>
                      <form method="POST" action="/del_event">
                      {{csrf_field()}}
                        <a href="" class="btn btn-info btn-xs" data-toggle="modal" data-target="#event{{$event->id}}"><i class="glyphicon glyphicon-resize-full" data-toggle="onPoint" data-placement="left" title="View"></i></a>
                        <input type="hidden" name="del_event" value="$event->id">
                        <a href="" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#del_event{{$event->id}}"><i data-toggle="onPoint" data-placement="right" title="Delete" class="glyphicon glyphicon-trash"></i></a>
                      </form>
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
  </div>
</div>

@foreach($event2 as $event)
<!-- View message/feedback -->
<div class="modal fade" id="event{{$event->id}}" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: black;">
        <button style="color: white;" type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: white;">{{$event->name}}</h4>
      </div>
      <div class="modal-body">
        <center>
          <img src="images/{{$event->image}}" class="img-rounded" style="object-fit:contain; overflow:hidden; height:300px; width:300px;">
        </center>
        <table class="table">
          <tbody>
            <tr>
              <th>Event Name</th>
              <td>{{$event->name}}</td>
            </tr>
            <tr>
              <th>From</th>
              <td>{{$event->User->department_id}}</td>
            </tr>
            <tr>
              <th>Start</th>
              <td>{{$event->date}}</td>
            </tr>
            <tr>
              <th>Place</th>
              <td>{{$event->location_id}}</td>
            </tr>
            <tr>
              <th>Description</th>
              <td>{!! nl2br (e($event->description)) !!}</td>
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

@foreach($event2 as $event)
<div class="modal fade" id="del_event{{$event->id}}" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Event?</h4>
      </div>
      <div class="modal-body">
        <h3>Are You Sure?</h3>
      </div>
      <div class="modal-footer">
      <form method="POST" action="/del_event">
      {{csrf_field()}}
        <input type="hidden" name="del_event" value="{{$event->id}}">
        <input type="submit" value="Yes" class="btn btn-info pull-left">
      </form>
        <button class="btn btn-danger pull-right" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
@endforeach

<script src="js/navbar.js"></script>
<script type="text/javascript">
  $('#employees').dataTable();

  $(document).ready(function(){
    $('[data-toggle="onPoint"]').tooltip();   
  });
</script>
@endsection
@section('footer')
  @parent
@endsection