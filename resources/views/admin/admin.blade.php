@extends('admin.masters.layout')
@section('title','Admin')
@section('navbar')
  @parent
@endsection
@section('content')
<!-- Page content -->
<div id="page-content-wrapper">
  <div class="page-content">
    <div class="container-fluid">
      <div class="col-md-12">
        @if(session('psw_success'))
          <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
            {{session('psw_success')}}
          </div>
        @elseif(session('psw_error'))
          <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
            {{session('psw_error')}}
          </div>
        @elseif(session('psw_error2'))
          <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
            {{session('psw_error2')}}
          </div>
        @elseif(session('pserror'))
          <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
            {{session('pserror')}}
          </div>
        @endif
      </div>
    </div>
    <div class="container-fluid">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-info" style="border-radius: 0;">
              <div class="panel-heading" style="border-radius: 0;">
                <center>
                  <strong style="font-size: 20px; color: black;">EVENTS</strong>
                  <a href="/events" class="btn btn-warning btn-sm pull-right" data-toggle="onPoint" data-placement="bottom" title="All Event"><i class="glyphicon glyphicon-calendar"> <span style="background-color: white; color: black;" class="badge">{{count($event)}}</span></i></a>
                  <select onchange="event_change()" id="event_table" class="input-sm pull-right">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="17">17</option>
                  </select>
                </center>
              </div>
              <div class="panel-body">
                @if(session('del_evn'))
                <div class="alert alert-success">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                  {{session('del_evn')}}
                </div>
                @endif
                <div class="table-responsive">
                  <table class="table table-condensed">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Venue</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <div class="hidden">{{$event_count = 1}}</div>
                      @foreach($event as $event)
                      <tr id="x{{$event_count++}}" class="">
                        <td>{{$event->name}}</td>
                        <td>{{$event->location_id}}</td>
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
                <center><a href="/events" class="btn btn-default btn-xs" data-toggle="onPoint" data-placement="top" title="View All">View all</a></center>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="panel panel-info" style="border-radius: 0;">
              <div class="panel-heading" style="; border-radius: 0;">
                <center>
                  <strong style="font-size: 20px; color: black;">ADD LOCATION</strong>
                  <a href="/location" class="btn btn-warning btn-sm pull-right" data-toggle="onPoint" data-placement="bottom" title="All Location"><i class="glyphicon glyphicon-map-marker"> <span style="background-color: white; color: black;" class="badge">{{count($loc)}}</span></i></a>
                  <select onchange="loc_change()" id="loc_table" class="input-sm pull-right">
                    <option value="3">3</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                  </select>
                </center>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                <form method="POST" action="/add_loc">
                  {{ csrf_field() }}
                  <div class="col-md-9">
                    <input type="text" name="name" class="form-control" placeholder="Venue">
                  </div>
                  <div class="col-md-3">
                    <button type="submit" class="btn btn-info form-control">Add</button>
                  </div>
                </form>
                <hr>
                @if(session('loc_success'))
                  <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                    {{session('loc_success')}}
                  </div>
                @endif
                @if(session('loc_error'))
                  <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                    {{session('loc_error')}}
                  </div>
                @endif
                @if(session('del_loc'))
                  <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                    {{session('del_loc')}}
                  </div>
                @endif
                @if(session('loc_err'))
                  <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                    {{session('loc_err')}}
                  </div>
                @endif
                @if(session('loc_update'))
                  <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                    {{session('loc_update')}}
                  </div>
                @endif
                  <table class="table table-condensed">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <div class="hidden">{{$loc_count = 1}}</div>
                      @foreach($loc as $loc)
                      <tr id="loc{{$loc_count++}}" class="">
                        <form method="POST" action="/update_loc">
                        {{csrf_field()}}
                        <td>
                          <input type="hidden" name="id" value="{{$loc->id}}">
                          <input id="showloctext{{$loc->id}}" type="text" class="hidden" value="{{$loc->name}}" name="name">
                          <p id="showloctext2{{$loc->id}}" class="">{{$loc->name}}</p>
                        </td>
                        <td>
                          <div id="hidelocGlyph{{$loc->id}}" class="pull-right">
                            <div onclick="editlocText{{$loc->id}}()" data-toggle="onPoint" data-placement="left" title="Edit" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i></div>
                          </div>
                          <div id="showlocGlyph{{$loc->id}}" class="hidden">
                            <button type="submit" class="btn btn-primary btn-xs" data-toggle="onPoint" data-placement="left" title="Save"><i class="glyphicon glyphicon-saved"></i></button>
                            <div onclick="editlocText2{{$loc->id}}()" data-toggle="onPoint" data-placement="right" title="Cancel" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-remove"></i></div>
                          </div>
                        </td>
                      </form>
                      <td>
                        <form method="POST" action="del_loc">
                          {{csrf_field()}}
                          <input type="hidden" name="delloc" value="{{$loc->id}}">
                          <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#del_loc{{$loc->id}}"><i data-toggle="onPoint" data-placement="right" title="Delete" class="glyphicon glyphicon-trash"></i></button>
                        </form>
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <center>
                    <a href="/location" class="btn btn-default btn-xs" data-toggle="onPoint" data-placement="top" title="View All">View all</a>
                  </center>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="panel panel-info" style="border-radius: 0;">
              <div class="panel-heading panel-responsive" style="border-radius: 0;">
                <center>
                  <strong style="font-size: 20px; color: black;">MESSAGE</strong>
                  <a href="/all_message" class="btn btn-warning btn-sm pull-right" data-toggle="onPoint" data-placement="bottom" title="All Message"><i class="glyphicon glyphicon-comment"> <span style="background-color: white; color: black;" class="badge">{{count($message)}}</span></i></a>
                  <select onchange="msg_change()" id="msg_table" class="input-sm pull-right">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="17">17</option>
                  </select>
                </center>
              </div>
              <div class="panel-body">
              @if(session('msg_del'))
                <div class="alert alert-success">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                  {{session('msg_del')}}
                </div>
              @endif
                <div class="table-responsive">
                  <table class="table table-condensed">
                    <thead>
                      <tr>
                        <th>From</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <div class="hidden">{{$count_msg = 1}}</div>
                    @foreach($message as $message)
                      <tr id="b{{ $count_msg++ }}" class="">
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
                <center><a href="/all_message" class="btn btn-default btn-xs" data-toggle="onPoint" data-placement="top" title="View All">View all</a></center>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-info" style="border-radius: 0;">
              <div class="panel-heading" style="; border-radius: 0;">
                <center>
                  <strong style="font-size: 20px; color: black;">ADD FACULTY</strong>
                  <button id="colorchange" onclick="addfaculty()" class="btn btn-primary btn-sm pull-right"><i id="changefaculty" class="glyphicon glyphicon-plus"></i></button>
                  <a href="/manage" class="btn btn-warning btn-sm pull-right" data-toggle="onPoint" data-placement="bottom" title="All Faculty"><i class="glyphicon glyphicon-user"> <span style="background-color: white; color: black;" class="badge">{{count($user)-1}}</span></i></a>
                  <select onchange="faculty_change()" id="faculty_table" class="input-sm pull-right">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="17">17</option>
                  </select>
                </center>
              </div>
              <div class="panel-body">
                <div id="addFaculty" class="hidden">
                  <form method="POST" action="/add_fac">
                  {{csrf_field()}}
                  <div class="input-group">
                    <span class="input-group-addon t"><i class="glyphicon glyphicon-user"></i></span>
                    <input required="" id="name" type="text" class="form-control" name="name" placeholder="Name">
                  </div><br>
                  <div class="input-group">
                    <span class="input-group-addon t"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input required="" id="email" type="email" class="form-control" name="email" placeholder="Email">
                  </div><br>
                  <div class="input-group">
                    <span class="input-group-addon t"><i class="glyphicon glyphicon-education"></i></span>
                    <select required="" class="form-control" name="department">
                      <option value="">Department</option>
                      @foreach($dept as $dept)
                        <option value="{{$dept->name}}">{{$dept->name}}</option>
                      @endforeach
                    </select>
                  </div><br>
                  <div class="input-group">
                    <span class="input-group-addon t"><i class="glyphicon glyphicon-lock"></i></span>
                    <input required="" id="password" type="text" class="form-control" name="password" placeholder="Password" value="aimsevent">
                  </div>
                  <br>
                  <button class="btn btn-primary form-control" type="submit">Add</button>
                  </form>
                  <br>
                  <br>
                </div>
                @if(session('fac_add'))
                  <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                    {{session('fac_add')}}
                  </div>
                @elseif(session('fac_error'))
                  <div class="alert alert-warning">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                    {{session('fac_error')}}
                  </div>
                @elseif(session('error'))
                  <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                    {{session('error')}}
                  </div>
                @endif
                @if(session('del_fac'))
                  <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                    {{session('del_fac')}}
                  </div>
                @elseif(session('fac_up'))
                  <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                    {{session('fac_up')}}
                  </div>
                @endif
                <div class="table-responsive">
                  <table class="table table-condensed">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <div class="hidden">{{$faculty_count = 1}}</div>
                      @foreach($user as $user)
                      @if($user->type == 'user')
                      <tr id="a{{$faculty_count++}}" class="">
                      <form method="POST" action="/update_user">
                      {{csrf_field()}}
                        <td>
                          <input type="hidden" name="id" value="{{$user->id}}">
                          <input id="showtext{{$user->id}}" type="text" class="hidden" value="{{$user->name}}" name="name">
                          <p id="showtext2{{$user->id}}" class="">{{$user->name}}</p>
                        </td>
                        <td>
                          <select id="showselect{{$user->id}}" required="" class="hidden" name="dept">
                            <option value="">-Department-</option>
                            @foreach($dept2 as $dept)
                            <option value="{{$dept->name}}">{{$dept->name}}</option>
                            @endforeach
                          </select>
                          <p id="showselect2{{$user->id}}" class="">{{$user->department_id}}</p>
                        </td>
                        <td>
                          <div id="hideGlyph{{$user->id}}" class="pull-right">
                            <div onclick="editText{{$user->id}}()" data-toggle="onPoint" data-placement="left" title="Edit" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i></div>
                          </div>
                          <div id="showGlyph{{$user->id}}" class="hidden">
                            <button type="submit" class="btn btn-primary btn-xs" data-toggle="onPoint" data-placement="left" title="Save"><i class="glyphicon glyphicon-saved"></i></button>
                            <div onclick="editText2{{$user->id}}()" data-toggle="onPoint" data-placement="right" title="Cancel" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-remove"></i></div>
                          </div>
                        </td>
                        </form>
                        <td>
                          <form method="POST" action="/del_fac">
                          {{csrf_field()}}
                          <input type="hidden" name="delfac" value="{{$user->id}}">
                          <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#fac_confirm{{$user->id}}"><i data-toggle="onPoint" data-placement="right" title="Delete" class="glyphicon glyphicon-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                      @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <center>
                  <a href="/manage" class="btn btn-default btn-xs" data-toggle="onPoint" data-placement="top" title="View All">View all</a>
                </center>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="panel panel-info" style="border-radius: 0;">
              <div class="panel-heading" style="; border-radius: 0;">
                <center>
                  <strong style="font-size: 20px; color: black;">ADD DEPARTMENT</strong>
                  <a href="/department" class="btn btn-warning btn-sm pull-right" data-toggle="onPoint" data-placement="bottom" title="All Department"><i class="glyphicon glyphicon-education"> <span style="background-color: white; color: black;" class="badge">{{count($dept2)}}</span></i></a>
                  <select onchange="dept_change()" id="dept_table" class="input-sm pull-right">
                    <option value="3">3</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                  </select>
                </center>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                <form method="POST" action="/add_dept">
                  {{ csrf_field() }}
                  <div class="col-md-9">
                    <input type="text" name="name" class="form-control" placeholder="New Department">
                  </div>
                  <div class="col-md-3">
                    <button type="submit" class="btn btn-info form-control">Add</button>
                  </div>
                </form>
                <hr>
                @if(session('dept_success'))
                  <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                    {{session('dept_success')}}
                  </div>
                @endif
                @if(session('dept_error'))
                  <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                    {{session('dept_error')}}
                  </div>
                @endif
                @if(session('dept_err'))
                  <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                    {{session('dept_err')}}
                  </div>
                @endif
                @if(session('dept_update'))
                  <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                    {{session('dept_update')}}
                  </div>
                @endif
                @if(session('del_dept'))
                  <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                    {{session('del_dept')}}
                  </div>
                @endif
                  <table class="table table-condensed">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <div class="hidden">{{$dept_count = 1}}</div>
                      @foreach($dept2 as $dept)
                      <tr id="dept{{$dept_count++}}" class="">
                        <form method="POST" action="/update_dept">
                          {{csrf_field()}}
                          <td>
                            <input type="hidden" name="id" value="{{$dept->id}}">
                            <input id="showdepttext{{$dept->id}}" type="text" class="hidden" value="{{$dept->name}}" name="name">
                            <p id="showdepttext2{{$dept->id}}" class="">{{$dept->name}}</p>
                          </td>
                          <td>
                            <div id="hidedeptGlyph{{$dept->id}}" class="pull-right">
                              <div onclick="editdeptText{{$dept->id}}()" data-toggle="onPoint" data-placement="left" title="Edit" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i></div>
                            </div>
                            <div id="showdeptGlyph{{$dept->id}}" class="hidden">
                              <button type="submit" class="btn btn-primary btn-xs" data-toggle="onPoint" data-placement="left" title="Save"><i class="glyphicon glyphicon-saved"></i></button>
                              <div onclick="editdeptText2{{$dept->id}}()" data-toggle="onPoint" data-placement="right" title="Cancel" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-remove"></i></div>
                            </div>
                          </td>
                        </form>
                        <td>
                          <form method="POST" action="del_dept">
                            {{csrf_field()}}
                            <input type="hidden" name="deldept" value="{{$dept->id}}">
                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#dept_confirm{{$dept->id}}"><i data-toggle="onPoint" data-placement="right" title="Delete" class="glyphicon glyphicon-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <center>
                    <a href="/department" class="btn btn-default btn-xs" data-toggle="onPoint" data-placement="top" title="View All">View all</a>
                  </center>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@foreach($dept2 as $dept)
