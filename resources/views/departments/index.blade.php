@extends('layouts/master')

@section('heroDiv')
	<div class="row">
        <div class="col-xs-12 col-md-12">
            <h1 class="page-header">Department List</h1>
            <a href="/departments/create" class="btn btn-primary">
                Insert new department
            </a>        
        </div>
        
    </div>
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
		<table class="table table-striped">
	      	<thead>
		        <tr>
		          	<th>Logo</th>
		          	<th>Name</th>
		          	<th>Manufacturer</th>
		          	<th>Company</th>
		          	<th>Action</th>
		        </tr>
	      	</thead>
	      	<tbody>
	      		@foreach($departments as $department)
					<tr>
				        <td>{{ $department->img }}</td>
				        <td>{{ $department->name }}</td>
				        <td>{{ $department->manufacturer }}</td>
				        <td>
				        	<a href="/company/{{ $department->company->id }}">
		          				{{ $department->company->name }}
			          		</a> 
			        	</td>
				        <td>
				        	<a href="/departments/{{ $department->id }}" class="btn btn-default">
				        		View
				        	</a>
				        	<a href="/departments/edit/{{ $department->id }}" class="btn btn-info">
				        		Edit
				        	</a>
				        	<a href="/departments/delete/{{ $department->id }}" class="btn btn-danger">
				        		Delete
				        	</a>
				        </td>
				    </tr>
		    	@endforeach
        	</tbody>
	    </table>
	</div>    
@endsection