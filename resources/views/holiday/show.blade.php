@extends('layouts/master')

@section('heroDiv')
	
@endsection

@section('sectionTable')
	<div class="col-sm-12 col-md-12">
		<h2 class="sub-header">
			Holiday Request
			@if( $holiday->approved == 0)
	      		<span class="btn btn-warning">
	      			Pending
	      		</span>
	      	@elseif($holiday->approved == 1)
	      		<span class="btn btn-success">
	      			Approved
	      		</span>	
	      	@else
	      		<span class="btn btn-danger">
	      			denied
	      		</span>		
	      	@endif
		</h2>
	</div>
	
	<div class="table-responsive  col-sm-6 col-md-6">
		<table class="table table-striped">
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
	          	<td>Department</td>
	          	<td>{{ $department->name }}</td>
	        </tr>
	        <tr>
	          	<td>Job Title</td>
	          	<td>{{ $user->job_title }}</td>
	        </tr>
	        <tr>
	          	<td>Personal Manager</td>
	          	<td>{{ $personal_manager->name }} {{ $personal_manager->surname }}</td>
	        </tr>
	    </table>
	</div>    
	<div class="table-responsive  col-sm-6 col-md-6">
		 <table class="table table-striped">
		 	<?php

		 	?>
	       	<tr>
	          	<td>Request ID</td>
	          	<td>{{ $holiday->id }}</td>
	        </tr>
	        <tr>
	          	<td>Requested</td>
	          	<td>{{ $holiday->created_at->diffForHumans() }}</td>
	        </tr>
	        <tr>
	          	<td>Start</td>
	          	<td>{{ $holiday->start->toFormattedDateString() }}</td>
	        </tr>
	        <tr>
	          	<td>End</td>
	          	<td>{{ $holiday->end->toFormattedDateString() }}</td>
	        </tr>
	        <tr>
	          	<td>Returning</td>
	          	<td>{{ $holiday->returning_day->toFormattedDateString() }}</td>
	        </tr>
	        <tr>
	          	<td>Total Days Requested</td>
	          	<td>{{ $totalDayRequested->d }}</td>
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
	          	<td>Holiday Currently Available</td>
	          	<td>{{ ($user->holiday_total + $user->holiday_outstanding) - $user->holiday_taken }}</td>
	        </tr>
	      	<tr>
	          	<td>Total Days Remaining </td>
	          	<td>{{ $totalDayRemaining }}</td>
	        </tr>
	    </table>
	</div>
	@if($holiday->approved == 0)
		<div class="text-right col-sm-12 col-md-12">
			<a href="/holiday/accept/{{ $holiday->id }}" class="btn btn-success">
				Accept
			</a>
			<a href="/holiday/deny/{{ $holiday->id }}" class="btn btn-danger">
				Decline
			</a>
		</div>
	@endif
	
	
@endsection