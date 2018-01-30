@extends('admin.masters.layout')
@section('title','Admin')
@section('navbar')
  @parent
@endsection
@section('content')
<!-- Page content -->
<div id="page-content-wrapper">
  <div class="page-content">
    @if(session('fac_up'))
    <div class="col-md-10 col-md-offset-1">
      <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
        {{session('fac_up')}}
      </div>
    </div>
    @elseif(session('del_fac'))
    <div class="col-md-10 col-md-offset-1">
      <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
        {{session('del_fac')}}
      </div>
    </div>
    @endif
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-danger" style="border-radius: 0;">
            <div class="panel-heading" style="border-radius: 0;">
              <center>
                <strong style="font-size: 25px; color: black;">All Faculty</strong>
              </center>
            </div>
            <div class="panel-body">
              <table id="employees" class="table table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <th>From</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($user as $user)
                  @if($user->type == 'user')
                    <tr>
                      <form method="POST" action="/update_user">
                      {{csrf_field()}}
                        <td>
                          <input type="hidden" name="id" value="{{$user->id}}">
                          <input id="showtext{{$user->id}}" type="text" class="hidden" value="{{$user->name}}" name="name">
                          <p id="showtext2{{$user->id}}" class="">{{$user->name}}</p>
                        </td>
                        <td>
                          {{$user->email}}
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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
  $('#employees').dataTable();

  @foreach($user2 as $user)
  // Text disable/enable
  function editText{{$user->id}}(){
    document.getElementById("showtext{{$user->id}}").className=" form-control";
    document.getElementById("showtext2{{$user->id}}").className="hidden";
    document.getElementById("showGlyph{{$user->id}}").className="pull-right";
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

  $(document).ready(function(){
    $('[data-toggle="onPoint"]').tooltip();   
  });
</script>
@endsection
@section('footer')
  @parent
@endsection