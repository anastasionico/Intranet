@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">

		<h1 class="sub-header">Create Role</h1>
		<div class="col-md-9">
			@include('layouts/errors')
			<form action="/roles/store" method="post" enctype="multipart/form-data">
		    	{{ csrf_field() }}
				<div class="form-group">
		    		<label for="name">Name *</label>
		    		<input type="text" name="name" class="form-control" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="description">Description *</label>
		    		<input type="text" name="description" class="form-control" required>
		    	</div>
		    	<div class="form-group">
		    		<input type="submit" value="submit" class="btn btn-default">
		    	</div>
		    </form>
	    </div>
	</div>    
@endsection