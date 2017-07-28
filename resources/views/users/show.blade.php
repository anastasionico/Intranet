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
			User Details
			@if( $user->on_holiday == 1)
	      		<span class="btn btn-warning">
	      			Currently in Holiday
	      		</span>
	      	@endif
		</h2>
	</div>
	
	<div class="table-responsive  col-sm-6 col-md-6">
		
	    <table class="table table-striped">
	        <tr>
	          	<td>Id</td>
	          	<td>{{ $user->id }}</td>
	        </tr>
	        <tr>
	          	<td>Image</td>
	          	<td>{{ $user->img }}</td>
	        </tr>
	        <tr>
	          	<td>Name</td>
	          	<td>{{ $user->name }}</td>
	        </tr>
	        <tr>
	          	<td>Surname</td>
	          	<td>{{ $user->surname }}</td>
	        </tr>
	        <tr>
	          	<td>Email</td>
	          	<td>{{ $user->email }}</td>
	        </tr>
	        <tr>
	          	<td>Username</td>
	          	<td>{{ $user->username }}</td>
	        </tr>
	        <tr>
	        	<td>Birthday</td>
	          	<td>
	          		@if($user->birthdate !== null)
	          			{{ $user->birthdate->toFormattedDateString() }}
	          		@else
	          			{{ 'ND'}}
	          		@endif	
	        	</td>
	        </tr>
	        <tr>
	          	<td>Created</td>
	          	<td>{{ $user->created_at }}</td>
	        </tr>
	        <tr>
	          	<td>Updated</td>
	          	<td>{{ $user->updated_at }}</td>
	        </tr>
	        <tr>
	          	<td>Last Login</td>
	          	<td>
	          		@if($user->last_login === null)
		          		{{ "Never logged in" }}
		          	@else
		          		{{ $user->updated_at->diffForHumans() }}
		          	@endif
	          	</td>
	        </tr>
	    </table>
	</div>    
	<div class="table-responsive  col-sm-6 col-md-6">
		 <table class="table table-striped">
	        <tr>
	          	<td>Department</td>
	          	<td>{{ $department->name }}</td>
	        </tr>
	        <tr>
	          	<td>Personal Manager</td>
	          	<td>{{ $personal_manager->name }} {{ $personal_manager->surname }}</td>
	        </tr>
	        <tr>
	          	<td>Job Title</td>
	          	<td>{{ $user->job_title }}</td>
	        </tr>
	        
	        <tr>
	          	<td>Expenses Manager</td>
	          	<td>{{ $user->expenses_auth_id }}</td>
	        </tr>
	        <tr>
	          	<td>Expenses Mileage Rate</td>
	          	<td>{{ $user->expenses_mileage_rate }}</td>
	        </tr>
	        <tr>
	          	<td>Holiday Total Days (per year)</td>
	          	<td>{{ $user->holiday_total }}</td>
	        </tr>
	        <tr>
	          	<td>Holiday Outstanding (previous year)</td>
	          	<td>{{ $user->holiday_outstanding }}</td>
	        </tr>
	        <tr>
	          	<td>Holiday Taken (current year)</td>
	          	<td>{{ $user->holiday_taken }}</td>
	        </tr>
	      	<tr>
	          	<td>Holiday Available</td>
	          	<td>{{ ($user->holiday_total + $user->holiday_outstanding) - $user->holiday_taken }}</td>
	        </tr>
	        
	    </table>
	</div>
	<div class="text-right col-sm-12 col-md-12">
		<a href="/users/edit/{{ $user->id }}" class="btn btn-primary">
			Edit
		</a>
		<a href="/users/delete/{{ $user->id }}" class="btn btn-danger">
			Delete
		</a>
	</div>
	
@endsection