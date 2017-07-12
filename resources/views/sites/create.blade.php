@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">
		<h1 class="sub-header">Add Site</h1>
		<br><br><br>
		@include('layouts/errors')
		<div class="col-md-9">
		<form action="/sites/store" method="post" enctype="multipart/form-data">
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
	    		<label for="address">Address *</label>
	    		<input type="text" name="address" class="form-control"  required>
	    	</div>
	    	<div class="form-group">
	    		<label for="phone">Phone *</label>
	    		<input type="text" name="phone" class="form-control"  required>
	    	</div>
	    	<div class="form-group">
	    		<label for="company">Company *</label>
	    		<select name='company' class="form-control" required>
	    			@foreach($companies as $company)
		    				<option value="{{ $company->id }}">{{ $company->name }}</option>
		    			@endforeach
	    		</select>
	    	</div>
	    	<div class="form-group">
	    		<label for="cost_center_first">Cost Center First *</label>
	    		<input type="number" name="cost_center_first" class="form-control" min='0' required>
	    	</div>
	    	<div class="form-group">
	    		<label for="manufacturer">Manufacturer</label>
	    		<select name='manufacturer' class="form-control">
	    			<option value="1">Undefined</option>
	    			<option value="2">Mercedes</option>
	    			<option value="3">FIAT</option>
	    		</select>
	    	</div>
	    	<div class="form-group">
	    		<label for="lat">Latitude & Longitude</label>
	    		<input type="text" name="lat" class="form-control">
	    		<br>
	    		<input type="text" name="lng" class="form-control">
	    	</div>
	    	<div class="form-group">
	    		<input type="submit" value="submit" class="btn btn-default">
	    	</div>
	    </form>
	</div>    
@endsection