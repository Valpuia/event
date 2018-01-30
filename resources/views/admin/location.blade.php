@extends('admin.masters.layout')
@section('title','Admin')
@section('navbar')
  @parent
@endsection
@section('content')
<!-- Page content -->
<div id="page-content-wrapper">
  <div class="page-content">
    @if(session('loc_update'))
    <div class="col-md-10 col-md-offset-1">
      <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
        {{session('loc_update')}}
      </div>
    </div>
    @elseif(session('del_loc'))
    <div class="col-md-10 col-md-offset-1">
      <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
        {{session('del_loc')}}
      </div>
    </div>
    @endif
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-danger" style="border-radius: 0;">
            <div class="panel-heading" style="border-radius: 0;">
              <center>
                <strong style="font-size: 25px; color: black;">All Location</strong>
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
                  @foreach($loc as $loc)
                  <tr>
                    <form method="POST" action="/update_loc">
                      {{csrf_field()}}
                      <td>
                        <input type="hidden" name="id" value="{{$loc->id}}">
                        <input id="showtext{{$loc->id}}" type="text" class="hidden" value="{{$loc->name}}" name="name">
                        <p id="showtext2{{$loc->id}}" class="">{{$loc->name}}</p>
                      </td>
                      <td>
                        <div id="hideGlyph{{$loc->id}}" class="pull-right">
                          <div onclick="editText{{$loc->id}}()" data-toggle="onPoint" data-placement="left" title="Edit" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i></div>
                        </div>
                        <div id="showGlyph{{$loc->id}}" class="hidden">
                          <button type="submit" class="btn btn-primary btn-xs" data-toggle="onPoint" data-placement="left" title="Save"><i class="glyphicon glyphicon-saved"></i></button>
                          <div onclick="editText2{{$loc->id}}()" data-toggle="onPoint" data-placement="right" title="Cancel" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-remove"></i></div>
                        </div>
                      </td>
                    </form>
                    <td>
                      <form method="POST" action="del_loc">
                        {{csrf_field()}}
                        <input type="hidden" name="deldept" value="{{$loc->id}}">
                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#fac_confirm{{$loc->id}}"><i data-toggle="onPoint" data-placement="right" title="Delete" class="glyphicon glyphicon-trash"></i></button>
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

@foreach($loc2 as $loc)
<div class="modal fade" id="fac_confirm{{$loc->id}}" role="dialog">
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

<script src="js/navbar.js"></script>
<script type="text/javascript">
  $('#employees').dataTable();

  $(document).ready(function(){
    $('[data-toggle="onPoint"]').tooltip();   
  });

  @foreach($loc2 as $loc)
  // Text disable/enable
  function editText{{$loc->id}}(){
    document.getElementById("showtext{{$loc->id}}").className=" form-control";
    document.getElementById("showtext2{{$loc->id}}").className="hidden";
    document.getElementById("showGlyph{{$loc->id}}").className="pull-right";
    document.getElementById("hideGlyph{{$loc->id}}").className="hidden";
  }
  function editText2{{ $loc->id }}(){
    document.getElementById("showtext{{$loc->id}}").className="hidden";
    document.getElementById("showtext2{{$loc->id}}").className="";
    document.getElementById("showGlyph{{$loc->id}}").className="hidden";
    document.getElementById("hideGlyph{{$loc->id}}").className="pull-right";
  }
  @endforeach

</script>
@endsection
@section('footer')
  @parent
@endsection