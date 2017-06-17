@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">
		<h1 class="sub-header">Add Department</h1>
		<br><br><br>
		@include('layouts/errors')
		<div class="col-md-6">
		<form action="/departments/store" method="post" enctype="multipart/form-data">
	    	{{ csrf_field() }}
	    	<div class="form-group">
	    		<label for="name">Name *</label>
	    		<input type="text" name="name" class="form-control"  required>
	    	</div>
	    	<div class="form-group">
	    		<label for="site">Site *</label>
	    		<select name='site' class="form-control" required>
	    			@foreach($sites as $site)
		    				<option value="{{ $site->id }}">{{ $site->name }}</option>
		    			@endforeach
	    		</select>
	    	</div>
	    	<div class="form-group">
	    		<label for="cost_center_last">Cost Center last *</label>
	    		<input type="number" name="cost_center_last" class="form-control" min='0' required>
	    	</div>
	    	<div class="form-group">
	    		<input type="submit" value="submit" class="btn btn-default">
	    	</div>
	    </form>
	</div>    
@endsection