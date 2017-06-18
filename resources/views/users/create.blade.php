@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="table-responsive p-2 ">
		@include('layouts/errors')
		<h1 class="sub-header">Add a new user</h1>
		<div class="col-md-6">
			<form action="/users" method="post" enctype="multipart/form-data">
		    	{{ csrf_field() }}
		    	<div class="form-group">
		    		<label for="img">Photo</label>
		    		<input type="file" name="img">
		    	</div>
		    	<div class="form-group">
		    		<label for="name">Name *</label>
		    		<input type="text" name="name" class="form-control"  required>
		    	</div>
		    	<div class="form-group">
		    		<label for="surname">Surname *</label>
		    		<input type="text" name="surname" class="form-control" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="email">Email *</label>
		    		<input type="email" name="email" class="form-control" placeholder="name.surname@imperialcommercial.co.uk" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="username">Username *</label>
		    		<input type="text" name="username" class="form-control" placeholder="Min 3 characters" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="password">Password *</label>
		    		<input type="password" name="password" class="form-control" placeholder="Min 6 characters"  required>
		    	</div>
		    	<div class="form-group">
		    		<label for="password_confirmation">Repeat Password *</label>
		    		<input type="password" name="password_confirmation" class="form-control" placeholder=""  required>
		    	</div>
		    	<div class="form-group">
		    		<label for="department">Department *</label>
		    		<select name='department' class="form-control" required>
		    			@foreach($departments as $department)
			    				<option value="{{ $department->id }}">
			    					{{ $department->name }} 
			    					| Manager: {{ $department->manager->name }} {{ $department->manager->surname }}
		    					</option>
			    			@endforeach
		    		</select>
		    	</div>
		    	<div class="form-group">
		    		<label for="expenses_auth_id">Expenses Manager *</label>
		    		<select name="expenses_auth_id"  class="form-control" required>
		    			<option value="1">John Doe</option>
		    		</select>
		    	</div>
		    	<div class="form-group">
		    		<label for="holiday_manager">Holiday Manager *</label>
		    		<select name="holiday_manager"  class="form-control" required>
		    			<option value="1">John Doe</option>
		    		</select>
		    	</div>
		    	<div class="form-group">
		    		<label for="holiday_total">Total days holiday (per year) *</label>
		    		<input type="number" name="holiday_total" class="form-control" min="23" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="holiday_taken">Already taken days holiday (current year) *</label>
		    		<input type="number" name="holiday_taken" class="form-control" min='0' required>
		    	</div>
		    	<div class="form-group">
		    		<label for="job_title">Job Title</label>
		    		<input type="text" name="job_title" class="form-control">
		    	</div>
		    	<div class="form-group">
		    		<label for="birthdate">Birth Date</label>
		    		<input type="date" name="birthdate" class="form-control">
		    	</div>
		    	<div class="form-group">
		    		<label for="expenses_mileage_rate">Expenses Mileage Rate</label>
		    		<input type="number" name="expenses_mileage_rate" class="form-control" placeholder="20">
		    	</div>
		    	<div class="form-group">
		    		<input type="submit" value="submit" class="btn btn-default">
		    	</div>
		    </form>
	    </div>
	</div>    
@endsection