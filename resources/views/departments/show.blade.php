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
	<div class="table-responsive  col-sm-6 col-md-6">
		
		<h2 class="sub-header">Department Details</h2>
	    <table class="table table-striped">
	        <tr>
	          	<td>Id</td>
	          	<td>{{ $department->id }}</td>
	        </tr>
	        <tr>
	          	<td>Name</td>
	          	<td>{{ $department->name }}</td>
	        </tr>
	        <tr>
	          	<td>Cost Center Last</td>
	          	<td>{{ $department->cost_center_last }}</td>
	        </tr>
	        <tr>
	          	<td>Site</td>
	          	<td>
	          		<a href="/sites/{{ $department->site->id }}">
	          			{{ $department->site->name }}
	          		</a> 
	          	</td>	
	        </tr>
	    </table>
	    <a href="/departments/edit/{{ $department->id }}" class="btn btn-primary">
    		Edit
    	</a>
    	<a href="/departments/delete/{{ $department->id }}" class="btn btn-danger">
    		Delete
    	</a>
	</div>   
@endsection

@section('aside')
	<div class="col-sm-6 col-md-6"></div>
@endsection
