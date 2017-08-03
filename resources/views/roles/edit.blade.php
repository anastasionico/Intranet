@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">

		<h1 class="sub-header">Edit Role</h1>
		<div class="col-md-3">
			@include('layouts/errors')
			<form action="/roles/update/{{ $role->id }}" method="post" enctype="multipart/form-data">
		    	{{ csrf_field() }}
				<div class="form-group">
		    		<label for="name">Name *</label>
		    		<input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="description">Description *</label>
		    		<input type="text" name="description" class="form-control" value="{{ $role->description }}" required>
		    	</div>
		    	<div class="form-group">
		    		<input type="submit" value="submit" class="btn btn-default">
		    	</div>
		    </form>
	    </div>
	    <div class="col-md-9">
	    </div>
	</div>    
@endsection