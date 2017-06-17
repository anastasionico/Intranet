@extends('layouts/master')

@section('heroDiv')
	<div class="row">
        <div class="col-xs-12 col-md-12">
            <h1 class="page-header">Sites List</h1>
            <a href="/sites/create" class="btn btn-primary">
                Insert new site
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
	      		@foreach($sites as $site)
					<tr>
				        <td>{{ $site->img }}</td>
				        <td>{{ $site->name }}</td>
				        <td>{{ $site->manufacturer }}</td>
				        <td>
				        	<a href="/company/{{ $site->company->id }}">
		          				{{ $site->company->name }}
			          		</a> 
			        	</td>
				        <td>
				        	<a href="/sites/{{ $site->id }}" class="btn btn-default">
				        		View
				        	</a>
				        	<a href="/sites/edit/{{ $site->id }}" class="btn btn-info">
				        		Edit
				        	</a>
				        	<a href="/sites/delete/{{ $site->id }}" class="btn btn-danger">
				        		Delete
				        	</a>
				        </td>
				    </tr>
		    	@endforeach
        	</tbody>
	    </table>
	</div>    
@endsection