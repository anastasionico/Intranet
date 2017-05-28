@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">
		<h1 class="sub-header">Edit user</h1>
		<form action="/users/update/{{ $user->id }}" method="post" enctype="multipart/form-data">
	    	{{ csrf_field() }}
	    	<div class="form-group">
	    		<img src="">{{-- Image to sort out --}}
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
	    		<label for="job_title">Job Title</label>
	    		<input type="text" name="job_title" class="form-control"  value="{{ $user->job_title }}" > 
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
	    		<label for="birthdate">Birth Date</label>
	    		<input type="date" name="birthdate" class="form-control" value="{{ $user->birthdate }}" >
	    	</div>
	    	<div class="form-group">
	    		<label for="department_id">Department *</label>
	    		<select name="department_id"  class="form-control" required>
	    			<option value="{{$user->department_id}}">{{ $user->department_id }}</option>
	    			<option value="2" default>Pinco Pallino</option>
	    		</select>
	    	</div>
	    	<div class="form-group">
	    		<label for="expenses_auth_id">Expenses Manager *</label>
	    		<select name="expenses_auth_id"  class="form-control" required>
	    			<option value="{{$user->expenses_auth_id }}" default>{{ $user->expenses_auth_id }}</option>
	    			<option value="2" default>Pinco Pallino</option>
	    		</select>
	    	</div>
	    	<div class="form-group">
	    		<label for="expenses_mileage_rate">Expenses Mileage Rate *</label>
	    		<input type="number" name="expenses_mileage_rate" class="form-control" placeholder="20"  value="{{ $user->expenses_mileage_rate }}" required>
	    	</div>
	    	<div class="form-group">
	    		<label for="holiday_manager">Holiday Manager *</label>
	    		<select name="holiday_manager"  class="form-control" required>
	    			<option value="{{$user->holiday_manager }}">{{$user->holiday_manager }} </option>
	    			<option value="2" default>Pinco Pallino</option>
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
	    		<input type="submit" value="submit" class="btn btn-default">
	    	</div>
	    </form>
	</div>    
@endsection