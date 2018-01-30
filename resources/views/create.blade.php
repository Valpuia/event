<!DOCTYPE html>
<html>
<head>
	<title>Create Event</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css">
  <script src="js/jquery.datetimepicker.full.js"></script>
  <style type="text/css">
  	a:hover{
  		text-decoration: none;
  	}
  	.form-control{
  		border-radius: 0;
  	}
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
				 	<li>Create</li>
				 	<li><a href="/myevent">My Event</a></li>
				 	<li><a href="" data-toggle="modal" data-target="#myModal">Password</a></li>
					<li class="pull-right"><a href="/logout">Logout</a></li>
				</ul>
			</div>
			<div class="col-md-6 col-md-offset-3">
				@if(session('success'))
					<div class="alert alert-success fade in">
	          <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
	          {{session('success')}}
	        </div>
				@endif
				@if(session('psw_success'))
					<div class="alert alert-success fade in">
	          <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
	          {{session('psw_success')}}
	        </div>
				@elseif(session('psw_error'))
					<div class="alert alert-success fade in">
	          <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
	          {{session('psw_error')}}
	        </div>
				@elseif(session('psw_error2'))
					<div class="alert alert-success fade in">
	          <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
	          {{session('psw_error2')}}
	        </div>
				@endif
			</div>
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default j">
					<div class="panel-body">
						<form method="POST" action="/create_event" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="col-md-6">
							<center>
								<img id="blah" src="images/default.png" class="img-responsive" style="object-fit:contain; overflow:hidden; height:300px; width:300px;">
							</center>
							<input id="imgInp" required="" type="file" class="form-control" name="image" accept="image/*">
						</div>
						<br>
						<div class="col-md-6">
							<label>Event Name: </label><input type="text" placeholder="Ex: Dance" required="" class="form-control" name="name">
							<label>Venue: </label>
							<select required="" class="form-control" name="loc">
								<option value="">Choose One</option>
								@foreach($loc as $loc)
									<option value="{{$loc->name}}">{{$loc->name}}</option>
								@endforeach
								<option value="{{Auth::user()->department_id}} Class Room">{{Auth::user()->department_id}} Class Room</option>
							</select>
							<label>Start: </label><input type="" placeholder="Choose Date & Time" required="" class="form-control" name="date" id="datetimepicker">
							<label>Department: </label>
							<p style="font-size: 20px;"><input type="hidden" name="user_id" value="{{Auth::user()->id}}">{{ Auth::user()->department_id }}</p>
						</div>
						<div class="col-md-9">
							<br>
							<label>Description: </label>
							<textarea class="form-control" required="" rows="5" placeholder="Details of/About the Event" name="description"></textarea>
						</div>
						<div class="col-md-3">
							<br>
							<br>
							<button type="submit" class="btn btn-primary form-control">Send</button>
							<br>
							<br>
							<button type="reset" class="btn btn-warning form-control">Reset</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal content-->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Change Password?</h4>
	      </div>
        	<form method="POST" action="/change_password">
        	{{ csrf_field() }}
		      <div class="modal-body">
					  <label>Enter your password</label>
					  <div class="input-group">
					    <span class="input-group-addon j"><i class="glyphicon glyphicon-lock"></i></span>
					    <input required="" type="password" class="form-control" name="oldpassword" placeholder="Current Password">
					  </div>
					  <hr>
				  	<label>Enter new password</label>
					  <div class="input-group">
					    <span class="input-group-addon j"><i class="glyphicon glyphicon-lock"></i></span>
					    <input required="" type="password" class="form-control" name="newpassword" placeholder="atleast 6 characters">
					  </div>
				  	<label>Retype password</label>
					  <div class="input-group">
					    <span class="input-group-addon j"><i class="glyphicon glyphicon-lock"></i></span>
					    <input required="" type="password" class="form-control" name="confirm_password" placeholder="atleast 6 characters">
					  </div>
		      </div>
		      <div class="modal-footer">
		      	<button type="submit" class="btn btn-default">Save</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
				</form>
	    </div>
		</div>
	</div>

	<script type="text/javascript">
		$("#datetimepicker").datetimepicker({
			minDate:new Date(),
	    	format: 'Y/m/d H:i',           
	   		step: 30,
	    	defaultTime: new Date()
		});

	function readURL(input) {
		if(input.files && input.files[0]){
		  var reader=new FileReader();
		  reader.onload=function(e){
		    $('#blah').attr('src',e.target.result);
		  }
		  reader.readAsDataURL(input.files[0]);
		}
	}
	$("#imgInp").change(function(){
		readURL(this);
	});
	</script>
</body>
</html>