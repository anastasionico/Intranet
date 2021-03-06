@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">
		<h1 class="sub-header">Insert Company</h1>
		<br><br><br>
		@include('layouts/errors')
		<div class="col-md-9">
		<form action="/company/store" method="post" enctype="multipart/form-data">
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
	    		<label for="url">U.R.L. *</label>
	    		<input type="text" name="url" class="form-control"  required>
	    	</div>
	    	<div class="form-group">
	    		<input type="submit" value="submit" class="btn btn-default">
	    	</div>
	    </form>
	</div>    
@endsection