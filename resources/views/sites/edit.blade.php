@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">
		<h1 class="sub-header">Edit Site</h1>
		<br><br><br>
		@include('layouts/errors')
		<div class="col-md-6">
			<form action="/sites/update/{{ $site->id }}" method="post" enctype="multipart/form-data">
		    	{{ csrf_field() }}
				<div class="form-group">
		    		{{-- Image to sort out --}}
		    		<label for="img">Current image Photo</label>
		    		<img src="">
		    	</div>
		    	<div class="form-group">
		    		<label for="img">Update Photo</label>
		    		<input type="file" name="img">
		    	</div>
		    	<div class="form-group">
		    		<label for="name">Name *</label>
		    		<input type="text" name="name" class="form-control" value="{{ $site->name }}" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="address">Address *</label>
		    		<input type="text" name="address" class="form-control" value="{{ $site->address }}" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="phone">Phone *</label>
		    		<input type="text" name="phone" class="form-control"  value="{{ $site->phone }}" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="company">Company *</label>
		    		<select name='company' class="form-control" required>
		    			<option value="{{ $site->company->id }}" selected>{{ $site->company->name }} - currently</option>
		    			@foreach($companies as $company)
		    				<option value="{{ $company->id }}">{{ $company->name }}</option>
		    			@endforeach
		    		</select>
		    	</div>
		    	<div class="form-group">
		    		<label for="cost_center_first">Cost Center First *</label>
		    		<input type="number" name="cost_center_first" class="form-control"  value="{{ $site->cost_center_first }}" min='0' required>
		    	</div>
		    	<div class="form-group">
		    		<label for="manufacturer">Manufacturer</label>
		    		<select name='manufacturer' class="form-control">
		    			<option value="{{ $site->manufacturer }}">{{ $site->manufacturer }} - currently</option>
		    			<option value="1">Undefined</option>
		    			<option value="2">Mercedes</option>
		    			<option value="3">FIAT</option>
		    		</select>
		    	</div>
		    	<div class="form-group">
		    		<label for="lat">Latitude & Longitude</label>
		    		<input type="text" name="lat" class="form-control"  value="{{ $site->lat }}">
		    		<br>
		    		<input type="text" name="lng" class="form-control" value="{{ $site->lng }}">
		    	</div>
		    	<div class="form-group">
		    		<input type="submit" value="submit" class="btn btn-default">
		    	</div>
		    </form>
		</div>    
	</div>    
@endsection