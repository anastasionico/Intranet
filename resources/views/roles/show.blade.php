@extends('layouts/master')

@section('heroDiv')
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
	<div class="col-sm-12 col-md-12">
		<h2 class="sub-header">
			{{ $role->name }}
		</h2>
	</div>
	<div class="col-sm-12 col-md-9">
		<h3>Details</h3>
	    <table class="table table-striped">
	        <tr>
	          	<td>Name</td>
	          	<td>{{ $role->name }}</td>
	        </tr>
	        <tr>
	          	<td>Slug</td>
	          	<td>{{ $role->slug }}</td>
	        </tr>
	        <tr>
	          	<td>Description</td>
	          	<td>{{ $role->description }}</td>
	        </tr>
	        <tr>
	          	<td>Role Created</td>
	          	<td>{{ $role->created_at }}</td>
	        </tr>
	        <tr>
	          	<td>Role Updated</td>
	          	<td>{{ $role->updated_at }}</td>
	        </tr>
	        <tr>
          		<td>Id</td>
	          	<td>{{ $role->id }}</td>
	        </tr>
	    </table>
	</div>    
	<div class="col-sm-12 col-md-3">
		<h3>Permissions</h3>
		<table class="table table-striped">
		    @foreach($role->permissions as $permission)
	        	<tr>
		          	<td>{{ $permission->name }}</td>
		        </tr>
	        @endforeach
	    </table>
	</div>
	<div class="text-right col-sm-12 col-md-12">
		@permission(('role update'))
			<a href="/roles/edit/{{ $role->id }}" class="btn btn-info">
        		Edit
        	</a>
		@endpermission
		@permission(('role delete'))
			<a href="/roles/delete/{{ $role->id }}" class="btn btn-danger">
        		Delete
        	</a>
		@endpermission
	</div>
	
@endsection