@extends('layouts/master')

@section('heroDiv')
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">

		<h1 class="sub-header">Create Permission</h1>
		<div class="table-responsive  col-sm-12 col-md-8">
			@include('layouts/errors')
			<form action="/permissions/update/{{ $permission->id }}" method="post">
		    	{{ csrf_field() }}
				<div class="form-group">
		    		<label for="name">Name *</label>
					<input type="text" name="name" class="form-control" required value="{{ $permission->name}}">
		    		<small>at least 4 characters</small>
		    	</div>
		    	<div class="form-group">
		    		<label for="description">Description *</label>
		    		<input type="text" name="description" class="form-control" required value="{{ $permission->description}}">
		    	</div>
		    	<div class="form-group">
		    		<input type="submit" value="submit" class="btn btn-default">
		    	</div>
		    </form>
	    </div>
	    <div class="table-responsive  col-sm-12 col-md-4">
			<table class="table table-striped">
	        <tr>
	          	<td>permissions Created</td>
	          	<td>{{ $permission->created_at }}</td>
	        </tr>
	        <tr>
	          	<td>permissions Updated</td>
	          	<td>{{ $permission->updated_at }}</td>
	        </tr>
	        <tr>
          		<td>Id</td>
	          	<td>{{ $permission->id }}</td>
	        </tr>
	    </table>
	</div>    
	</div>    

@endsection