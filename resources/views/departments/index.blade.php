@extends('layouts/master')

@section('heroDiv')
	<div class="row">
        <div class="col-xs-12 col-md-12">
            <h1 class="page-header">Department List</h1>
            @permission(('department create'))
				<a href="/departments/create" class="btn btn-primary">
	                Insert new department
	            </a>        
			@endpermission
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
		          	<th>Name</th>
		          	<th>Site</th>
		          	<th>Manager</th>
		          	<th>Action</th>
		        </tr>
	      	</thead>
	      	<tbody>
	      		@foreach($departments as $department)

					<tr>
				        <td>{{ $department->name }}</td>
				        <td>{{ $department->site->name }}</td>
				        <td>{{ $department->manager->name }} {{ $department->manager->surname }}</td>
				        <td>
				        	@permission(('department read'))
								<a href="/departments/{{ $department->id }}" class="btn btn-default">
					        		View
					        	</a>
							@endpermission
							@permission(('department update'))
								<a href="/departments/edit/{{ $department->id }}" class="btn btn-info">
					        		Edit
					        	</a>
							@endpermission
							@permission(('department delete'))
								<a href="/departments/delete/{{ $department->id }}" class="btn btn-danger">
					        		Delete
					        	</a>
							@endpermission
							@permission(('department-holiday-read'))
								<a href="/holiday/dept/{{ $department->id }}" class="btn btn-info">
					        		Holiday
					        	</a>
							@endpermission
						</td>
				    </tr>
		    	@endforeach
        	</tbody>
	    </table>
	</div>    
@endsection