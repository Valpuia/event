@extends('admin.masters.layout')
@section('title','Admin')
@section('navbar')
  @parent
@endsection
@section('content')
<!-- Page content -->
<div id="page-content-wrapper">
  <div class="page-content">
    @if(session('dept_update'))
    <div class="col-md-10 col-md-offset-1">
      <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
        {{session('dept_update')}}
      </div>
    </div>
    @elseif(session('del_dept'))
    <div class="col-md-10 col-md-offset-1">
      <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
        {{session('del_dept')}}
      </div>
    </div>
    @endif
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-danger" style="border-radius: 0;">
            <div class="panel-heading" style="border-radius: 0;">
              <center>
                <strong style="font-size: 25px; color: black;">All Department</strong>
              </center>
            </div>
            <div class="panel-body">
              <table id="employees" class="table table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($dept as $dept)
                  <tr>
                    <form method="POST" action="/update_dept">
                      {{csrf_field()}}
                      <td>
                        <input type="hidden" name="id" value="{{$dept->id}}">
                        <input id="showtext{{$dept->id}}" type="text" class="hidden" value="{{$dept->name}}" name="name">
                        <p id="showtext2{{$dept->id}}" class="">{{$dept->name}}</p>
                      </td>
                      <td>
                        <div id="hideGlyph{{$dept->id}}" class="pull-right">
                          <div onclick="editText{{$dept->id}}()" data-toggle="onPoint" data-placement="left" title="Edit" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i></div>
                        </div>
                        <div id="showGlyph{{$dept->id}}" class="hidden">
                          <button type="submit" class="btn btn-primary btn-xs" data-toggle="onPoint" data-placement="left" title="Save"><i class="glyphicon glyphicon-saved"></i></button>
                          <div onclick="editText2{{$dept->id}}()" data-toggle="onPoint" data-placement="right" title="Cancel" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-remove"></i></div>
                        </div>
                      </td>
                    </form>
                    <td>
                      <form method="POST" action="del_dept">
                        {{csrf_field()}}
                        <input type="hidden" name="deldept" value="{{$dept->id}}">
                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#fac_confirm{{$dept->id}}"><i data-toggle="onPoint" data-placement="right" title="Delete" class="glyphicon glyphicon-trash"></i></button>
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

@foreach($dept2 as $dept)
<div class="modal fade" id="fac_confirm{{$dept->id}}" role="dialog">
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

<script src="js/navbar.js"></script>
<script type="text/javascript">
  $('#employees').dataTable();

  $(document).ready(function(){
    $('[data-toggle="onPoint"]').tooltip();   
  });

  @foreach($dept2 as $dept)
  // Text disable/enable
  function editText{{$dept->id}}(){
    document.getElementById("showtext{{$dept->id}}").className=" form-control";
    document.getElementById("showtext2{{$dept->id}}").className="hidden";
    document.getElementById("showGlyph{{$dept->id}}").className="pull-right";
    document.getElementById("hideGlyph{{$dept->id}}").className="hidden";
  }
  function editText2{{ $dept->id }}(){
    document.getElementById("showtext{{$dept->id}}").className="hidden";
    document.getElementById("showtext2{{$dept->id}}").className="";
    document.getElementById("showGlyph{{$dept->id}}").className="hidden";
    document.getElementById("hideGlyph{{$dept->id}}").className="pull-right";
  }
  @endforeach

</script>
@endsection
@section('footer')
  @parent
@endsection