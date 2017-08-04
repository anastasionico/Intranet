@extends('layouts/master')

@section('heroDiv')
	<h1 class="sub-header">Create a new role</h1>
@endsection

@section('sectionTable')
	<div class="table-responsive p-2">
		<form action="/roles/store" method="post" enctype="multipart/form-data">
			<div class="col-md-9">
				@include('layouts/errors')
				{{ csrf_field() }}
				<div class="form-group">
		    		<label for="name">Name *</label>
		    		<input type="text" name="name" class="form-control" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="description">Description *</label>
		    		<input type="text" name="description" class="form-control" required>
		    	</div>
		    </div>
			<div class="col-md-3">
		    	<h3>Permissions</h3>
		    	@foreach($permissions as $permission)
		    		<div class="checkbox">
						<label><input type="checkbox" value="{{$permission->id}}" name="permissions[]">{{$permission->name}}</label>
					</div>
		    	@endforeach
		    </div>
		    <div class="text-right col-md-12">
		    	<div class="form-group">
		    		<input type="submit" value="submit" class="btn btn-default">
		    	</div>
		    </div>
	    </form>
	</div>    
@endsection