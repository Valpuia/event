@extends('admin.masters.layout')
@section('title','Admin')
@section('navbar')
  @parent
@endsection
@section('content')
<!-- Page content -->
<div id="page-content-wrapper">
  <div class="page-content">
    @if(session('del_feed'))
    <div class="col-md-10 col-md-offset-1">
      <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
        {{session('del_feed')}}
      </div>
    </div>
    @endif
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-danger" style="border-radius: 0;">
            <div class="panel-heading" style="border-radius: 0;">
              <center>
                <strong style="font-size: 25px; color: black;">Feedbacks</strong>
              </center>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table id="employees" class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>Event Name</th>
                      <th>Received At</th>
                      <th>Option</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($feedback as $feedback)
                    <tr>
                      <td>{{ $feedback->Event->name }}</td>
                      <td>{{ $feedback->created_at }}</td>
                      <td>
                        <form method="POST" action="/del_feed">
                        {{csrf_field()}}
                          <a href="" class="btn btn-info btn-xs" data-toggle="modal" data-target="#feedback{{$feedback->id}}"><i class="glyphicon glyphicon-resize-full" data-toggle="onPoint" data-placement="left" title="View"></i></a>
                          <input type="hidden" name="del_feed" value="$feedback->id">
                          <a href="" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#del_feedback{{$feedback->id}}"><i data-toggle="onPoint" data-placement="right" title="Delete" class="glyphicon glyphicon-trash"></i></a>
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
</div>

@foreach($feedback2 as $feedback)
<!-- View message/feedback -->
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

@foreach($feedback2 as $feedback)
<div class="modal fade" id="del_feedback{{$feedback->id}}" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Feedback?</h4>
      </div>
      <div class="modal-body">
        <h3>Are You Sure?</h3>
      </div>
      <div class="modal-footer">
      <form method="POST" action="/del_feed">
      {{csrf_field()}}
        <input type="hidden" name="del_feed" value="{{$feedback->id}}">
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