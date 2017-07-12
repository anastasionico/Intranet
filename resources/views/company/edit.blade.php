@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">
		<h1 class="sub-header">Edit Company</h1>
		<br><br><br>
		@include('layouts/errors')
		<div class="col-md-9">
			<form action="/company/update/{{ $company->id }}" method="post" enctype="multipart/form-data">
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
		    		<input type="text" name="name" class="form-control" value="{{ $company->name }}" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="url">url *</label>
		    		<input type="text" name="url" class="form-control" value="{{ $company->url }}"  required>
		    	</div>
		    	<div class="form-group">
		    		<input type="submit" value="submit" class="btn btn-default">
		    	</div>
		    </form>
		</div>    
	</div>    
@endsection