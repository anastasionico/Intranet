@extends('layouts/master')

@section('heroDiv')
	<h1 class="page-header p-2">Welcome {{ Auth::user()->name }}</h1>
	
	
	{{--
	<div class="row placeholders">
        <div class="col-xs-6 col-sm-3 placeholder">
          	<img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
          	<h4>Label</h4>
          	<span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
          	<img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
          	<h4>Label</h4>
          	<span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
          	<img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
          	<h4>Label</h4>
          	<span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
          	<img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
          	<h4>Label</h4>
          	<span class="text-muted">Something else</span>
    	</div>
  	</div>
  	--}}
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">
		
		<h2 class="sub-header">Users List</h2>
	    <table class="table table-striped">
	      	<thead>
		        <tr>
		          	<th>Name</th>
		          	<th>Surname</th>
		          	<th>Email</th>
		          	<th>Action</th>
		        </tr>
	      	</thead>
	      	<tbody>
	      		@foreach($users as $user)
					<tr>
				        <td>{{ $user->name }}</td>
				        <td>{{ $user->surname }}</td>
				        <td>{{ $user->email }}</td>
				        <td>
				        	<a href="/users/{{ $user->id }}" class="btn btn-default">
				        		View
				        	</a>
				        	<a href="/users/edit/{{ $user->id }}" class="btn btn-info">
				        		Edit
				        	</a>
				        	<a href="/users/delete/{{ $user->id }}" class="btn btn-danger">
				        		Delete
				        	</a>
				        </td>
				    </tr>
		    	@endforeach
        	</tbody>
	    </table>
	</div>    
@endsection