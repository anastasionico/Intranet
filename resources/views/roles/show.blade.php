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
			Role Details
		</h2>
	</div>
	
	<div class="table-responsive  col-sm-6 col-md-6">
		
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
	        
	    </table>
	</div>    
	<div class="table-responsive  col-sm-6 col-md-6">
		 <table class="table table-striped">
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
	<div class="text-right col-sm-12 col-md-12">
		<a href="/roles/edit/{{ $role->id }}" class="btn btn-primary">
			Edit
		</a>
		<a href="/roles/delete/{{ $role->id }}" class="btn btn-danger">
			Delete
		</a>
	</div>
	
@endsection