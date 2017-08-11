@extends('layouts/master')

@section('heroDiv')
	<div class="row">
        <div class="col-xs-12 col-md-12">
            <h1 class="page-header">Companies List</h1>
            @permission(('company create'))
				<a href="/company/create" class="btn btn-primary">
	                Insert new company
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
		          	<th>Logo</th>
		          	<th>Name</th>
		          	<th>U.r.l.</th>
		          	<th>Action</th>
		        </tr>
	      	</thead>
	      	<tbody>
	      		@foreach($companies as $company)
					<tr>
				        <td>{{ $company->img }}</td>
				        <td>{{ $company->name }}</td>
				        <td>
				        	<a href="{{ $company->url }}" target="_blank">
				        		{{ $company->url }}
				        	</a>
				        </td>
				        <td>
				        	@permission(('company read'))
								<a href="/company/{{ $company->id }}" class="btn btn-default">
					        		View
					        	</a>
							@endpermission
							@permission(('company update'))
								<a href="/company/edit/{{ $company->id }}" class="btn btn-info">
					        		Edit
					        	</a>
							@endpermission
							@permission(('company delete'))
								<a href="/company/delete/{{ $company->id }}" class="btn btn-danger">
					        		Delete
					        	</a>
							@endpermission
						</td>
				    </tr>
		    	@endforeach
        	</tbody>
	    </table>
	</div>    
@endsection