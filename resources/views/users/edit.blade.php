@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">

		<h1 class="sub-header">Edit user</h1>
		<div class="col-md-9">
			@include('layouts/errors')
			<form action="/users/update/{{ $user->id }}" method="post" enctype="multipart/form-data">
		    	{{ csrf_field() }}
				<div class="form-group">
		    		
		    		<label for="img">Current image Photo</label>
		    		<img src="">
		    	</div>
		    	<div class="form-group">
		    		<label for="img">Update Photo</label>
		    		<input type="file" name="img">
		    	</div>
		    	<div class="form-group">
		    		<label for="name">Name *</label>
		    		<input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="surname">Surname *</label>
		    		<input type="text" name="surname" class="form-control" value="{{ $user->surname }}"  required>
		    	</div>
		    	<div class="form-group">
		    		<label for="email">Email *</label>
		    		<input type="email" name="email" class="form-control" placeholder="name.surname@imperialcommercial.co.uk"  value="{{ $user->email }}" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="username">Username *</label>
		    		<input type="text" name="username" class="form-control" placeholder="Min 4 characters"  value="{{ $user->username }}" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="password">Password *</label>
		    		<input type="password" name="password" class="form-control" placeholder="Min 6 characters"  value="{{ $user->password }}"  required>
		    	</div>
		    	<div class="form-group">
		    		<label for="password_confirmation">Repeat Password *</label>
		    		<input type="password" name="password_confirmation" class="form-control" placeholder=""  value="{{ $user->password }}"  required>
		    	</div>
		    	<div class="form-group">
		    		<label for="department_id">Department *</label>
		    		<select name="department_id"  class="form-control" required>
		    			<option value="{{ $user->department->id }}">{{ $user->department->name }} | Current</option>
		    			@foreach($departments as $department)
							<option value="{{ $department->id }}">
		    					{{ $department->name }} 
		    					| Manager: {{ $department->manager->name }} {{ $department->manager->surname }}
	    					</option>
		    			@endforeach
					</select>
		    	</div>
		    	<div class="form-group">
		    		<label for="personal_manager">Personal Manager *</label> 
		    		<select name="personal_manager"  class="form-control" required>
		    			<option value="{{$personal_manager->id}}">{{$personal_manager->name}} {{$personal_manager->surname}} | Current</option>
		    			@foreach($users as $user)
							<option value="{{ $user->id }}">
		    					{{ $user->name }} {{ $user->surname }} 
		    				</option>
		    			@endforeach
					</select>
		    	</div>
		    	<div class="form-group">
		    		<label for="holiday_total">Total days holiday (per year) *</label>
		    		<input type="number" name="holiday_total" class="form-control" min="23" value="{{ $user->holiday_total }}"  required>
		    	</div>
		    	<div class="form-group">
		    		<label for="holiday_taken">Already taken days holiday (current year) *</label>
		    		<input type="number" name="holiday_taken" class="form-control" value="{{ $user->holiday_taken }}" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="job_title">Job Title *</label>
		    		<input type="text" name="job_title" class="form-control" value="{{ $user->job_title }}" > 
		    	</div>
		    	<div class="form-group">
		    		<label for="job_level">Job Level *</label>
		    		<input type="number" name="job_level" class="form-control" min="1" value="{{ $user->level }}">
		    	</div>
		    	<div class="form-group">
		    		<label for="birthdate">Birth Date</label>
		    			@if(is_null($user->birthdate))
		    				<?php $birthdate = 'nd' ?>
		    			@else
		    				<?php $birthdate = $user->birthdate->format('Y-m-d'); ?>	
		    			@endif
					<input type="date" name="birthdate" class="form-control" value="{{ $birthdate}}">
		    	</div>
		    	<div class="form-group">
		    		<label for="expenses_mileage_rate">Expenses Mileage Rate </label>
		    		<input type="number" name="expenses_mileage_rate" class="form-control" placeholder="20"  value="{{ $user->expenses_mileage_rate }}">
		    	</div>
		    	<div class="form-group">
		    		<input type="submit" value="submit" class="btn btn-default">
		    	</div>
		    </form>
	    </div>
	</div>    
@endsection