<div class="modal fade" id="dept_confirm{{$dept->id}}" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Department</h4>
      </div>
      <div class="modal-body">
        <h3>Are You Sure?</h3>
      </div>
      <div class="modal-footer">
      <form method="POST" action="/del_dept">
      {{csrf_field()}}
        <input type="hidden" name="deldept" value="{{$dept->id}}">
        <input type="submit" value="Yes" class="btn btn-info pull-left">
      </form>
        <button class="btn btn-danger pull-right" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
@endforeach

@foreach($loc2 as $loc)
<div class="modal fade" id="del_loc{{$loc->id}}" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Location</h4>
      </div>
      <div class="modal-body">
        <h3>Are You Sure?</h3>
      </div>
      <div class="modal-footer">
      <form method="POST" action="/del_loc">
      {{csrf_field()}}
        <input type="hidden" name="delloc" value="{{$loc->id}}">
        <input type="submit" value="Yes" class="btn btn-info pull-left">
      </form>
        <button class="btn btn-danger pull-right" data-dismiss="modal">No</button>
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

@foreach($user2 as $user)
<div class="modal fade" id="fac_confirm{{$user->id}}" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Faculty</h4>
      </div>
      <div class="modal-body">
        <h3>Are You Sure?</h3>
      </div>
      <div class="modal-footer">
      <form method="POST" action="/del_fac">
      {{csrf_field()}}
        <input type="hidden" name="delfac" value="{{$user->id}}">
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
  // Hide/Show add faculty button
  function addfaculty(){
    if(document.getElementById("addFaculty").className=="hidden"){
      document.getElementById("addFaculty").className="";
      document.getElementById("changefaculty").className="glyphicon glyphicon-remove";
      document.getElementById("colorchange").className="btn btn-danger btn-sm pull-right";

    }else{
       document.getElementById("addFaculty").className="hidden";
       document.getElementById("changefaculty").className="glyphicon glyphicon-plus";
       document.getElementById("colorchange").className="btn btn-primary btn-sm pull-right";
    }
  }
  @foreach($user2 as $user)
  // Text disable/enable
  function editText{{$user->id}}(){
    document.getElementById("showtext{{$user->id}}").className=" form-control";
    document.getElementById("showtext2{{$user->id}}").className="hidden";
    document.getElementById("showGlyph{{$user->id}}").className="";
    document.getElementById("hideGlyph{{$user->id}}").className="hidden";
    document.getElementById("showselect{{$user->id}}").className="form-control";
    document.getElementById("showselect2{{$user->id}}").className="hidden";
  }
  function editText2{{ $user->id }}(){
    document.getElementById("showtext{{$user->id}}").className="hidden";
    document.getElementById("showtext2{{$user->id}}").className="";
    document.getElementById("showGlyph{{$user->id}}").className="hidden";
    document.getElementById("hideGlyph{{$user->id}}").className="pull-right";
    document.getElementById("showselect{{$user->id}}").className="hidden";
    document.getElementById("showselect2{{$user->id}}").className="";
  }
  @endforeach

  @foreach($loc2 as $loc)
  // Text disable/enable
  function editlocText{{$loc->id}}(){
    document.getElementById("showloctext{{$loc->id}}").className=" form-control";
    document.getElementById("showloctext2{{$loc->id}}").className="hidden";
    document.getElementById("showlocGlyph{{$loc->id}}").className="pull-right";
    document.getElementById("hidelocGlyph{{$loc->id}}").className="hidden";
  }
  function editlocText2{{ $loc->id }}(){
    document.getElementById("showloctext{{$loc->id}}").className="hidden";
    document.getElementById("showloctext2{{$loc->id}}").className="";
    document.getElementById("showlocGlyph{{$loc->id}}").className="hidden";
    document.getElementById("hidelocGlyph{{$loc->id}}").className="pull-right";
  }
  @endforeach

  @foreach($dept2 as $dept)
  // Text disable/enable
  function editdeptText{{$dept->id}}(){
    document.getElementById("showdepttext{{$dept->id}}").className=" form-control";
    document.getElementById("showdepttext2{{$dept->id}}").className="hidden";
    document.getElementById("showdeptGlyph{{$dept->id}}").className="pull-right";
    document.getElementById("hidedeptGlyph{{$dept->id}}").className="hidden";
  }
  function editdeptText2{{ $dept->id }}(){
    document.getElementById("showdepttext{{$dept->id}}").className="hidden";
    document.getElementById("showdepttext2{{$dept->id}}").className="";
    document.getElementById("showdeptGlyph{{$dept->id}}").className="hidden";
    document.getElementById("hidedeptGlyph{{$dept->id}}").className="pull-right";
  }
  @endforeach

  $(document).ready(function(){
    $('[data-toggle="onPoint"]').tooltip();   
  });

  var eve;
  var counting4 = {{ $event_count }}-1;
  $(document).ready(function(){
    if(counting4>5){
      for(eve_b=counting4;eve_b>5;eve_b--){
        document.getElementById("x"+eve_b).className="hidden";
      }
    }
  });
  function event_change(){
    eve = document.getElementById("event_table").value;
    if(eve==5){
      for(eve_b=counting4;eve_b>5;eve_b--){
        document.getElementById("x"+eve_b).className="hidden";
      }
      for(eve_b=1;eve_b<=5;eve_b++){
        document.getElementById("x"+eve_b).className="";
      }
    }else if(eve==10){
      for(eve_b=counting4;eve_b>10;eve_b--){
        document.getElementById("x"+eve_b).className="hidden";
      }
      for(eve_b=1;eve_b<=10;eve_b++){
        document.getElementById("x"+eve_b).className="";
      }
    }else if(eve==17){
      for(eve_b=counting4;eve_b>17;eve_b--){
        document.getElementById("x"+eve_b).className="hidden";
      }
      for(eve_b=1;eve_b<=17;eve_b++){
        document.getElementById("x"+eve_b).className="";
      }
    }
  }
  var msg;
  var counting_msg = {{ $count_msg }}-1;
  $(document).ready(function(){
    if(counting_msg>5){
      for(ninawm=counting_msg;ninawm>5;ninawm--){
        document.getElementById("b"+ninawm).className="hidden";
      }
    }
  });
  function msg_change(){
    msg = document.getElementById("msg_table").value;
    if(msg==5){
      for(ninawm=counting_msg;ninawm>5;ninawm--){
        document.getElementById("b"+ninawm).className="hidden";
      }
      for(ninawm=1;ninawm<=5;ninawm++){
        document.getElementById("b"+ninawm).className="";
      }
    }else if(msg==10){
      for(ninawm=counting_msg;ninawm>10;ninawm--){
        document.getElementById("b"+ninawm).className="hidden";
      }
      for(ninawm=1;ninawm<=10;ninawm++){
        document.getElementById("b"+ninawm).className="";
      }
    }else if(msg==17){
      for(ninawm=counting_msg;ninawm>17;ninawm--){
        document.getElementById("b"+ninawm).className="hidden";
      }
      for(ninawm=1;ninawm<=17;ninawm++){
        document.getElementById("b"+ninawm).className="";
      }
    }
  }

  var fc;
  var counting2 = {{ $faculty_count }}-1;
  $(document).ready(function(){
    if(counting2>5){
      for(fac=counting2;fac>5;fac--){
        document.getElementById("a"+fac).className="hidden";
      }
    }
  });
  function faculty_change(){
    fc = document.getElementById("faculty_table").value;
    if(fc==5){
      for(fac=counting2;fac>5;fac--){
        document.getElementById("a"+fac).className="hidden";
      }
      for(fac=1;fac<=5;fac++){
        document.getElementById("a"+fac).className="";
      }
    }else if(fc==10){
      for(fac=counting2;fac>10;fac--){
        document.getElementById("a"+fac).className="hidden";
      }
      for(fac=1;fac<=10;fac++){
        document.getElementById("a"+fac).className="";
      }
    }else if(fc==17){
      for(fac=counting2;fac>17;fac--){
        document.getElementById("a"+fac).className="hidden";
      }
      for(fac=1;fac<=17;fac++){
        document.getElementById("a"+fac).className="";
      }
    }
  }

  var lo;
  var countingloc = {{ $loc_count }}-1;
  $(document).ready(function(){
    if(countingloc>3){
      for(loc=countingloc;loc>3;loc--){
        document.getElementById("loc"+loc).className="hidden";
      }
    }
  });
  function loc_change(){
    lo = document.getElementById("loc_table").value;
    if(lo==3){
      for(nloc=countingloc;nloc>3;nloc--){
        document.getElementById("loc"+nloc).className="hidden";
      }
      for(nloc=1;nloc<=3;nloc++){
        document.getElementById("loc"+nloc).className="";
      }
    }else if(lo==5){
      for(nloc=countingloc;nloc>5;nloc--){
        document.getElementById("loc"+nloc).className="hidden";
      }
      for(nloc=1;nloc<=5;nloc++){
        document.getElementById("loc"+nloc).className="";
      }
    }else if(lo==10){
      for(nloc=countingloc;nloc>10;nloc--){
        document.getElementById("loc"+nloc).className="hidden";
      }
      for(nloc=1;nloc<=10;nloc++){
        document.getElementById("loc"+nloc).className="";
      }
    }
  }

  var dpt;
  var countingdept = {{ $dept_count }}-1;
  $(document).ready(function(){
    if(countingdept>3){
      for(dept=countingdept;dept>3;dept--){
        document.getElementById("dept"+dept).className="hidden";
      }
    }
  });
  function dept_change(){
    dpt = document.getElementById("dept_table").value;
    if(dpt==3){
      for(ndept=countingdept;ndept>3;ndept--){
        document.getElementById("dept"+ndept).className="hidden";
      }
      for(ndept=1;ndept<=3;ndept++){
        document.getElementById("dept"+ndept).className="";
      }
    }else if(dpt==5){
      for(ndept=countingdept;ndept>5;ndept--){
        document.getElementById("dept"+ndept).className="hidden";
      }
      for(ndept=1;ndept<=5;ndept++){
        document.getElementById("dept"+ndept).className="";
      }
    }else if(dpt==10){
      for(ndept=countingdept;ndept>10;ndept--){
        document.getElementById("dept"+ndept).className="hidden";
      }
      for(ndept=1;ndept<=10;ndept++){
        document.getElementById("dept"+ndept).className="";
      }
    }
  }

</script>
@endsection
@section('footer')
  @parent
@endsection