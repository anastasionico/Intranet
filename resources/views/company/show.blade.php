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
		
		<h2 class="sub-header">Company Details</h2>
	    <table class="table table-striped">
	        <tr>
	          	<td>Id</td>
	          	<td>{{ $company->id }}</td>
	        </tr>
	        <tr>
	          	<td>Image</td>
	          	<td>{{ $company->img }}</td>
	        </tr>
	        <tr>
	          	<td>Name</td>
	          	<td>{{ $company->name }}</td>
	        </tr>
	        <tr>
	          	<td>U.R.L.</td>
	          	<td>
	          		<a href="{{ $company->url }}" target="_blank">
		        		{{ $company->url }}
		        	</a>
	          	</td>
	        </tr>
	    </table>
	    <a href="/company/edit/{{ $company->id }}" class="btn btn-primary">
    		Edit
    	</a>
    	<a href="/company/delete/{{ $company->id }}" class="btn btn-danger">
    		Delete
    	</a>
	</div>    
@endsection