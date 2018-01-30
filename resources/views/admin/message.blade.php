@extends('admin.masters.layout')
@section('title','Admin')
@section('navbar')
  @parent
@endsection
@section('content')
<!-- Page content -->
<div id="page-content-wrapper">
  <div class="page-content">
    @if(session('msg_del'))
    <div class="col-md-10 col-md-offset-1">
      <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
        {{session('msg_del')}}
      </div>
    </div>
    @endif
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-danger" style="border-radius: 0;">
            <div class="panel-heading" style="border-radius: 0;">
              <center>
                <strong style="font-size: 25px; color: black;">All Message</strong>
              </center>
            </div>
            <div class="panel-body">
              <table id="employees" class="table table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <th>From</th>
                    <th>Email</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($message as $message)
                    <tr>
                      <td>{{ $message->name }}</td>
                      <td>{{ $message->email }}</td>
                      <td>
                        <form method="POST" action="/del_msg">
                        {{csrf_field()}}
                          <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#message{{$message->id}}"><i data-toggle="onPoint" data-placement="left" title="View" class="glyphicon glyphicon-resize-full"></i></a>
                          <input type="hidden" name="del_msg" value="{{$message->id}}">
                          <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#msg_del{{$message->id}}"><i data-toggle="onPoint" data-placement="right" title="Delete" class="glyphicon glyphicon-trash"></i></button>
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

@foreach($message2 as $message)
<!-- View message/feedback -->
<div class="modal fade" id="message{{$message->id}}" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #363c49;">
        <button style="color: white;" type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: white;">Message</h4>
      </div>
      <div class="modal-body">
        <table class="table">
        <thead>
          <tr>
            <th>From</th>
            <td>{{ $message->name }}</td>
          </tr>
          </thead>
          <tr>
            <th>Email</th>
            <td>{{ $message->email }}</td>
          </tr>
          <tr>
            <th>Date/Time</th>
            <td>{{ Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</td>
          </tr>
          <tr>
            <th>Message</th>
            <td>{!! nl2br (e($message->message)) !!}</td>
          </tr>
        </table>
      </div>
      <div class="modal-footer" style="border-radius: 0; background-color: #363c49">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach

@foreach($message2 as $message)
<div class="modal fade" id="msg_del{{$message->id}}" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Message</h4>
      </div>
      <div class="modal-body">
        <h3>Are You Sure?</h3>
      </div>
      <div class="modal-footer">
      <form method="POST" action="/del_msg">
      {{csrf_field()}}
        <input type="hidden" name="del_msg" value="{{$message->id}}">
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